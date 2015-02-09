from fusionglpi import db


class Notepad(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    item_type = db.Column(db.String(100, None, True))
    item_id = db.Column(db.Integer, nullable=False, server_default="0")
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    user_lastupdater_id = db.Column(db.Integer, nullable=False,
                                    server_default="0")
    content = db.Column(db.Text)
