from flask import Flask

from flask.ext.restless import APIManager

from fusionglpi.log import Log
from fusionglpi.database import register_models

from fusionglpi import db


class Application(Log):

    def __init__(self):
        super().__init__()
        self.log.debug("Initialization")

        self.app = Flask(__package__)

        # TODO: load configuration files here
        self.app.config['DEBUG'] = True
        self.app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:////tmp/test.db'

        self.db = db
        self.db.init_app(self.app)

        self.log.debug("database : {}".format(self.db))
        self.manager = APIManager(self.app, self.db)
        register_models(self.manager)

    def list_routes(self):
        for route in self.app.url_map.iter_rules():
            self.log.debug(route)

    def process_command(self, command):
        try:
            method = getattr(self, command)
            return method()
        except Exception:
            self.log.exception("Command '{}' error!".format(command))
            return -1

    def install(self):
        self.log.debug('Installation')
        with self.app.app_context():
            self.db.create_all()

    def seed(self):
        pass

    def check(self):
        self.list_routes()

    def run(self):
        try:
            self.check()
            return self.app.run(debug=True)
        except:
            self.log.exception('Check failed')
