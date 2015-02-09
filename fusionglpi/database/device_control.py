from fusionglpi import db


class DeviceControl(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    busID = db.Column(db.String(255, None, True))
