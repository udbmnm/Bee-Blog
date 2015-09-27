
function MenuListCtrl($scope, $http) {
	$http.get('/Api/Menu').success(function(response) {
		$scope.list = response.data;
	});
}

function ArticleListCtrl($scope, $http) {
	$scope.pageClass = 'page-home';
	$http.get('/Api/ArticleList').success(function(response) {
		$scope.list = response.data;
	});
}


function ArticleDetailCtrl($scope, $http,$routeParams) {
	$http.get('/Api/ArticleDetail/?did='+$routeParams.id).success(function(response) {
		$scope.pageClass = 'page-detail';
		$scope.post = response.data;
	});
}


function TagCtrl($scope, $http,$routeParams) {
	$scope.pageClass = 'page-home';
	$http.get('/Api/Tag/?name='+$routeParams.name).success(function(response) {
		$scope.list = response.data;
	});
}
