from fusionglpi import db

class Config(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    version = db.Column(db.String(255, None, True))
