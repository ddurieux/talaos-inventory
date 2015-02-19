import pkgutil
from importlib import import_module
import logging
from pprint import pformat  # noqa

from sqlalchemy import inspect
from eve_sqlalchemy.decorators import registerSchema

from fusionglpi.models import common


log = logging.getLogger(__name__)


def register_models():
    DOMAIN = {}
    files = pkgutil.walk_packages(path=__path__, prefix=__name__ + '.')
    for importer, modname, ispkg in files:
        import_module(modname)

    for model in common.CommonColumns.__subclasses__():
        relationships = inspect(model).relationships.keys()
        log.debug(pformat(relationships))
        registerSchema(model.__tablename__)(model)
        DOMAIN[model.__tablename__] = model._eve_schema[model.__tablename__]
    return DOMAIN
