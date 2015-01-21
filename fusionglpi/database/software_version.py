from fusionglpi import db

class SoftwareVersion(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    software_id = db.Column(db.Integer, db.ForeignKey('software.id'))
    state_id = db.Column(db.Integer, db.ForeignKey('state.id'))
    operatingsystem_id = db.Column(db.Integer, db.ForeignKey('operatingsystem.id'))

    installed_software_versions = db.relationship('InstalledSoftwareVersion', backref='software_version')
