from fusionglpi import db


class NetworkportAlias(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    networkport_id = db.Column(db.Integer, db.ForeignKey('networkport.id'))
    networkport_alias_id = db.Column(db.Integer, nullable=False,
                                     server_default="0")
