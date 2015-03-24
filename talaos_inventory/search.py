import json
import talaos_inventory.models.assets as assets
from flask import current_app as app
import time


def pre_asset_get_callback(request, lookup):
    '''
    manage search
    curl -u d.durieux@siprossii.com:xxx -i 'http://10.0.20.9:5000/asset' \
    -X POST -H "X-HTTP-Method-Override:GET" -d '{"where": {"name": "toto"}}'
    '''
    if request.data.decode("utf-8") == '':
        lookup["id"] = 529
        return
    jsondata = json.loads(request.data.decode("utf-8"))
    if 'where' not in jsondata:
        lookup["id"] = 0
        return
    where = cleanWhere(json.loads(jsondata['where']))
    print(where)

    start_time = time.time()
    idList = manageGroup(where['group'])
    print(len(idList))
    print("--- %s seconds ---" % (time.time() - start_time))
    lookup["id"] = idList


def cleanWhere(where):
    if 'group' in where:
        where['group'] = cleanWhere(where['group'])
    elif 'rules' in where:
        for k, v in enumerate(where['rules']):
            if 'group' not in where['rules'][k]:
                if where['rules'][k]['data'] == '':
                    del where['rules'][k]
    return where


def manageGroup(group):
    idList = []
    i = 0
    for r in group['rules']:
        if 'group' in r:
            list = manageGroup(r['group'])
        else:
            list = getCondition(r)
        if i == 0:
            idList = list
        else:
            if group['operator'] == 'Union':
                idList = getUnion([idList, list])
            elif group['operator'] == 'Difference':
                idList = getDifference([idList, list])
            elif group['operator'] == 'Intersection':
                idList = getIntersection([idList, list])
        i = i + 1
    return idList


def getCondition(data):
    qfilter = ''
    if data['condition'] == '=':
        qfilter = getattr(assets.PropertyName, 'name') == data['data']
    if data['condition'] == '<':
        qfilter = getattr(assets.PropertyName, 'name') < data['data']
    if data['condition'] == '<=':
        qfilter = getattr(assets.PropertyName, 'name') <= data['data']
    if data['condition'] == '>':
        qfilter = getattr(assets.PropertyName, 'name') > data['data']
    if data['condition'] == '>=':
        qfilter = getattr(assets.PropertyName, 'name') >= data['data']
    if data['condition'] == '<>':
        qfilter = getattr(assets.PropertyName, 'name') != data['data']
    if data['condition'] == 'like':
        qfilter = getattr(assets.PropertyName, 'name').like(data['data'])

    query = app.data.driver.session.query(assets.PropertyName)
    prepQuery = query.with_entities(assets.PropertyName.id).filter(
        getattr(
            assets.PropertyName,
            'asset_type_property_id'
        ) == data['field'],
        qfilter)
    list = runQuery(prepQuery, 'PropertyName')
    idPropertyName = listTupleToList(list)

    list = []
    ll = [
        idPropertyName[i:i + 2000]
        for i in range(0, len(idPropertyName), 2000)
    ]
    for l in ll:
        query = app.data.driver.session.query(assets.AssetProperty)
        prepQuery = query.with_entities(assets.AssetProperty.asset_id).filter(
            getattr(assets.AssetProperty, 'property_name_id').in_(l))
        list.extend(runQuery(prepQuery, 'AssetProperty'))
    idList = listTupleToList(list)

    if data['assetchild'] == 'nochild':
        return idList
    elif data['assetchild'] == 'firstlevel':
        lid = []
        ll = [idList[i:i + 2000] for i in range(0, len(idList), 2000)]
        for l in ll:
            prepQuery = query.with_entities(assets.AssetAsset.asset_left) \
                .filter(
                    getattr(assets.AssetAsset, 'asset_right').in_(l)) \
                .distinct(assets.AssetAsset.asset_left)
            lid.extend(runQuery(prepQuery, 'AssetAsset'))
        idList = listTupleToList(lid)
        return idList


def getUnion(s):
    '''
    Union of 2 lists + deduplicate items
    '''
    return list(set.union(set(s[0]), set(s[1])))


def getIntersection(s):
    '''
    Intersection of 2 lists + deduplicate items
    '''
    return list(set(s[0]) & set(s[1]))


def getDifference(s):
    '''
    Difference of 2 lists + deduplicate items
    '''
    return list(set(s[0]) - set(s[1]))


def runQuery(query, name):
    start_time = time.time()
    list = query.all()
    print(name + " === %s seconds ===" % (time.time() - start_time))
    return list


def listTupleToList(tuplist):
    idList = []
    for var in tuplist:
        idList.append(var[0])
    return idList
