from fusionglpi import db

class ConsumableItemtype(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    
    consumable_items = db.relationship('ConsumableItem', backref='consumable_itemtype')
