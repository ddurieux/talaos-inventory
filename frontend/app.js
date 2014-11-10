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

      RestangularProvider.setResponseExtractor(function(response, operation) {
         return response;
      });
      
  });


function ListCtrl($scope, Restangular, item) {
   $scope.list = item;
   $scope.items = Restangular.all("item").getList().$object;
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

