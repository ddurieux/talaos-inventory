from fusionglpi import db

class Ipaddress(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    is_dynamic = db.Column(db.Boolean, nullable=False, server_default="0")
    item_type = db.Column(db.String(100, None, True))
    item_id = db.Column(db.Integer, nullable=False, server_default="0")
    main_item_type = db.Column(db.String(100, None, True))
    main_item_id = db.Column(db.Integer, nullable=False, server_default="0")
    version = db.Column(db.Integer, nullable=False, server_default="0")
    binary_0 = db.Column(db.Integer, nullable=False, server_default="0")
    binary_1 = db.Column(db.Integer, nullable=False, server_default="0")
    binary_2 = db.Column(db.Integer, nullable=False, server_default="0")
    binary_3 = db.Column(db.Integer, nullable=False, server_default="0")
