from fusionglpi import db


class NetworkportNetworkport(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    network_port_1_id = db.Column(db.Integer, nullable=False,
                                  server_default="0")
    network_port_2_id = db.Column(db.Integer, nullable=False,
                                  server_default="0")
