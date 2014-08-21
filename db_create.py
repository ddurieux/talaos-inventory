#!flask/bin/python
from migrate.versioning import api
from app.config import SQLALCHEMY_DATABASE_URI
from app import db
import os.path
db.create_all()
if not os.path.exists('app.database'):
    api.create('app.database', 'database repository')
    api.version_control(SQLALCHEMY_DATABASE_URI, 'app.database')
else:
    api.version_control(SQLALCHEMY_DATABASE_URI, 'app.database', api.version('app.database'))
