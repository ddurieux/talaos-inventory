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
        where = self.cleanWhere(json.loads(jsondata['where']))
        self.log.debug(where)

        if (len(where['group']['rules']) == 1) and \
            (where['group']['rules'][0]['field'] == 'assettype'):
            lookup["asset_type_id"] = where['group']['rules'][0]['data']
            return
        start_time = time.time()
        idList = self.manageGroup(where['group'])
        self.log.debug('Number of elements: ', len(idList))
        self.log.debug("--- %s seconds ---" % (time.time() - start_time))
        if len(idList) == 0:
            lookup["id"] = 0
        else:
            lookup["id"] = idList

    def cleanWhere(self, where):
        if 'group' in where:
            where['group'] = self.cleanWhere(where['group'])
        elif 'rules' in where:
            for k, v in enumerate(where['rules']):
                if 'group' not in where['rules'][k]:
                    if where['rules'][k]['data'] == '':
                        del where['rules'][k]
        return where

    def manageGroup(self, group):
        idList = []
        i = 0
        for r in group['rules']:
            if 'group' in r:
                condition_list = self.manageGroup(r['group'])
            else:
                condition_list = self.getCondition(r)
            idList = self.lists_operations(
                i, group['operator'], idList, condition_list)
            i = i + 1
        return idList

    def getCondition(self, data):
        if data['field'] == 'assettype':
            query = app.data.driver.session.query(assets.Asset)
            prepQuery = query.with_entities(assets.Asset.id).filter(
                getattr(
                    assets.Asset,
                    'asset_type_id'
                ) == data['data'])
            db_values = self.runQuery(prepQuery, 'Asset')
            return self.listTupleToList(db_values)

        else:
            qfilter = self.get_filter_for_condition(data)

            if data['assetchild'] == 'nochild':
                assetproperty = app.data.driver.session.query(
                    assets.AssetProperty
                )
                prepQuery = assetproperty.distinct(
                    assets.AssetProperty.asset_id
                ).with_entities(assets.AssetProperty.asset_id)
            elif data['assetchild'] == 'firstlevel':
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
                ) == data['field'],
                qfilter
            )
            db_values = self.runQuery(prepQuery, '')
            idList = self.listTupleToList(db_values)
            return idList

    def get_filter_for_condition(self, data):
        qfilter = ''
        if data['condition'] == '=':
            qfilter = getattr(assets.PropertyName, 'name') == data['data']
        elif data['condition'] == '<':
            qfilter = getattr(assets.PropertyName, 'name') < data['data']
        elif data['condition'] == '<=':
            qfilter = getattr(assets.PropertyName, 'name') <= data['data']
        elif data['condition'] == '>':
            qfilter = getattr(assets.PropertyName, 'name') > data['data']
        elif data['condition'] == '>=':
            qfilter = getattr(assets.PropertyName, 'name') >= data['data']
        elif data['condition'] == '<>':
            qfilter = getattr(assets.PropertyName, 'name') != data['data']
        elif data['condition'] == 'like':
            qfilter = getattr(assets.PropertyName, 'name').like(data['data'])
        return qfilter

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

    def runQuery(self, query, dbname):
        start_time = time.time()
        db_values = query.all()
        self.log.debug(
            dbname,
            "=== %s seconds ===" % (time.time() - start_time))
        return db_values

    def listTupleToList(self, tuplist):
        idList = []
        for var in tuplist:
            idList.append(var[0])
        return idList
