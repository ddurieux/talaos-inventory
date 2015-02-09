from fusionglpi import db


class Group(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    ldap_field = db.Column(db.String(255, None, True))
    ldap_value = db.Column(db.Text)
    ldap_group_dn = db.Column(db.Text)
    group_id = db.Column(db.Integer, db.ForeignKey('group.id'))
    completename = db.Column(db.Text)
    level = db.Column(db.Integer, nullable=False, server_default="0")
    ancestors_cache = db.Column(db.Text)
    descendants_cache = db.Column(db.Text)
    is_requester = db.Column(db.Boolean, nullable=False, server_default="0")
    is_assign = db.Column(db.Boolean, nullable=False, server_default="0")
    is_notify = db.Column(db.Boolean, nullable=False, server_default="0")
    is_itemgroup = db.Column(db.Boolean, nullable=False, server_default="0")
    is_usergroup = db.Column(db.Boolean, nullable=False, server_default="0")
    is_manager = db.Column(db.Boolean, nullable=False, server_default="0")

    assets = db.relationship('Asset', backref='group')
    consumable_items = db.relationship('ConsumableItem', backref='group')
    # groups = db.relationship('Group', backref='group')
    softwares = db.relationship('Software', backref='group')
