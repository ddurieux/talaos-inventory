from fusionglpi import db


class LinkedVlan(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    vlan_id = db.Column(db.Integer, nullable=False, server_default="0")
    ip_network_id = db.Column(db.Integer, nullable=False, server_default="0")
