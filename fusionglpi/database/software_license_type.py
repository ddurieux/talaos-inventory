from fusionglpi import db

class SoftwareLicenseType(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    
    software_licenses = db.relationship('SoftwareLicense', backref='software_license_type')
