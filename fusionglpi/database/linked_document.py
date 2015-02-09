from fusionglpi import db


class LinkedDocument(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    document_id = db.Column(db.Integer, nullable=False, server_default="0")
    item_type = db.Column(db.String(100, None, True))
    item_id = db.Column(db.Integer, nullable=False, server_default="0")
