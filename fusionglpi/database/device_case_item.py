from fusionglpi import db

class DeviceCaseItem(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    manufacturer_id = db.Column(db.Integer, db.ForeignKey('manufacturer.id'))
    comment = db.Column(db.Text)
    device_case_type_id = db.Column(db.Integer, db.ForeignKey('device_case_type.id'))