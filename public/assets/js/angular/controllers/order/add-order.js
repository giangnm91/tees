JavApp.registerCtrl('AddOrderCtrl', function($scope, $http, $templateCache)
{
	$scope.DefaultOrder = {
		ProductUrl : '',
		ProductPrice : '',
		ProductColor : '',
		ProductSize : '',
		ProductQty : '',
		ProductTax : ''
	};
	$scope.Orders = [
		{
			ProductUrl : '',
			ProductPrice : '',
			ProductColor : '',
			ProductSize : '',
			ProductQty : '',
			ProductTax : ''
		}
	];
	$scope.MetaData = {
	}	

	$scope.submitOrder = function() {
		var btn = $('#btn-submit-order');
		if (typeof($scope.Orders[0].ProductUrl) !== 'undefined' && $scope.Orders[0].ProductUrl !== '') {
			btn.block();
			swal({   
				title: "Tạo đơn hàng?",   
				text: "Hiện tại đang có " + String($scope.Orders.length) + " mặt hàng trong đơn hàng.",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "green",   
				confirmButtonText: "Tạo!",   
				closeOnConfirm: false },
				function(){
					$http({
						method: 'POST',
						url: 'order/place-order',
						data : {
							orders : $scope.Orders,
							meta : $scope.MetaData
						}
					})
					.then(function successCallback(response) {
						btn.unblock();
						if (response.status == 200) {
							swal({
		                      title: "Thành công",
		                      type: "success",
		                      text: response.data.message,
		                      timer: 2000,
		                      showConfirmButton: false
		                    });
		                    $scope.Orders = [angular.copy($scope.DefaultOrder)];
						}						
					}, function errorCallback(response) {
						console.log(response);
					});
				});			
		}
		return false;
	}

	$scope.findUser = function() {
		var user_id = $('#input-user').val();
		var elem = $('#form-search-user');
		elem.block();
		if (typeof(user_id) !== 'undefined' && user_id != "") {
			$http({
				method: 'GET',
				url: 'order/findUser/' +user_id,
			})
			.then(function successCallback(response) {
				$('#form-search-user').unblock();
				if (response.status == 200) {
					var json = response.data;
					if (json && typeof(json) !== 'undefined') {
						$scope.User = json.data;						
						$scope.MetaData.UserID = json.data.UserID;	
						$scope.MetaData.Receiver = angular.copy($scope.User);					
					}
				}						
			}, function errorCallback(response) {
				console.log(response);
			});
		}
		elem.unblock();
		return false;
	}

	$scope.addNewProduct = function() {
	    var addedProduct = angular.copy($scope.DefaultOrder);
	    $scope.Orders.push(addedProduct);
	};
    
	$scope.removeProduct = function(position) {		
	    return $scope.Orders.splice(position,1);
	};
});