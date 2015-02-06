from fusionglpi import db

class DeviceMemoryType(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)

    device_memory_items = db.relationship('DeviceMemoryItem', backref='device_memory_type')
