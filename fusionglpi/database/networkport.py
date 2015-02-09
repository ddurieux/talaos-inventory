from fusionglpi import db


class Networkport(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    is_dynamic = db.Column(db.Boolean, nullable=False, server_default="0")
    asset_id = db.Column(db.Integer, db.ForeignKey('asset.id'))
    networkport_id = db.Column(db.Integer, db.ForeignKey('networkport.id'))
    logical_number = db.Column(db.Integer, nullable=False, server_default="0")
    instantiation_type = db.Column(db.String(255, None, True))
    mac = db.Column(db.String(255, None, True))

    # networkports = db.relationship('Networkport', backref='networkport')
    networkport_aggregates = db.relationship('NetworkportAggregate',
                                             backref='networkport')
    networkport_alias = db.relationship('NetworkportAlias',
                                        backref='networkport')
    networkport_dialups = db.relationship('NetworkportDialup',
                                          backref='networkport')
    networkport_ethernets = db.relationship('NetworkportEthernet',
                                            backref='networkport')
    networkport_locals = db.relationship('NetworkportLocal',
                                         backref='networkport')
    networkport_vlans = db.relationship('NetworkportVlan',
                                        backref='networkport')
    networkport_wifis = db.relationship('NetworkportWifi',
                                        backref='networkport')
