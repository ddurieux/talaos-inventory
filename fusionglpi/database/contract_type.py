from fusionglpi import db

class ContractType(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    
    contracts = db.relationship('Contract', backref='contract_type')
