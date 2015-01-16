# -*- coding: utf-8 -*-

import os
import sys
from pprint import pprint
from docopt import docopt

import logging
logging.basicConfig()
log = logging.getLogger()

__doc__ = """FusionGLPI
Usage:
    fusionglpi <command>

Commands:
    install     Perfom basic setup of application.
    check       Run some checks against database.
    configure   Configure parts of the application.
    seed        Fill up the database with some random values.
"""

def main():
    args = docopt(__doc__)
    log.debug(args)
