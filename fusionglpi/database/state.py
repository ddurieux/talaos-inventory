from fusionglpi import db

class State(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    completename = db.Column(db.Text)
    level = db.Column(db.Integer, nullable=False, server_default="0")
    ancestors_cache = db.Column(db.Text)
    descendants_cache = db.Column(db.Text)

    assets = db.relationship('Asset', backref='state')
    software_versions = db.relationship('SoftwareVersion', backref='state')
