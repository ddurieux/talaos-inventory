# -*- coding: utf-8 -*-

import os
import sys
from pprint import pprint, pformat
from docopt import docopt

from fusionglpi.main import Application

import logging
logging.basicConfig(logLevel=logging.DEBUG)
log = logging.getLogger()

__doc__ = """FusionGLPI
Usage:
    fusionglpi [ -d | -v | -q ] <command>

Options:
    -q, --quiet     Quiet mode
    -v, --verbose   Verbose mode
    -d, --debug     Debug mode

Commands:
    install     Perfom basic setup of application.
    check       Run some checks against database.
    configure   Configure parts of the application.
    seed        Fill up the database with some random values.
"""


def main():
    args = docopt(__doc__)
    if args["--quiet"]:
        log.setLevel(logging.CRITICAL)
    elif args["--verbose"]:
        log.setLevel(logging.INFO)
    elif args["--debug"]:
        log.setLevel(logging.DEBUG)
    log.debug("command's arguments => {}".format(pformat(args)))
    app = Application()
    return app.process_command(args['<command>'])
