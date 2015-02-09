from fusionglpi import db


class DeviceProcessor(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    busID = db.Column(db.String(255, None, True))
    frequency = db.Column(db.Integer, nullable=False, server_default="0")
    nbcores = db.Column(db.Integer, nullable=False, server_default="0")
    nbthreads = db.Column(db.Integer, nullable=False, server_default="0")
