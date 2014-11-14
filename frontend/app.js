angular.module('asset', ['restangular', 'ngRoute', 'angular.filter', 'ui.bootstrap']).
        
  config(function($routeProvider, RestangularProvider) {
    $routeProvider.
      when('/', {
        controller:homePage, 
        templateUrl:'home.html',
      }).
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
      otherwise({redirectTo:'/'});
      
      RestangularProvider.setBaseUrl('../public/index.php');
//      RestangularProvider.setDefaultRequestParams({ apiKey: '4f847ad3e4b08a2eed5f3b54' })
      
      RestangularProvider.setRequestInterceptor(function(elem, operation, what) {
          
        if (operation === 'put') {
          elem._id = undefined;
          return elem;
        }
        return elem;
      })

//      RestangularProvider.addResponseInterceptor(function(data, operation, what, url, response) {
//         return data;
//      });
      
  });


function homePage($scope, Restangular) {
   $scope.items = Restangular.all("item").getList().$object;
}


function ListCtrl($scope, Restangular, item) {
   $scope.list = item;
   $scope.items = Restangular.all("item").getList().$object;
//   $scope.meta = item.meta;

    $scope.loadPage = function() {
        //$scope.list = Restangular.all(item.route).getList({'page':$scope.list.meta.currentpage});
//        console.log(Restangular.all('Asset').customGET('', {'page':$scope.list.meta.currentpage}));
        Restangular.all('Asset').customGET('', {'page':$scope.list.meta.currentpage})
                .then(function(data) {
                    $scope.list = data;
            });
        //console.log($scope.list);
    };

    $scope.nextPage = function() {
        if ($scope.list.meta.currentpage < $scope.list.meta.totalpage) {
            $scope.list.meta.currentpage++;
            $scope.loadPage();
        }
    };

    $scope.previousPage = function() {
        if ($scope.list.meta.currentpage > 1) {
            $scope.list.meta.currentpage--;
            $scope.loadPage();
        }
    };

}


function CreateCtrl($scope, $location, Restangular, item) {
  var original = item;
  $scope.itemtypename = item;
  Restangular.all("AssetType").customGET().then(function(data) {
     $scope.assettypes = data.data;
  });
  
  $scope.save = function() {
    Restangular.all(item).post($scope.item).then(function(item) {
      $location.path('/' + original);
    });
  }
}

function EditCtrl($scope, $location, Restangular, item) {
  var original = item;
  $scope.item = Restangular.copy(original); 
  $scope.itemtypename = item.route;
  delete $scope.item['assetschild'];
  if ($scope.item.route == 'Asset') {
      Restangular.all("AssetType").customGET().then(function(data) {
                    $scope.assettypes = data.data;
            });
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