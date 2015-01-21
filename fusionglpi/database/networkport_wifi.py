from fusionglpi import db

class NetworkportWifi(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    networkport_id = db.Column(db.Integer, db.ForeignKey('networkport.id'))
    device_networkcard_id = db.Column(db.Integer, db.ForeignKey('device_networkcard.id'))
    wifinetwork_id = db.Column(db.Integer, db.ForeignKey('wifinetwork.id'))
    networkport_wifi_id = db.Column(db.Integer, db.ForeignKey('networkport_wifi.id'))
    version = db.Column(db.String(255, None, True))
    mode = db.Column(db.String(255, None, True))

    networkport_wifis = db.relationship('NetworkportWifi', backref='networkport_wifi')
