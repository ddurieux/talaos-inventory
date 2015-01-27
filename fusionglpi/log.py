import logging

class Log(object):

    def __init__(self):
       self.namespace = type(self).__name__
       self.log = logging.getLogger(self.namespace)
