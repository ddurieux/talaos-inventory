from fusionglpi import db

class Cartridge(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    cartridge_item_id = db.Column(db.Integer, db.ForeignKey('cartridge_item.id'))
    asset_id = db.Column(db.Integer, db.ForeignKey('asset.id'))
    date_in = db.Column(db.Date)
    date_use = db.Column(db.Date)
    date_out = db.Column(db.Date)
    pages = db.Column(db.Integer, nullable=False, server_default="0")
    
