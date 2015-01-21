from fusionglpi import db

class NetworkportEthernet(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    networkport_id = db.Column(db.Integer, db.ForeignKey('networkport.id'))
    device_networkcard_id = db.Column(db.Integer, db.ForeignKey('device_networkcard.id'))
    netpoint_id = db.Column(db.Integer, db.ForeignKey('netpoint.id'))
    type = db.Column(db.String(255, None, True))
    speed = db.Column(db.Integer, nullable=False, server_default="10")
