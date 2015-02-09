from fusionglpi import db


class Supplier(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    supplier_type_id = db.Column(db.Integer, db.ForeignKey('supplier_type.id'))
    address = db.Column(db.Text)
    postcode = db.Column(db.String(255, None, True))
    town = db.Column(db.String(255, None, True))
    state = db.Column(db.String(255, None, True))
    country = db.Column(db.String(255, None, True))
    website = db.Column(db.String(255, None, True))
    phonenumber = db.Column(db.String(255, None, True))
    fax = db.Column(db.String(255, None, True))
    email = db.Column(db.String(255, None, True))

    infocoms = db.relationship('Infocom', backref='supplier')
