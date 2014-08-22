import os
basedir = os.path.abspath(os.path.dirname(__file__))

SQLALCHEMY_DATABASE_URI = 'mysql+mysqlconnector://glping:glping@127.0.0.1/glping'

idle_timeout=3600
min_pool_size=1
max_pool_size=5000
max_overflow=-1
