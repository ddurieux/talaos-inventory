from fusionglpi import db


class Netpoint(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    location_id = db.Column(db.Integer, db.ForeignKey('location.id'))
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)

    networkport_ethernets = db.relationship('NetworkportEthernet',
                                            backref='netpoint')
