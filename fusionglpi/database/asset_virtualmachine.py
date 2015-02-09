from fusionglpi import db


class AssetVirtualmachine(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    asset_id = db.Column(db.Integer, db.ForeignKey('asset.id'))
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    uuid = db.Column(db.String(255, None, True))
    virtualmachine_state_id = db.Column(
        db.Integer,
        db.ForeignKey('virtualmachine_state.id')
    )
    virtualmachine_system_id = db.Column(
        db.Integer,
        db.ForeignKey('virtualmachine_system.id')
    )
    virtualmachine_type_id = db.Column(
        db.Integer,
        db.ForeignKey('virtualmachine_type.id')
    )
    vcpu = db.Column(db.Integer, nullable=False, server_default="0")
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    is_dynamic = db.Column(db.Boolean, nullable=False, server_default="0")
    ram = db.Column(db.String(255, None, True))
