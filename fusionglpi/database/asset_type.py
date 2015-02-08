from fusionglpi import db

class AssetType(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    collection_name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)

    assets = db.relationship('Asset', backref='asset_type')
