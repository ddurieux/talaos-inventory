from fusionglpi import db


class Manufacturer(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)

    assets = db.relationship('Asset', backref='manufacturer')
    consumable_items = db.relationship('ConsumableItem',
                                       backref='manufacturer')
    device_case_items = db.relationship('DeviceCaseItem',
                                        backref='manufacturer')
    device_control_items = db.relationship('DeviceControlItem',
                                           backref='manufacturer')
    device_drive_items = db.relationship('DeviceDriveItem',
                                         backref='manufacturer')
    device_graphiccard_items = db.relationship('DeviceGraphiccardItem',
                                               backref='manufacturer')
    device_harddrive_items = db.relationship('DeviceHarddriveItem',
                                             backref='manufacturer')
    device_memory_items = db.relationship('DeviceMemoryItem',
                                          backref='manufacturer')
    device_motherboard_items = db.relationship('DeviceMotherboardItem',
                                               backref='manufacturer')
    device_networkcard_items = db.relationship('DeviceNetworkcardItem',
                                               backref='manufacturer')
    device_pci_items = db.relationship('DevicePciItem', backref='manufacturer')
    device_powersupply_items = db.relationship('DevicePowersupplyItem',
                                               backref='manufacturer')
    device_processor_items = db.relationship('DeviceProcessorItem',
                                             backref='manufacturer')
    device_soundcard_items = db.relationship('DeviceSoundcardItem',
                                             backref='manufacturer')
    softwares = db.relationship('Software', backref='manufacturer')
