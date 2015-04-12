from talaos_inventory.models import common
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
    name = Column(String(120), index=True)


class AssetAsset(common.CommonColumns):
    id = Column(Integer, primary_key=True, autoincrement=True)
    asset_left = Column(Integer, ForeignKey('asset.id'))
    asset_right = Column(Integer, ForeignKey('asset.id'))


class AssetTypeProperty(common.CommonColumns):
    id = Column(Integer, primary_key=True, autoincrement=True)
    asset_type_id = Column(Integer, ForeignKey('asset_type.id'))
    name = Column(String(255))

    asset_type = relationship('AssetType', backref='asset_type_property')
    # __table_args__ = (Index('name', "name", "asset_type_id"), )


class PropertyName(common.CommonColumns):
    id = Column(Integer, primary_key=True, autoincrement=True)
    asset_type_property_id = Column(Integer,
                                    ForeignKey('asset_type_property.id'))
    name = Column(String(255))

    asset_type_property = relationship('AssetTypeProperty',
                                       backref='property_name')
    # __table_args__ = (Index('name', "name", "asset_type_property"), )


class AssetProperty(common.CommonColumns):
    id = Column(Integer, primary_key=True, autoincrement=True)
    asset_id = Column(Integer, ForeignKey('asset.id'))
    property_name_id = Column(Integer, ForeignKey('property_name.id'))

    asset = relationship('Asset', backref='asset_property')
    property_name = relationship('PropertyName', backref='asset_property')


def populate_db(db):
    for t in [
        'Computer',
        'Car',
        'MotherBoard',
        'Screen',
        'Harddisk',
        'Cpu',
        'Memory',
        'Software'
    ]:
        db.session.add(AssetType(name=t))
    asset_type = db.session.query(AssetType).filter_by(name='Computer').first()
    print(asset_type.jsonify(), asset_type)
    asset = Asset(name='Computer1')
    asset.asset_type = asset_type
    db.session.add(asset)
    db.session.commit()
    print([t.jsonify() for t in db.session.query(Asset).all()])
    asset_type = db.session.query(AssetType).filter_by(name='Computer').first()
    for t in [
        'serialnumber',
        'inventorynumber',
        'comment',
        'uuid',
        'state',
        'manufacturer'
    ]:
        db.session.add(AssetTypeProperty(asset_type=asset_type, name=t))
        db.session.commit()
    asset_type = db.session.query(AssetType).filter_by(name='Car').first()
    for t in [
        'color',
        'nb_door',
        'engine_place',
        'nb_seat',
        'is_automatic clutch',
        'fuel_type',
        'manufacturer'
    ]:
        db.session.add(AssetTypeProperty(asset_type=asset_type, name=t))
        db.session.commit()
    asset_type = db.session.query(AssetType).filter_by(
        name='MotherBoard').first()
    for t in [
        'nb_cpu_slot',
        'nb_memory_slot',
        'nb_sata_port',
        'nb_ide_port',
        'nb_pci_port',
        'nb_pci_e_1x_port',
        'nb_pci_e_16x_port',
        'nb_usb_port',
        'nb_vga_port',
        'nb_hdmi_port',
        'nb_rj45',
        'manufacturer',
        'serialnumber',
        'model'
    ]:
        db.session.add(AssetTypeProperty(asset_type=asset_type, name=t))
        db.session.commit()
    asset_type = db.session.query(AssetType).filter_by(name='Screen').first()
    for t in [
        'resolution_max',
        'nb_usb_port',
        'is_vga',
        'is_hdmi',
        'is_sound',
        'size',
        'manufacturer',
        'technology',
        'state'
    ]:
        db.session.add(AssetTypeProperty(asset_type=asset_type, name=t))
        db.session.commit()
    asset_type = db.session.query(AssetType).filter_by(name='Harddisk').first()
    for t in [
        'model',
        'serialnumber',
        'technology',
        'interface',
        'externalsize',
        'disksize',
        'nb_tray',
        'chipset',
        'state',
        'firmware',
        'wwn'
    ]:
        db.session.add(AssetTypeProperty(asset_type=asset_type, name=t))
        db.session.commit()
    asset_type = db.session.query(AssetType).filter_by(name='Cpu').first()
    for t in [
        'cache',
        'nb_core',
        'description',
        'manufacturer',
        'name',
        'nb_thread',
        'serialnumber',
        'stepping',
        'familyname',
        'famillynumber',
        'model',
        'speed',
        'cpuid',
        'external_clock',
        'architecture'
    ]:
        db.session.add(AssetTypeProperty(asset_type=asset_type, name=t))
        db.session.commit()
    asset_type = db.session.query(AssetType).filter_by(name='Memory').first()
    for t in [
        'capacity',
        'caption',
        'is_removable',
        'speed',
        'serialnumber',
        'type',
        'description',
        'slot_number',
        'memorycorrection',
        'manufacturer'
    ]:
        db.session.add(AssetTypeProperty(asset_type=asset_type, name=t))
        db.session.commit()
    asset_type = db.session.query(AssetType).filter_by(name='Software').first()
    for t in [
        'comments',
        'version',
        'filesize',
        'folder',
        'from',
        'installdate',
        'no_remove',
        'release_type',
        'publisher',
        'uninstall_string',
        'url_info_about',
        'version_minor',
        'version_major',
        'guid',
        'arch',
        'username',
        'userid'
    ]:
        db.session.add(AssetTypeProperty(asset_type=asset_type, name=t))
        db.session.commit()
