from fusionglpi import db

class Operatingsystem(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)

    software_versions = db.relationship('SoftwareVersion', backref='operatingsystem_')
