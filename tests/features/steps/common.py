# flake8: noqa
from behave import *
from nose.tools import ok_, eq_, assert_equals, assert_not_equals
from pprint import pprint
import json
from talaos_inventory.app import Application


@given(u'the api backend is available')
def step_impl(context):
    ok_(context.client and context.application.db)

@given(u'I create the asset type "{asset_type}"')
def step_impl(context, asset_type):
    # ensure this asset type is not present
    response = context.client.get('/asset_type?where={{"name":"{}"}}'.format(asset_type))
    eq_(response.status_code, 200)
    result = json.loads(response.data.decode())
    eq_(len(result['_items']), 0)

    # create the asset type
    response = context.client.post('/asset_type',
                                   data={
                                       'name': asset_type
                                   }
                                  )
    eq_(response.status_code, 201)

    # ensure this asset type has been sucessfully created
    response = context.client.get('/asset_type?where={{"name":"{}"}}'.format(asset_type))
    eq_(response.status_code, 200)
    result = json.loads(response.data.decode())
    eq_(len(result['_items']), 1)


@given(u'I create the following "{asset_type}" assets')
def step_impl(context,asset_type):

    # retrieve the asset_type id
    response = context.client.get('/asset_type?where={{"name":"{}"}}'.format(asset_type))
    eq_(response.status_code, 200)
    result = json.loads(response.data.decode())
    eq_(len(result['_items']), 1)
    asset_type_id = result['_items'][0]['id']

    for row in context.table:
        # ensure this asset is not present
        response = context.client.get('/asset?where={{"name":"{}", "asset_type_id":"{}"}}'.format(row['name'], asset_type_id))
        eq_(response.status_code, 200)
        result = json.loads(response.data.decode())
        eq_( len(result['_items']), 0)

        # create this asset
        response = context.client.post('/asset',
                                       data={
                                           'name' : row['name'],
                                           'asset_type_id' : asset_type_id
                                       }
                                      )
        eq_(response.status_code, 201)
        # ensure this asset has been sucessfully created

@when(u'I am looking for asset types "{asset_type}"')
def step_impl(context,asset_type):
    # retrieve the asset_type id
    response = context.client.get('/asset_type?where={{"name":"{}"}}'.format(asset_type))
    assert_equals(response.status_code, 200)
    result = json.loads(response.data.decode())
    assert_equals(len(result['_items']), 1)
    asset_type_id = result['_items'][0]['id']

    # search
    response = context.client.get('/asset?where={{"asset_type_id":"{}"}}'.format(asset_type_id))
    assert_equals(response.status_code, 200)
    result = json.loads(response.data.decode())
    context.result = result


@when(u'I am looking for asset types starting with "{prefix}"')
def step_impl(context,prefix):
    # search
    query = '/asset?where={{"name":"startswith(\\"{}\\")"}}'.format(prefix)
    # pprint(query)
    response = context.client.get(query)
    assert_equals(response.status_code, 200)
    result = json.loads(response.data.decode())
    context.result = result
    pprint(result)


@then(u'I must retrieve a list of "{nb:d}" computers')
def step_impl(context, nb):
    ok_(context.result and context.result['_meta'])
    assert_equals(context.result['_meta']['total'], nb)
