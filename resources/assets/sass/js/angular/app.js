var JavApp = angular.module("JavApplication", [
    'ngRoute',
    'ui.bootstrap',
    'oc.lazyLoad',
    "angucomplete-alt",
    'textAngular']);

JavApp.config(['$routeProvider', '$controllerProvider',
   function($routeProvider,$controllerProvider) {
    var PathCtrl = function(file){
        return '/assets/js/angular/controllers/' + file;
    }
    var PathTheme = function(file){
        return '/assets/views/' + file;
    }
    // remember mentioned function for later use
    JavApp.registerCtrl = $controllerProvider.register;
    $routeProvider
        .when('/', {
            templateUrl: PathTheme('order/index.html')
        })
        .when('/order',
        {
            templateUrl: PathTheme('order/index.html'),
            controller: 'OrderCtrl',
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        PathCtrl('order/order.js'),                        
                    ]);
                }]
            }
        })  
        .when('/order/add',
        {
            templateUrl: PathTheme('order/add-order.html'),
            controller: 'AddOrderCtrl',
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        PathCtrl('order/add-order.js'),                        
                    ]);
                }]
            }
        })  
        .otherwise({
            redirectTo: '/'
        });
   }]);