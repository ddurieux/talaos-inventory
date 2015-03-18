from pprint import pformat, pprint  # noqa
import re
import logging

from sqlalchemy import inspect
from sqlalchemy.ext import hybrid
from sqlalchemy.ext.hybrid import hybrid_property
from sqlalchemy.orm import column_property, relationship  # noqa
from sqlalchemy import func
from sqlalchemy import (  # noqa
    Column,
    String,
    Integer,
    ForeignKey,
    DateTime,
)
from sqlalchemy.ext.declarative import declarative_base, declared_attr

log = logging.getLogger(__name__)

Base = declarative_base()

snake_case_re = re.compile('((?<=[a-z0-9])[A-Z]|(?!^)[A-Z](?=[a-z]))')


class CommonColumns(Base):
    __abstract__ = True
    _created = Column(DateTime, default=func.now())
    _updated = Column(DateTime, default=func.now(), onupdate=func.now())
    _etag = Column(String(40))

    @hybrid_property
    def _id(self):
        """
        Eve backward compatibility
        """
        return self.id

    @declared_attr
    def __tablename__(cls):
        return snake_case_re.sub(r'_\1', cls.__name__).lower()

    def jsonify(self):
        """
        Used to dump related objects to json
        """
        relationships = inspect(self.__class__).relationships.keys()
        mapper = inspect(self)
        attrs = [
            a.key for a in mapper.attrs
            if a.key not in relationships and
            a.key not in mapper.expired_attributes
        ]
        attrs += [
            a.__name__
            for a in inspect(self.__class__).all_orm_descriptors
            if a.extension_type is hybrid.HYBRID_PROPERTY
        ]
        log.debug("{}".format(self.__class__.__name__))
        log.debug(pformat(attrs))
        return dict([(c, getattr(self, c, None)) for c in attrs])

    def register(self):
        pprint(self.__class__)
        pprint(self.__tablename__)
