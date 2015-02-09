from fusionglpi import db


class AssetPower(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    asset_id = db.Column(db.Integer, db.ForeignKey('asset.id'))
    power_type_id = db.Column(db.Integer, db.ForeignKey('power_type.id'))
    energy_type_id = db.Column(db.Integer, db.ForeignKey('energy_type.id'))
    is_redondant = db.Column(db.Boolean, nullable=False, server_default="0")
