from fusionglpi import db

class ConsumableItem(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    ref = db.Column(db.String(255, None, True))
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    manufacturer_id = db.Column(db.Integer, db.ForeignKey('manufacturer.id'))
    comment = db.Column(db.Text)
    location_id = db.Column(db.Integer, db.ForeignKey('location.id'))
    user_tech_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    group_tech_id = db.Column(db.Integer, db.ForeignKey('group.id'))
    consumable_itemtype_id = db.Column(db.Integer, db.ForeignKey('consumable_itemtype.id'))
    alarm_threshold = db.Column(db.Integer, nullable=False, server_default="10")

    consumables = db.relationship('Consumable', backref='consumable_item')
