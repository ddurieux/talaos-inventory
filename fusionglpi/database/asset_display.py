from fusionglpi import db

class AssetDisplay(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    asset_id = db.Column(db.Integer, db.ForeignKey('asset.id'))
    size = db.Column(db.Integer, nullable=False, server_default="0")
    display_type_id = db.Column(db.Integer, db.ForeignKey('display_type.id'))
    display_model_id = db.Column(db.Integer, db.ForeignKey('display_model.id'))
    have_subd = db.Column(db.Boolean, nullable=False, server_default="0")
    have_bnc = db.Column(db.Boolean, nullable=False, server_default="0")
    have_vga = db.Column(db.Boolean, nullable=False, server_default="0")
    have_dvi = db.Column(db.Boolean, nullable=False, server_default="0")
    have_displayport = db.Column(db.Boolean, nullable=False, server_default="0")
