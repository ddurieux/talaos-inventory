from fusionglpi import db

class DeviceCaseType(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    
    device_case_items = db.relationship('DeviceCaseItem', backref='device_case_type')
