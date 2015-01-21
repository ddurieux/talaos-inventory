from fusionglpi import db

class InstalledSoftwareVersion(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    asset_id = db.Column(db.Integer, db.ForeignKey('asset.id'))
    software_version_id = db.Column(db.Integer, db.ForeignKey('software_version.id'))
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    is_dynamic = db.Column(db.Boolean, nullable=False, server_default="0")
    is_deleted_asset = db.Column(db.Boolean, nullable=False, server_default="0")
    is_template_asset = db.Column(db.Boolean, nullable=False, server_default="0")
