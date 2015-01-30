from fusionglpi import db

class Asset(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    asset_type_id = db.Column(db.Integer, db.ForeignKey('asset_type.id'))
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    is_dynamic = db.Column(db.Boolean, nullable=False, server_default="0")
    serial = db.Column(db.String(255, None, True))
    inventory_number = db.Column(db.String(255, None, True))
    manufacturer_id = db.Column(db.Integer, db.ForeignKey('manufacturer.id'))
    location_id = db.Column(db.Integer, db.ForeignKey('location.id'))
    state_id = db.Column(db.Integer, db.ForeignKey('state.id'))
    comment = db.Column(db.Text)
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    user_tech_id = db.Column(db.Integer, nullable=False, server_default="0")
    group_id = db.Column(db.Integer, db.ForeignKey('group.id'))
    group_tech_id = db.Column(db.Integer, nullable=False, server_default="0")
    
    asset_disks = db.relationship('AssetDisk', backref='asset')
    asset_displays = db.relationship('AssetDisplay', backref='asset')
    asset_powers = db.relationship('AssetPower', backref='asset')
    asset_printers = db.relationship('AssetPrinter', backref='asset')
    asset_virtualmachines = db.relationship('AssetVirtualmachine', backref='asset')
    cartridges = db.relationship('Cartridge', backref='asset')
    installed_software_versions = db.relationship('InstalledSoftwareVersion', backref='asset')
    used_software_licenses = db.relationship('UsedSoftwareLicense', backref='asset')
    networkports = db.relationship('Networkport', backref='asset')
    
    include_columns = ['id', 'name', 'serial']