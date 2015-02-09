from fusionglpi import db


class Budget(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    begin_date = db.Column(db.Date)
    end_date = db.Column(db.Date)
    value = db.Column(db.Float, nullable=False, server_default="0")
    is_template = db.Column(db.Boolean, nullable=False, server_default="0")
    template_name = db.Column(db.String(255, None, True))

    infocoms = db.relationship('Infocom', backref='budget')
