from fusionglpi import db


class SupplierType(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)

    suppliers = db.relationship('Supplier', backref='supplier_type')
