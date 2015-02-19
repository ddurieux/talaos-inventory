from fusionglpi.models import common
from sqlalchemy import (  # noqa
    Column,
    String,
    Integer,
    ForeignKey,
    DateTime,
)
from sqlalchemy.orm import relationship, backref  # noqa


class Asset(common.CommonColumns):
    id = Column(Integer, primary_key=True, autoincrement=True)
    name = Column(String(120))
    asset_type_id = Column(Integer, ForeignKey('asset_type.id'))
    asset_type = relationship('AssetType', backref='asset')


class AssetType(common.CommonColumns):
    id = Column(Integer, primary_key=True, autoincrement=True)
    name = Column(String(120))


def populate_db(db):
    for t in [
        'Computer',
        'Car',
        'MotherBoard',
        'Screen'

    ]:
        db.session.add(AssetType(name=t))
    asset_type = db.session.query(AssetType).filter_by(name='Computer').first()
    print(asset_type.jsonify(), asset_type)
    asset = Asset(name='Computer1')
    asset.asset_type = asset_type
    db.session.add(asset)
    db.session.commit()
    print([t.jsonify() for t in db.session.query(Asset).all()])
