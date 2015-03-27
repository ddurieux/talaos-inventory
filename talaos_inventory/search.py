import json
import talaos_inventory.models.assets as assets
from flask import current_app as app
import time


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
            lookup["id"] = 0
            return
        jsondata = json.loads(request.data.decode("utf-8"))
        if 'where' not in jsondata:
            lookup["id"] = 0
            return
        where = self.check_where(json.loads(jsondata['where']))
        self.log.debug(where)

        if (len(where['group']['rules']) == 1) and \
            (where['group']['rules'][0]['field'] == 'assettype'):
            lookup["asset_type_id"] = where['group']['rules'][0]['data']
            return
        start_time = time.time()
        idList = self.manage_group(where['group'])
        self.log.debug('Number of elements: ', len(idList))
        self.log.debug("--- %s seconds ---" % (time.time() - start_time))
        if len(idList) == 0:
            lookup["id"] = 0
        else:
            lookup["id"] = idList

    def check_where(self, where):
        ''' TODO chech search json validator '''
        return where

    def manage_group(self, group):
        idList = []
        i = 0
        for r in group['rules']:
            if 'group' in r:
                condition_list = self.manage_group(r['group'])
            else:
                condition_list = self.fetch_list(r)
            idList = self.lists_operations(
                i, group['operator'], idList, condition_list)
            i = i + 1
        return idList

    def fetch_list(self, condition):
        if condition['field'] == 'assettype':
            query = app.data.driver.session.query(assets.Asset)
            prepQuery = query.with_entities(assets.Asset.id).filter(
                getattr(
                    assets.Asset,
                    'asset_type_id'
                ) == condition['data'])
            db_values = self.run_query(prepQuery, 'Asset')
            return [r[0] for r in db_values]

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
            idList = [r[0] for r in db_values]
            return idList

    def get_filter_for_condition(self, data):
        query_filter = ''
        if data['condition'] == '=':
            query_filter = getattr(assets.PropertyName, 'name') == data['data']
        elif data['condition'] == '<':
            query_filter = getattr(assets.PropertyName, 'name') < data['data']
        elif data['condition'] == '<=':
            query_filter = getattr(assets.PropertyName, 'name') <= data['data']
        elif data['condition'] == '>':
            query_filter = getattr(assets.PropertyName, 'name') > data['data']
        elif data['condition'] == '>=':
            query_filter = getattr(assets.PropertyName, 'name') >= data['data']
        elif data['condition'] == '<>':
            query_filter = getattr(assets.PropertyName, 'name') != data['data']
        elif data['condition'] == 'like':
            query_filter = getattr(assets.PropertyName, 'name').like(data['data'])
        return query_filter

    def lists_operations(self, i, operator, s, t):
        if i == 0:
            s = t
        else:
            if operator == 'Union':
                s = list(set(s).union(set(t)))
            elif operator == 'Difference':
                s = list(set(s).symmetric_difference(set(t)))
            elif operator == 'Intersection':
                if (len(s) == 0) or (len(t) == 0):
                    return []
                s = list(set(s).intersection(set(t)))
        return s

    def run_query(self, query, dbname):
        start_time = time.time()
        db_values = query.all()
        self.log.debug(
            dbname,
            "=== %s seconds ===" % (time.time() - start_time))
        return db_values
