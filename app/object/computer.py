from math import *
from app.database.glpi_computer import *
from app.object.common import *

class Computer(Common):
    "Class computer"

    def __init__(self):
        "Init of the class"
        self.dbclass = DBComputer
        
    
    