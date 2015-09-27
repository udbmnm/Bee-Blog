$('#page-content-wrapper').css('min-height', $('#sidebar-wrapper').height());


var app = angular.module('indexApp',['ngRoute','ngAnimate']);

app.config(['$routeProvider', '$locationProvider',function($routeProvider, $locationProvider) {
		$routeProvider.when('/', {
			templateUrl: '/public/home/tmpl/tpl-list.html',
			controller: 'ArticleListCtrl'
		}).when('/detail/:id', {
			templateUrl: '/public/home/tmpl/tpl-detail.html',
			controller: 'ArticleDetailCtrl'
		}).when('/tag/:name', {
			templateUrl: '/public/home/tmpl/tpl-list.html',
			controller: 'TagCtrl'
		});
	}
]);

