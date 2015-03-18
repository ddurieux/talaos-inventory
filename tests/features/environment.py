
from talaos_inventory.app import Application
from pprint import pprint  # noqa


def before_feature(context, feature):
    context.application = Application()
    context.application.initialize()

    context.client = context.application.app.test_client()


def before_scenario(context, scenario):
    context.application.db.drop_all()
    context.application.install()
