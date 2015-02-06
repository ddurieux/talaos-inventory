from fusionglpi import db

class DeviceNetworkcard(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    busID = db.Column(db.String(255, None, True))
    mac = db.Column(db.String(255, None, True))

    networkport_ethernets = db.relationship('NetworkportEthernet', backref='device_networkcard')
    networkport_wifis = db.relationship('NetworkportWifi', backref='device_networkcard')
