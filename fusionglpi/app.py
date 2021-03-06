import sys
import os
from docopt import docopt
from collections import OrderedDict
import logging
from pprint import pprint, pformat  # noqa
from textwrap import dedent
from configparser import ConfigParser

from eve import Eve
from eve_sqlalchemy import SQL
from eve_sqlalchemy.validation import ValidatorSQL

import fusionglpi.models
from fusionglpi.models.common import Base
from fusionglpi.models import register_models
from fusionglpi.log import Log

_subcommands = OrderedDict()


def register_command(description):
    def decorate(f):
        _subcommands[f.__name__] = (description, f)
        return f
    return decorate


class Application(Log):
    """
    Usage:
        {command} [-d|-v] <subcommand>

    Options:
        -d, --debug     Debug mode
        -v, --verbose   Verbose mode

    Subcommands:
    {subcommands}
    """
    settings = {}

    def __init__(self):
        super().__init__()
        command = os.path.basename(sys.argv[0])
        self.__doc__ = dedent(self.__doc__).format(
            command=command,
            subcommands=self.format_subcommands()
        )

    def initialize(self, debug=False):
        self.log.setLevel(debug)
        self.get_settings_from_ini()
        self.settings['DOMAIN'] = register_models()
        self.settings['RESOURCE_METHODS'] = ['GET', 'POST', 'DELETE']
        self.settings['ITEM_METHODS'] = ['GET', 'PATCH', 'PUT', 'DELETE']
        self.settings['XML'] = False
        self.settings['X_DOMAINS'] = '*'
        if debug:
            logging.getLogger('sqlalchemy.engine').setLevel(logging.DEBUG)
        self.app = Eve(
            validator=ValidatorSQL,
            data=SQL,
            settings=self.settings
        )
        self.log.debug(pformat(self.app.settings))
        self.app.debug = debug
        self.db = self.app.data.driver
        Base.metadata.bind = self.db.engine
        self.db.Model = Base

    def get_settings_from_ini(self):
        settings = {}
        settings_filenames = [
            '/etc/fusionglpi/settings.ini',
            os.path.abspath('./settings.ini')
        ]
        self.log.debug(settings_filenames)

        # Define some variables available
        defaults = {
            '_cwd': os.getcwd()
        }
        config = ConfigParser(defaults=defaults)
        config.read(settings_filenames)
        self.log.debug(
            "Config file settings\n" +
            pformat(dict(config.items()))
        )
        for k, v in config.items('DEFAULT'):
            if not k.startswith('_'):
                settings[k.upper()] = v
        self.log.debug((
            settings,
            self.settings
        ))
        self.settings.update(settings)

    def format_subcommands(self):
        subcommands_text = []
        for cmd, data in _subcommands.items():
            subcommands_text.append(
                "    {name:{width}}{desc}".format(
                    name=cmd, width=12, desc=data[0]
                )
            )
        return "\n".join(subcommands_text)

    def process_args(self):
        args = docopt(self.__doc__, help=True, options_first=True)
        # Get logging option earlier in the process
        rootlog = logging.getLogger()
        if args['--debug']:
            rootlog.setLevel(logging.DEBUG)
        elif args['--verbose']:
            rootlog.setLevel(logging.INFO)
            self.app.debug = False
        self.log.debug(args)
        self.initialize(args['--debug'])
        self.log.debug("\n" + pformat(self.settings))
        try:
            _subcommands[args['<subcommand>']][1](self)
        except:
            self.log.exception(
                "Failed to load command '{cmd}'".format(
                    cmd=args['<subcommand>']
                )
            )

    @register_command("Install application")
    def install(self):
        self.db.create_all()

    @register_command("Populate database with random data")
    def populate(self):
        self.install()
        fusionglpi.models.assets.populate_db(self.db)

    @register_command("Start serving")
    def run(self):
        self.app.run(use_reloader=False)
