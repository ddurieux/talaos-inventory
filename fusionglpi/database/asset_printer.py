from fusionglpi import db


class AssetPrinter(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    asset_id = db.Column(db.Integer, db.ForeignKey('asset.id'))
    printer_type_id = db.Column(db.Integer, db.ForeignKey('printer_type.id'))
    printer_model_id = db.Column(db.Integer, db.ForeignKey('printer_model.id'))
    init_pages_counter = db.Column(db.Integer, nullable=False,
                                   server_default="0")
    last_pages_counter = db.Column(db.Integer, nullable=False,
                                   server_default="0")
