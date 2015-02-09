from fusionglpi import db


class LinkedContract(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    contract_id = db.Column(db.Integer, nullable=False, server_default="0")
    item_type = db.Column(db.String(100, None, True))
    item_id = db.Column(db.Integer, nullable=False, server_default="0")
