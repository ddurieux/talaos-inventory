from fusionglpi import db


class Location(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    completename = db.Column(db.Text)
    level = db.Column(db.Integer, nullable=False, server_default="0")
    ancestors_cache = db.Column(db.Text)
    descendants_cache = db.Column(db.Text)
    building = db.Column(db.String(255, None, True))
    latitude = db.Column(db.String(255, None, True))
    longitude = db.Column(db.String(255, None, True))
    altitude = db.Column(db.String(255, None, True))
    building = db.Column(db.String(255, None, True))

    assets = db.relationship('Asset', backref='location')
    consumable_items = db.relationship('ConsumableItem', backref='location')
    netpoints = db.relationship('Netpoint', backref='location')
    softwares = db.relationship('Software', backref='location')
    users = db.relationship('User', backref='location')
