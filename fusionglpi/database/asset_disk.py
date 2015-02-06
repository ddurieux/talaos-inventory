from fusionglpi import db

class AssetDisk(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    asset_id = db.Column(db.Integer, db.ForeignKey('asset.id'))
    name = db.Column(db.String(255, None, True))
    device = db.Column(db.String(255, None, True))
    mountpoint = db.Column(db.String(255, None, True))
    filesystem_id = db.Column(db.Integer, db.ForeignKey('filesystem.id'))
    totalsize = db.Column(db.Integer, nullable=False, server_default="0")
    freesize = db.Column(db.Integer, nullable=False, server_default="0")
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    is_dynamic = db.Column(db.Boolean, nullable=False, server_default="0")
