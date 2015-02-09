from fusionglpi import db


class Vlan(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    tag = db.Column(db.Integer, nullable=False, server_default="0")

    networkport_vlans = db.relationship('NetworkportVlan', backref='vlan')
