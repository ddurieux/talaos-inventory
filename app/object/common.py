from math import *
from datetime import *
from decimal import *

class Common(object):
    "Common class with all common functions"

    def conv__dict__(self, c, d = {}, typeString = type(Decimal(1.1))):
        e = c.__dict__
        d[e['id']] = e.copy()
        for key, value in e.items():
            if '_sa_instance_state' in key:
                del d[e['id']]['_sa_instance_state']
            if type(value) in (datetime, date):
                d[e['id']][key] = value.isoformat()
            elif type(value) == typeString:
                d[e['id']][key] = str(value)
        return d

    def row2dict(self, row):
        "Convert SQLAlchemy object to dictionnary"
        i = Decimal(1.1)
        typeString = type(i)
        d = {}
        for c in row:
            d = self.conv__dict__(c, d, typeString)
        return d
    
    def getall(self):
        "Get all items"
        return self.row2dict(self.dbclass.query.all())

    def getid(self, id):
        "Get only one item defined by id"
        return self.conv__dict__(self.dbclass.query.get(id))

