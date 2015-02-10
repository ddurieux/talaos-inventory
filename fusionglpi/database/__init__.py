import pkgutil
from fusionglpi import db
# from flask import request
from fusionglpi.database.asset_type import AssetType
__path__ = pkgutil.extend_path(__path__, __name__)


def define_cols(search_params=None):
    # requested_columns = request.args.get('cols')
    # if requested_columns is not None:
        # columns = requested_columns.split(',')
        # include_columns = columns
        # pass
    pass


def asset_type_filter(search_params=None):
    filters = dict(name='asset_type_id', op='eq', val=1)
    if 'filters' not in search_params:
        search_params['filters'] = []
    search_params['filters'].append(filters)
    pass


def register_models(manager, app):
    packages = pkgutil.walk_packages(path=__path__, prefix=__name__+'.')
    for importer, modname, ispkg in packages:
        __import__(modname)

    for model in db.Model.__subclasses__():
        if not hasattr(model, 'include_columns'):
            model.include_columns = None

        methods = ['GET', 'PUT', 'POST', 'DELETE']
        preprocessors = dict(GET_MANY=[define_cols])

        manager.create_api(
            model,
            include_columns=model.include_columns,
            methods=methods,
            url_prefix='/api/v1.0',
            preprocessors=preprocessors
        )
        manager.create_api(
            model,
            include_columns=model.include_columns,
            methods=methods,
            url_prefix='/api',
            preprocessors=preprocessors
        )

        if (model.__name__ == 'Asset'):
            with app.app_context():
                for fields in db.session.query(AssetType).all():
                    manager.create_api(
                        model,
                        include_columns=model.include_columns,
                        methods=methods,
                        collection_name='inv_'+fields.collection_name,
                        preprocessors=dict(
                            GET_MANY=[define_cols, asset_type_filter]
                        )
                    )
