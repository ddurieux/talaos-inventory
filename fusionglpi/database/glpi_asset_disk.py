from fusionglpi import db

class DBAsset(db.Model):
    __tablename__ = 'glpi_assets'
    __table_args__ = { 'mysql_charset': 'utf8', 'mysql_collate': 'utf8_general_ci' }
    id = db.Column(db.Integer, primary_key=True)
    entities_id = db.Column(db.Integer, db.ForeignKey('glpi_entities.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    assettypes_id = db.Column(db.Integer, db.ForeignKey('glpi_assettypes.id'))
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    is_dynamic = db.Column(db.Boolean, nullable=False, server_default="0")
    serial = db.Column(db.String(255, None, True))
    inventory_number = db.Column(db.String(255, None, True))
    manufacturers_id = db.Column(db.Integer, db.ForeignKey('glpi_manufacturers.id'))
    locations_id = db.Column(db.Integer, db.ForeignKey('glpi_locations.id'))
    states_id = db.Column(db.Integer, db.ForeignKey('glpi_states.id'))
    comment = db.Column(db.Text)
    assets_id = db.Column(db.Integer, db.ForeignKey('glpi_assets.id'))
    users_id = db.Column(db.Integer, db.ForeignKey('glpi_users.id'))
    user_techs_id = db.Column(db.Integer, db.ForeignKey('glpi_user_techs.id'))
    groups_id = db.Column(db.Integer, db.ForeignKey('glpi_groups.id'))
    group_techs_id = db.Column(db.Integer, db.ForeignKey('glpi_groups_techs.id'))
    
    
