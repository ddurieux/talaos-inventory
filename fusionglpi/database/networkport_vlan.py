from fusionglpi import db


class NetworkportVlan(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    networkport_id = db.Column(db.Integer, db.ForeignKey('networkport.id'))
    vlan_id = db.Column(db.Integer, db.ForeignKey('vlan.id'))
    tagged = db.Column(db.Boolean, nullable=False, server_default="0")
