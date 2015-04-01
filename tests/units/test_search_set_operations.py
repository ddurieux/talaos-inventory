from talaos_inventory.search import Search


def test_union():
    search = Search(object)
    assert search.handle_manage(
        'Union',
        set((1, 2, 3, 4, 5, 6)),
        set((4, 5, 6, 7, 8, 9))
    ) == set((1, 2, 3, 4, 5, 6, 7, 8, 9))


def test_intersection():
    search = Search(object)
    assert search.handle_manage(
        'Intersection',
        set((1, 2, 3, 4, 5, 6)),
        set((4, 5, 6, 7, 8, 9))
    ) == set((4, 5, 6))


def test_difference():
    search = Search(object)
    assert search.handle_manage(
        'Difference',
        set((1, 2, 3, 4, 5, 6)),
        set((4, 5, 6, 7, 8, 9))
    ) == set((1, 2, 3, 7, 8, 9))
