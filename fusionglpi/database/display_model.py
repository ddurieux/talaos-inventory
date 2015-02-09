from fusionglpi import db


class DisplayModel(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)

    asset_displays = db.relationship('AssetDisplay', backref='display_model')
