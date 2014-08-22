#!flask/bin/python
from datetime import timedelta
from flask import Flask, jsonify, abort, request, make_response, url_for, current_app
import flask.ext.restless
from functools import update_wrapper
from app import db
import sys

#import all modules in glpi.objects
from app.database import *

app = Flask(__name__, static_url_path = "")

manager = flask.ext.restless.APIManager(app, flask_sqlalchemy_db=db)

# Create API endpoints, which will be available at /api/<tablename> by
# default. Allowed HTTP methods can be specified as well.
manager.create_api(glpi_computer.Computer, methods=['GET', 'POST', 'DELETE'])
