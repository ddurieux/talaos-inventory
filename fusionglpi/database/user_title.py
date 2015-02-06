from fusionglpi import db

class UserTitle(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)

    users = db.relationship('User', backref='user_title')
