from fusionglpi import db

class PrinterType(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)

    asset_printers = db.relationship('AssetPrinter', backref='prin_type')
