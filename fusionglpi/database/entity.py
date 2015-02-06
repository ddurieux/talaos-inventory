from fusionglpi import db

class Entity(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    name = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    completename = db.Column(db.Text)
    level = db.Column(db.Integer, nullable=False, server_default="0")
    ancestors_cache = db.Column(db.Text)
    descendants_cache = db.Column(db.Text)
    address = db.Column(db.Text)
    postcode = db.Column(db.String(255, None, True))
    town = db.Column(db.String(255, None, True))
    state = db.Column(db.String(255, None, True))
    country = db.Column(db.String(255, None, True))
    website = db.Column(db.String(255, None, True))
    phonenumber = db.Column(db.String(255, None, True))
    fax = db.Column(db.String(255, None, True))
    email = db.Column(db.String(255, None, True))
    admin_email = db.Column(db.String(255, None, True))
    admin_email_name = db.Column(db.String(255, None, True))
    admin_reply = db.Column(db.String(255, None, True))
    admin_reply_name = db.Column(db.String(255, None, True))
    notification_subject_tag = db.Column(db.String(255, None, True))
    ldap_dn = db.Column(db.String(255, None, True))
    tag = db.Column(db.String(255, None, True))
    #authldap_id = db.Column(db.Integer, nullable=False, server_default="0")
    mail_domain = db.Column(db.String(255, None, True))
    entity_ldapfilter = db.Column(db.Text)
    mailing_signature = db.Column(db.Text)
    cartridges_alert_repeat = db.Column(db.Integer, nullable=False, server_default="0")
    consumables_alert_repeat = db.Column(db.Integer, nullable=False, server_default="0")
    use_licenses_alert = db.Column(db.Integer, nullable=False, server_default="0")
    send_licenses_alert_before_delay = db.Column(db.Integer, nullable=False, server_default="0")
    use_contracts_alert = db.Column(db.Integer, nullable=False, server_default="0")
    send_contracts_alert_before_delay = db.Column(db.Integer, nullable=False, server_default="0")
    use_infocoms_alert = db.Column(db.Integer, nullable=False, server_default="0")
    send_infocoms_alert_before_delay = db.Column(db.Integer, nullable=False, server_default="0")
    use_reservations_alert = db.Column(db.Integer, nullable=False, server_default="0")
    autoclose_delay = db.Column(db.Integer, nullable=False, server_default="0")
    notclosed_delay = db.Column(db.Integer, nullable=False, server_default="0")
    #calendar_id = db.Column(db.Integer, nullable=False, server_default="0")
    auto_assign_mode = db.Column(db.Integer, nullable=False, server_default="0")
    tickettype = db.Column(db.Integer, nullable=False, server_default="0")
    max_closedate = db.Column(db.DateTime)
    inquest_config = db.Column(db.Integer, nullable=False, server_default="0")
    inquest_rate = db.Column(db.Integer, nullable=False, server_default="0")
    inquest_delay = db.Column(db.Integer, nullable=False, server_default="0")
    inquest_URL = db.Column(db.String(255, None, True))
    autofill_warranty_date = db.Column(db.String(255, None, True))
    autofill_use_date = db.Column(db.String(255, None, True))
    autofill_buy_date = db.Column(db.String(255, None, True))
    autofill_delivery_date = db.Column(db.String(255, None, True))
    autofill_order_date = db.Column(db.String(255, None, True))
    #ticket_template_id = db.Column(db.Integer, nullable=False, server_default="0")
    entity_id_software = db.Column(db.Integer, nullable=False, server_default="0")
    default_contract_alert = db.Column(db.Integer, nullable=False, server_default="0")
    default_infocom_alert = db.Column(db.Integer, nullable=False, server_default="0")
    default_cartridges_alarm_threshold = db.Column(db.Integer, nullable=False, server_default="0")
    default_consumables_alarm_threshold = db.Column(db.Integer, nullable=False, server_default="0")
    delay_send_emails = db.Column(db.Integer, nullable=False, server_default="0")

    assets = db.relationship('Asset', backref='entity')
    budgets = db.relationship('Budget', backref='entity')
    cartridges = db.relationship('Cartridge', backref='entity')
    consumables = db.relationship('Consumable', backref='entity')
    consumable_items = db.relationship('ConsumableItem', backref='entity')
    contracts = db.relationship('Contract', backref='entity')
    device_case_items = db.relationship('DeviceCaseItem', backref='entity')
    device_control_items = db.relationship('DeviceControlItem', backref='entity')
    device_drive_items = db.relationship('DeviceDriveItem', backref='entity')
    device_graphiccard_items = db.relationship('DeviceGraphiccardItem', backref='entity')
    device_harddrive_items = db.relationship('DeviceHarddriveItem', backref='entity')
    device_memory_items = db.relationship('DeviceMemoryItem', backref='entity')
    device_motherboard_items = db.relationship('DeviceMotherboardItem', backref='entity')
    device_networkcard_items = db.relationship('DeviceNetworkcardItem', backref='entity')
    device_pci_items = db.relationship('DevicePciItem', backref='entity')
    device_powersupply_items = db.relationship('DevicePowersupplyItem', backref='entity')
    device_processor_items = db.relationship('DeviceProcessorItem', backref='entity')
    device_soundcard_items = db.relationship('DeviceSoundcardItem', backref='entity')
    documents = db.relationship('Document', backref='entity')
    domains = db.relationship('Domain', backref='entity')
    #entities = db.relationship('Entity', backref='entity')
    filesystems = db.relationship('Filesystem', backref='entity')
    fqdns = db.relationship('Fqdn', backref='entity')
    groups = db.relationship('Group', backref='entity')
    infocoms = db.relationship('Infocom', backref='entity')
    installed_software_versions = db.relationship('InstalledSoftwareVersion', backref='entity')
    suppliers = db.relationship('Supplier', backref='entity')
    ipaddresses = db.relationship('Ipaddress', backref='entity')
    ipnetworks = db.relationship('Ipnetwork', backref='entity')
    locations = db.relationship('Location', backref='entity')
    netpoints = db.relationship('Netpoint', backref='entity')
    networknames = db.relationship('Networkname', backref='entity')
    networkports = db.relationship('Networkport', backref='entity')
    softwares = db.relationship('Software', backref='entity')
    software_licenses = db.relationship('SoftwareLicense', backref='entity')
    software_versions = db.relationship('SoftwareVersion', backref='entity')
    users = db.relationship('User', backref='entity')
    vlans = db.relationship('Vlan', backref='entity')
    wifinetworks = db.relationship('Wifinetwork', backref='entity')

    include_columns = ['id', 'name']
