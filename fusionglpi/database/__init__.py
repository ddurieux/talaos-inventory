import pkgutil
from fusionglpi import db

from pprint import pprint
__path__ = pkgutil.extend_path(__path__, __name__)

def register_models(manager):
    for importer, modname, ispkg in pkgutil.walk_packages(path=__path__, prefix=__name__+'.'):
          __import__(modname)

    for model in db.Model.__subclasses__():
        manager.create_api(model)

