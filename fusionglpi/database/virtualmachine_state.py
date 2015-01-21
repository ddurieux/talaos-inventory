from fusionglpi import db

class VirtualmachineState(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    
    asset_virtualmachines = db.relationship('AssetVirtualmachine', backref='virtualmachine_state')
