from fusionglpi import db

class UsedSoftwareLicense(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    asset_id = db.Column(db.Integer, db.ForeignKey('asset.id'))
    software_license_id = db.Column(db.Integer, db.ForeignKey('software_license.id'))
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    is_dynamic = db.Column(db.Boolean, nullable=False, server_default="0")
