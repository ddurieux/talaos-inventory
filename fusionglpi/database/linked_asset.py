from fusionglpi import db


class LinkedAsset(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    asset_id_1 = db.Column(db.Integer, nullable=False, server_default="0")
    asset_id_2 = db.Column(db.Integer, nullable=False, server_default="0")
