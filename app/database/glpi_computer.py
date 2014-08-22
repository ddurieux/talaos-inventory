from app import db

class Computer(db.Model):
    __tablename__ = 'glpi_computers'
    __table_args__ = { 'mysql_charset': 'utf8', 'mysql_collate': 'utf8_general_ci' }
    id = db.Column(db.Integer, primary_key=True)
    entities_id = db.Column(db.Integer, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    serial = db.Column(db.String(255, None, True))
    otherserial = db.Column(db.String(255, None, True))
    contact = db.Column(db.String(255, None, True))
    contact_num = db.Column(db.String(255, None, True))
    users_id_tech = db.Column(db.Integer, nullable=False, server_default="0")
    groups_id_tech = db.Column(db.Integer, nullable=False, server_default="0")
    comment = db.Column(db.Text)
    date_mod = db.Column(db.Date)
    operatingsystems_id = db.Column(db.Integer, db.ForeignKey('glpi_operatingsystems.id'))
    operatingsystemversions_id = db.Column(db.Integer, nullable=False, server_default="0")
    operatingsystemservicepacks_id = db.Column(db.Integer, nullable=False, server_default="0")
    os_license_number = db.Column(db.String(255, None, True))
    os_licenseid = db.Column(db.String(255, None, True))
    autoupdatesystems_id = db.Column(db.Integer, nullable=False, server_default="0")
    locations_id = db.Column(db.Integer, nullable=False, server_default="0")
    domains_id = db.Column(db.Integer, nullable=False, server_default="0")
    networks_id = db.Column(db.Integer, nullable=False, server_default="0")
    computermodels_id = db.Column(db.Integer, nullable=False, server_default="0")
    computertypes_id = db.Column(db.Integer, nullable=False, server_default="0")
    is_template = db.Column(db.Boolean, nullable=False, server_default="0")
    template_name = db.Column(db.String(255, None, True))
    manufacturers_id = db.Column(db.Integer, nullable=False, server_default="0")
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    is_dynamic = db.Column(db.Boolean, nullable=False, server_default="0")
    users_id = db.Column(db.Integer, nullable=False, server_default="0")
    groups_id = db.Column(db.Integer, nullable=False, server_default="0")
    states_id = db.Column(db.Integer, nullable=False, server_default="0")
    ticket_tco = db.Column(db.Numeric(precision="20,4", asdecimal=True), nullable=False, server_default="0.0000")
    uuid = db.Column(db.String(255, None, True))

    
