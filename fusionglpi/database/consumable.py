from fusionglpi import db


class Consumable(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    consumable_item_id = db.Column(db.Integer,
                                   db.ForeignKey('consumable_item.id'))
    date_in = db.Column(db.Date)
    date_out = db.Column(db.Date)
    item_type = db.Column(db.String(255, None, True))
    item_id = db.Column(db.Integer, nullable=False, server_default="0")
