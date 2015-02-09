from fusionglpi import db


class InterfaceType(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)

    device_control_items = db.relationship('DeviceControlItem',
                                           backref='interface_type')
    device_drive_items = db.relationship('DeviceDriveItem',
                                         backref='interface_type')
    device_graphiccard_items = db.relationship('DeviceGraphiccardItem',
                                               backref='interface_type')
    device_harddrive_items = db.relationship('DeviceHarddriveItem',
                                             backref='interface_type')
