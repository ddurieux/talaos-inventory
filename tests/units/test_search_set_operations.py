from talaos_inventory.search import Search


def test_union():
    search = Search(object)
    assert search.lists_operations(
        1,
        'Union',
        [1, 2, 3, 4, 5, 6],
        [4, 5, 6, 7, 8, 9]
    ) == [1, 2, 3, 4, 5, 6, 7, 8, 9]


def test_intersection():
    search = Search(object)
    assert search.lists_operations(
        1,
        'Intersection',
        [1, 2, 3, 4, 5, 6],
        [4, 5, 6, 7, 8, 9]
    ) == [4, 5, 6]


def test_difference():
    search = Search(object)
    assert search.lists_operations(
        1,
        'Difference',
        [1, 2, 3, 4, 5, 6],
        [4, 5, 6, 7, 8, 9]
    ) == [1, 2, 3, 7, 8, 9]
