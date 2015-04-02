import json
import talaos_inventory.models.assets as assets
from flask import current_app as app, make_response, abort
import time
import jsonschema


class Search():

    def __init__(self, log):
        self.log = log

    def pre_asset_get_callback(self, request, lookup):
        '''
        manage search
        curl  -i 'http://10.0.20.9:5000/asset' -X POST
            -H "X-HTTP-Method-Override:GET" -d '{"where": {"name": "toto"}}'
        '''
        if request.data.decode("utf-8") == '':
            return
        jsondata = json.loads(request.data.decode("utf-8"))
        if 'where' not in jsondata:
            lookup["id"] = 0
            return
        where = self.check_where(json.loads(jsondata['where']))
        self.log.debug(where)
        
        if (len(where['group']['rules']) == 1) and \
                (where['group']['rules'][0]['field'] == '0'):
            lookup["asset_type_id"] = where['group']['rules'][0]['data']
            return
        start_time = time.time()
        idList = self.manage_group(where['group'])
        self.log.debug('Number of elements: ', len(idList))
        self.log.debug("--- %s seconds ---" % (time.time() - start_time))
        if len(idList) == 0:
            lookup["id"] = 0
        else:
            lookup["id"] = list(idList)

    def check_where(self, where):
        ''' TODO chech search json validator '''
        schema = self.json_schema()
        v = jsonschema.Draft4Validator(schema)
        errors = sorted(v.iter_errors(where), key=lambda e: e.path)
        if len(errors) == 0:
            return where
        else:
            self.log.debug('Search json error: ', errors)
            abort(make_response("Integrity Error", 400))

    def json_schema(self):
        return {
            "$schema": "http://json-schema.org/draft-04/schema#",
            "definitions": {
                "group": {
                    "type": "object",
                    "properties": {
                        "operator": {
                            "type": "string"
                        },
                        "rules": {
                            "type": "array",
                            "items": {
                                "anyOf": [{
                                    "type": "object",
                                    "properties": {
                                        "condition": {
                                            "type": "string"
                                        },
                                        "field": {
                                            "type": "integer"
                                        },
                                        "data": {
                                            "type": ["string", "integer"]
                                        },
                                        "assetchild": {
                                            "type": "string"
                                        }
                                    },
                                    "required": ["condition", "field", "data"],
                                    "additionalProperties": False
                                }, {
                                    "type": "object",
                                    "properties": {
                                        "group": {
                                            "$ref": "#/definitions/group"
                                        }
                                    },
                                    "additionalProperties": False
                                }]
                            }
                        }
                    },
                    "required": ["operator", "rules"],
                    "additionalProperties": False
                }
            },
            "type": "object",
            "properties": {
                "group": {
                    "$ref": "#/definitions/group"
                }
            },
            "additionalProperties": False
        }

    def check_schema(self):
        t = jsonschema.Draft4Validator.check_schema(self.json_schema)
        print(t)

    def manage_group(self, group):
        idList = set()
        i = 0
        for r in group['rules']:
            if 'group' in r:
                condition_ids = self.manage_group(r['group'])
            else:
                condition_ids = self.fetch_list(r)
            if i == 0:
                idList = condition_ids
                i = 1
            else:
                idList = self.handle_manage(
                    group['operator'], idList, condition_ids)
        return idList

    def fetch_list(self, condition):
        if condition['field'] == 0:
            query = app.data.driver.session.query(assets.Asset)
            prepQuery = query.with_entities(assets.Asset.id).filter(
                getattr(
                    assets.Asset,
                    'asset_type_id'
                ) == condition['data'])
            db_values = self.run_query(prepQuery, 'Asset')
            return set([r[0] for r in db_values])

        else:
            query_filter = self.get_filter_for_condition(condition)

            if condition['assetchild'] == 'nochild':
                assetproperty = app.data.driver.session.query(
                    assets.AssetProperty
                )
                prepQuery = assetproperty.distinct(
                    assets.AssetProperty.asset_id
                ).with_entities(assets.AssetProperty.asset_id)
            elif condition['assetchild'] == 'firstlevel':
                assetasset = app.data.driver.session.query(assets.AssetAsset)
                prepQuery = assetasset.distinct(
                    assets.AssetAsset.asset_left
                ).with_entities(assets.AssetAsset.asset_left).join(
                    assets.AssetProperty,
                    assets.AssetAsset.asset_right ==
                    assets.AssetProperty.asset_id
                )
            prepQuery = prepQuery.join(
                assets.PropertyName
            ).filter(
                getattr(
                    assets.PropertyName,
                    'asset_type_property_id'
                ) == condition['field'],
                query_filter
            )
            db_values = self.run_query(prepQuery, '')
            return set([r[0] for r in db_values])

    def get_filter_for_condition(self, data):
        query_filter = ''
        col_name = getattr(assets.PropertyName, 'name')
        if data['condition'] == '=':
            query_filter = col_name.__eq__(data['data'])
        elif data['condition'] == '<':
            query_filter = col_name.__lt__(data['data'])
        elif data['condition'] == '<=':
            query_filter = col_name.__le__(data['data'])
        elif data['condition'] == '>':
            query_filter = col_name.__gt__(data['data'])
        elif data['condition'] == '>=':
            query_filter = col_name.__ge__(data['data'])
        elif data['condition'] == '<>':
            query_filter = col_name.__ne__(data['data'])
        elif data['condition'] == 'like':
            query_filter = col_name.like(data['data'])
        return query_filter

    def handle_manage(self, operator, s, t):
        if operator == 'Union':
            s = s.union(t)
        elif operator == 'Difference':
            s = s.symmetric_difference(t)
        elif operator == 'Intersection':
            s = s.intersection(t)
        return s

    def run_query(self, query, dbname):
        start_time = time.time()
        db_values = query.all()
        self.log.debug(
            dbname,
            "=== %s seconds ===" % (time.time() - start_time))
        return db_values
