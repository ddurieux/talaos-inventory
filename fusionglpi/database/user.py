from fusionglpi import db

class User(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    password = db.Column(db.String(255, None, True))
    phone = db.Column(db.String(255, None, True))
    phone2 = db.Column(db.String(255, None, True))
    mobile = db.Column(db.String(255, None, True))
    realname = db.Column(db.String(255, None, True))
    firstname = db.Column(db.String(255, None, True))
    location_id = db.Column(db.Integer, db.ForeignKey('location.id'))
    language = db.Column(db.String(255, None, True))
    use_mode = db.Column(db.Integer, nullable=False, server_default="0")
    list_limit = db.Column(db.Integer, nullable=False, server_default="0")
    is_active = db.Column(db.Boolean, nullable=False, server_default="0")
    #auth_id = db.Column(db.Integer, db.ForeignKey('auth.id'))
    authtype = db.Column(db.Integer, nullable=False, server_default="0")
    last_login = db.Column(db.DateTime)
    date_sync = db.Column(db.DateTime)
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    #profile_id = db.Column(db.Integer, db.ForeignKey('profile.id'))
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    user_title_id = db.Column(db.Integer, db.ForeignKey('user_title.id'))
    user_category_id = db.Column(db.Integer, db.ForeignKey('user_category.id'))
    date_format = db.Column(db.Integer, nullable=False, server_default="0")
    number_format = db.Column(db.Integer, nullable=False, server_default="0")
    names_format = db.Column(db.Integer, nullable=False, server_default="0")
    csv_delimiter = db.Column(db.String(255, None, True))
    is_ids_visible = db.Column(db.Boolean, nullable=False, server_default="0")
    dropdown_chars_limit = db.Column(db.Integer, nullable=False, server_default="0")
    use_flat_dropdowntree = db.Column(db.Boolean, nullable=False, server_default="0")
    show_jobs_at_login = db.Column(db.Boolean, nullable=False, server_default="0")
    priority_1 = db.Column(db.String(255, None, True))
    priority_2 = db.Column(db.String(255, None, True))
    priority_3 = db.Column(db.String(255, None, True))
    priority_4 = db.Column(db.String(255, None, True))
    priority_5 = db.Column(db.String(255, None, True))
    priority_6 = db.Column(db.String(255, None, True))
    followup_private = db.Column(db.Boolean, nullable=False, server_default="0")
    task_private = db.Column(db.Boolean, nullable=False, server_default="0")
    default_requesttype_id = db.Column(db.Integer, nullable=False, server_default="0")
    password_forget_token = db.Column(db.String(255, None, True))
    password_forget_token_date = db.Column(db.DateTime)
    user_dn = db.Column(db.Text)
    registration_number = db.Column(db.String(255, None, True))
    show_count_on_tabs = db.Column(db.Boolean, nullable=False, server_default="0")
    refresh_ticket_list = db.Column(db.Integer, nullable=False, server_default="0")
    set_default_tech = db.Column(db.Boolean, nullable=False, server_default="0")
    personal_token = db.Column(db.String(255, None, True))
    personal_token_date = db.Column(db.DateTime)
    display_count_on_home = db.Column(db.Integer, nullable=False, server_default="0")
    notification_to_myself = db.Column(db.Boolean, nullable=False, server_default="0")
    duedateok_color = db.Column(db.String(255, None, True))
    duedatewarning_color = db.Column(db.String(255, None, True))
    duedatecritical_color = db.Column(db.String(255, None, True))
    duedatewarning_less = db.Column(db.Integer, nullable=False, server_default="0")
    duedatecritical_less = db.Column(db.Integer, nullable=False, server_default="0")
    duedatewarning_unit = db.Column(db.String(255, None, True))
    duedatecritical_unit = db.Column(db.String(255, None, True))
    display_options = db.Column(db.Text)
    is_deleted_ldap = db.Column(db.Boolean, nullable=False, server_default="0")
    pdffont = db.Column(db.String(255, None, True))
    picture = db.Column(db.String(255, None, True))
    begin_date = db.Column(db.DateTime)
    end_date = db.Column(db.DateTime)
    keep_devices_when_purging_item = db.Column(db.Boolean, nullable=False, server_default="0")
    privatebookmarkorder = db.Column(db.Text)
    backcreated = db.Column(db.Boolean, nullable=False, server_default="0")

    assets = db.relationship('Asset', backref='user')
    consumable_items = db.relationship('ConsumableItem', backref='user')
    documents = db.relationship('Document', backref='user')
    notepads = db.relationship('Notepad', backref='user')
    softwares = db.relationship('Software', backref='user')