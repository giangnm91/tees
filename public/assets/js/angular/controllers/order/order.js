JavApp.registerCtrl('OrderCtrl', function($scope, $http, $templateCache)
{
	$('.date-picker').datepicker({
        rtl: App.isRTL(),
        orientation: "left",
        autoclose: true,
    });
	$scope.Paging = {
		TotalItems: 0,
		limit : 20,
		CurrentPage : 1
	};

	$scope.Input = {
	};

	$scope.bodyPost = {
	};

	$scope.LoadOrders = function(anchor){
		var block = $('#order-table');
		$scope.Paging.offset = $scope.Paging.limit*($scope.Paging.CurrentPage - 1);
		block.block();

		$http({
			method: 'POST',
			url: 'order',
			data : {
				input : $scope.Input,
				paging : $scope.Paging
			}
		})
		.then(function successCallback(response) {
			block.unblock();
			var json = response.data;
			if (json && typeof(json) !== 'undefined') {
				$scope.Orders = json.data;
			}	
		}, function errorCallback(response) {
			console.log(response);
		});
	};

	$scope.LoadOrders();

});