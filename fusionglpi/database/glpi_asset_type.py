from fusionglpi import db

class DBAsset_Type(db.Model):
    __tablename__ = 'glpi_asset_types'
    __table_args__ = { 'mysql_charset': 'utf8', 'mysql_collate': 'utf8_general_ci' }
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    
    
