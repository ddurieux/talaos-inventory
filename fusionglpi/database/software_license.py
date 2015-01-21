from fusionglpi import db

class SoftwareLicense(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    software_id = db.Column(db.Integer, db.ForeignKey('software.id'))
    software_license_type_id = db.Column(db.Integer, db.ForeignKey('software_license_type.id'))
    number = db.Column(db.Integer, nullable=False, server_default="0")
    serial = db.Column(db.String(255, None, True))
    inventory_number = db.Column(db.String(255, None, True))
    software_version_buy_id = db.Column(db.Integer, db.ForeignKey('software_version.id'))
    software_version_use_id = db.Column(db.Integer, db.ForeignKey('software_version.id'))
    is_valid = db.Column(db.Boolean, nullable=False, server_default="0")
    expire = db.Column(db.Date)

    used_software_licenses = db.relationship('UsedSoftwareLicense', backref='software_license')
