from fusionglpi import db

class Wifinetwork(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    essid = db.Column(db.String(255, None, True))
    mode = db.Column(db.String(255, None, True))

    networkport_wifis = db.relationship('NetworkportWifi', backref='wifinetwork')
