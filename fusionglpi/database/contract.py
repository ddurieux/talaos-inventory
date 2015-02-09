from fusionglpi import db


class Contract(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    entity_id = db.Column(db.Integer, db.ForeignKey('entity.id'))
    is_recursive = db.Column(db.Boolean, nullable=False, server_default="0")
    is_deleted = db.Column(db.Boolean, nullable=False, server_default="0")
    is_template = db.Column(db.Boolean, nullable=False, server_default="0")
    template_name = db.Column(db.String(255, None, True))
    name = db.Column(db.String(255, None, True))
    num = db.Column(db.String(255, None, True))
    comment = db.Column(db.Text)
    contract_type_id = db.Column(db.Integer,
                                 db.ForeignKey('contract_type.id'))
    begin_date = db.Column(db.Date)
    duration = db.Column(db.Integer, nullable=False, server_default="0")
    notice = db.Column(db.Integer, nullable=False, server_default="0")
    periodicity = db.Column(db.Integer, nullable=False, server_default="0")
    billing = db.Column(db.Integer, nullable=False, server_default="0")
    accounting_number = db.Column(db.String(255, None, True))
    week_begin_hour = db.Column(db.Time)
    week_end_hour = db.Column(db.Time)
    saturday_begin_hour = db.Column(db.Time)
    saturday_end_hour = db.Column(db.Time)
    use_saturday = db.Column(db.Boolean, nullable=False, server_default="0")
    monday_begin_hour = db.Column(db.Time)
    monday_end_hour = db.Column(db.Time)
    use_monday = db.Column(db.Boolean, nullable=False, server_default="0")
    max_links_allowed = db.Column(db.Integer, nullable=False,
                                  server_default="0")
    alert = db.Column(db.Integer, nullable=False, server_default="0")
    renewal = db.Column(db.Integer, nullable=False, server_default="0")
