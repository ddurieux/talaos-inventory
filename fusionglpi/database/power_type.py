from fusionglpi import db

class PowerType(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)

    asset_powers = db.relationship('AssetPower', backref='power_type')
