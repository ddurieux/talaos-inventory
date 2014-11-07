angular.module('asset', ['restangular', 'ngRoute']).
  config(function($routeProvider, RestangularProvider) {
    $routeProvider.
      when('/', {
        controller:ListCtrl, 
        templateUrl:'list.html'
      }).
      when('/edit/:assetId', {
        controller:EditCtrl, 
        templateUrl:'detail.html',
        resolve: {
          asset: function(Restangular, $route){
            return Restangular.one('Asset', $route.current.params.assetId).get();
          }
        }
      }).
      when('/new', {controller:CreateCtrl, templateUrl:'detail.html'}).
      otherwise({redirectTo:'/'});
      
//      RestangularProvider.setBaseUrl('https://api.mongolab.com/api/1/databases/angularjs/collections');
//      RestangularProvider.setDefaultRequestParams({ apiKey: '4f847ad3e4b08a2eed5f3b54' })
      RestangularProvider.setBaseUrl('http://127.0.0.1/glping/public');
      
      RestangularProvider.setRequestInterceptor(function(elem, operation, what) {
        
        if (operation === 'put') {
          elem._id = undefined;
          return elem;
        }
        return elem;
      })
  });


function ListCtrl($scope, Restangular) {
   $scope.assets = Restangular.all("Asset").getList().$object;
}


function CreateCtrl($scope, $location, Restangular) {
  $scope.save = function() {
    Restangular.all('Asset').post($scope.asset).then(function(asset) {
      $location.path('/list');
    });
  }
}

function EditCtrl($scope, $location, Restangular, asset) {
  var original = asset;
  $scope.asset = Restangular.copy(original); 

  $scope.isClean = function() {
    return angular.equals(original, $scope.asset);
  }

  $scope.destroy = function() {
    original.remove().then(function() {
      $location.path('/');
    });
  };

  $scope.save = function() {
    $scope.asset.put().then(function() {
      $location.path('/');
    });
  };
}
