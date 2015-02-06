from fusionglpi import db

class Blacklist(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    type = db.Column(db.Integer, nullable=False, server_default="0")
    value = db.Column(db.String(255, None, True))
