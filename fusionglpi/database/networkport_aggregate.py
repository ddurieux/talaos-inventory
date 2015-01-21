from fusionglpi import db

class NetworkportAggregate(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    networkport_id = db.Column(db.Integer, db.ForeignKey('networkport.id'))
    networkport_list = db.Column(db.Text)
    
