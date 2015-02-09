from fusionglpi import db

printer_models = db.Table('cartridge_compatibility',
                          db.Column('cartridge_item_id', db.Integer,
                                    db.ForeignKey('cartridge_item.id')),
                          db.Column('printer_model_id', db.Integer,
                                    db.ForeignKey('printer_model.id'))
                          )


class CartridgeItem(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, nullable=False, server_default="0")
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    manufacturer_id = db.Column(db.Integer, nullable=False,
                                server_default="0")
    comment = db.Column(db.Text)
    location_id = db.Column(db.Integer, nullable=False, server_default="0")
    user_tech_id = db.Column(db.Integer, nullable=False, server_default="0")
    group_tech_id = db.Column(db.Integer, nullable=False, server_default="0")
    cartridge_item_type_id = db.Column(db.Integer, nullable=False,
                                       server_default="0")
    alarm_threshold = db.Column(db.Integer, nullable=False,
                                server_default="10")

    cartridges = db.relationship('Cartridge', backref='cartridge_item')
    printer_models = db.relationship('PrinterModel',
                                     secondary=printer_models,
                                     backref=db.backref('cartridge_item',
                                                        lazy='dynamic'))
