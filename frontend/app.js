angular.module('asset', ['restangular', 'ngRoute']).
        
  config(function($routeProvider, RestangularProvider) {
    $routeProvider.
      when('/:item', {
        controller:ListCtrl, 
        templateUrl:'list.html',
        resolve: {
          item: function(Restangular, $route){
            var custom = '';
            if ($route.current.params.item == 'Asset') {
                custom = 'assettypes';
            }
            return Restangular.all($route.current.params.item).customGET(custom);
          }
        }
      }).
      when('/:item/edit/:itemId', {
        controller:EditCtrl, 
        templateUrl:'detail.html',
        resolve: {
          item: function(Restangular, $route){
            return Restangular.one($route.current.params.item, $route.current.params.itemId).get();
          }
        }
      }).
      when('/:item/new', {
          controller:CreateCtrl, 
          templateUrl:'detail.html',
          resolve: {
          item: function(Restangular, $route){
              return $route.current.params.item;
          }
        }
      }).
      otherwise({redirectTo:'/Asset'});
      
      RestangularProvider.setBaseUrl('../public/index.php');
//      RestangularProvider.setDefaultRequestParams({ apiKey: '4f847ad3e4b08a2eed5f3b54' })
      
      RestangularProvider.setRequestInterceptor(function(elem, operation, what) {
          
        if (operation === 'put') {
          elem._id = undefined;
          return elem;
        }
        return elem;
      })

      RestangularProvider.addResponseInterceptor(function(data, operation, what, url, response) {
         data.meta = [];
         var link = [];
         if (response.headers('Link')) {
             link = parse_link_header(response.headers('Link'));
         }
         data.meta.Link = link;
         data.meta.total = response.headers('X-Pagination-Total-Count');
         data.meta.perpage = response.headers('X-Pagination-Per-Page');
         data.meta.totalpage = response.headers('X-Pagination-Page-Count');
         data.meta.currentpage = response.headers('X-Pagination-Current-Page');
        
         return data;
      });
      
  });


function ListCtrl($scope, Restangular, item) {
   $scope.list = item;
   $scope.items = Restangular.all("item").getList().$object;
   $scope.meta = item.meta;

    $scope.loadPage = function() {
        $scope.list = Restangular.all(item.route).getList({'page':$scope.meta.currentpage}).$object;
    };

    $scope.nextPage = function() {
        if ($scope.meta.currentpage < $scope.meta.totalpage) {
            $scope.meta.currentpage++;
            $scope.loadPage();
        }
    };

    $scope.previousPage = function() {
        if ($scope.meta.currentpage > 1) {
            $scope.meta.currentpage--;
            $scope.loadPage();
        }
    };

}


function CreateCtrl($scope, $location, Restangular, item) {
  var original = item;
  $scope.save = function() {
    Restangular.all(item).post($scope.item).then(function(item) {
      $location.path('/' + original);
    });
  }
}

function EditCtrl($scope, $location, Restangular, item) {
  var original = item;
  $scope.item = Restangular.copy(original); 
  if ($scope.item.route == 'Asset') {
      $scope.assettypes = Restangular.all("AssetType").getList().$object;
  }
    
  $scope.isClean = function() {
    return angular.equals(original, $scope.item);
  }

  $scope.destroy = function() {
    original.remove().then(function() {
      $location.path('/' + $scope.item.route);
    });
  };

  $scope.save = function() {
    $scope.item.put().then(function() {
      $location.path('/' + $scope.item.route);
    });
  };
}

/*
 * parse_link_header()
 *
 * Parse the Github Link HTTP header used for pageination
 * http://developer.github.com/v3/#pagination
 */
function parse_link_header(header) {
  if (header.length == 0) {
    throw new Error("input must not be of zero length");
  }
  // Split parts by comma
  var parts = header.split(',');
  var links = {};
  // Parse each part into a named link
  _.each(parts, function(p) {
    var section = p.split(';');
    if (section.length != 2) {
      throw new Error("section could not be split on ';'");
    }
    var url = section[0].replace(/<(.*)>/, '$1').trim();
    var name = section[1].replace(/rel="(.*)"/, '$1').trim();
    links[name] = url;
  });
 
  return links;
}