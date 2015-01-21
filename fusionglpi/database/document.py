from fusionglpi import db

class Document(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    filename = db.Column(db.String(255, None, True))
    filepath = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    document_category_id = db.Column(db.Integer, db.ForeignKey('document_category.id'))
    mime = db.Column(db.String(255, None, True))
    link = db.Column(db.String(255, None, True))
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    #ticket_id = db.Column(db.Integer, db.ForeignKey('ticket.id'))
    sha1sum = db.Column(db.String(255, None, True))
    is_blacklisted = db.Column(db.Boolean, nullable=False, server_default="0")
    tag = db.Column(db.String(255, None, True))
