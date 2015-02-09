from fusionglpi import db

class Software(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    is_template = db.Column(db.Boolean, nullable=False, server_default="0")
    template_name = db.Column(db.String(255, None, True))
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    user_tech_id = db.Column(db.Integer, nullable=False, server_default="0")
    group_id = db.Column(db.Integer, db.ForeignKey('group.id'))
    group_tech_id = db.Column(db.Integer, nullable=False, server_default="0")
    location_id = db.Column(db.Integer, db.ForeignKey('location.id'))
    software_id = db.Column(db.Integer, db.ForeignKey('software.id'))
    software_category_id = db.Column(db.Integer, db.ForeignKey('software_category.id'))
    manufacturer_id = db.Column(db.Integer, db.ForeignKey('manufacturer.id'))
    is_update = db.Column(db.Boolean, nullable=False, server_default="0")
    is_helpdesk_visible = db.Column(db.Boolean, nullable=False, server_default="0")
    is_valid = db.Column(db.Boolean, nullable=False, server_default="0")
    ticket_tco = db.Column(db.Float)

    #softwares = db.relationship('Software', backref='software')
    software_licenses = db.relationship('SoftwareLicense', backref='software')
    software_versions = db.relationship('SoftwareVersion', backref='software')