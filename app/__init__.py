from flask import Flask
#from flask.ext.sqlalchemy import SQLAlchemy
from flask.ext.sqlalchemy import SQLAlchemy
import flask.ext.restless

app = Flask(__name__)
app.config.from_object('app.config')
db = SQLAlchemy(app)

from app.database import *



