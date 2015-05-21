'use strict';

var app = angular.module('review',
	['ngSanitize',
	'ngRoute',
	'ngDialog',
	'com.2fdevs.videogular'
	]
);


// --------------------------------------------------------------------------
//   Config
// --------------------------------------------------------------------------

app.config(function($routeProvider, $sceDelegateProvider) {

	$routeProvider.when('/revision-:revisionID', {
		controller: 'mainController'
	});
	$routeProvider.when('/', {
		controller: 'mainController'
	});

	$sceDelegateProvider.resourceUrlWhitelist([
		'self',
		'http://docs.google.com/**'
	]);

});

// --------------------------------------------------------------------------
//   Info Factory
// --------------------------------------------------------------------------

app.factory('Info', function() {
	return info;
});


// --------------------------------------------------------------------------
//   Revisions Factory
// --------------------------------------------------------------------------

app.factory('RevisionsFactory', function($http, Info) {

	var params = {};

	params.action = 'review_get_revisions';
	params.current_id = Info.current_id;

	return {

		getRevisions: function() {

			return $http({
	  		method: 'get',
	  		url: Info.ajax_url,
	  		params: params
	  	})

				.then(function (result) {
					console.log(result.data);
					return result.data;
				});
		}
	};
});

// --------------------------------------------------------------------------
//   Copy Controller
// --------------------------------------------------------------------------

app.controller('mainController', function($sce, $route, $routeParams, $location, $scope, RevisionsFactory, Info, ngDialog) {

	$scope.info = Info;

	RevisionsFactory.getRevisions().then(function (result) {

		$scope.revisions = [];

		angular.forEach(result, function (result, key) {

			result.id = key;
			$scope.revisions.push(result);

		});

		if (!$route.current.params.revisionID) {

			$scope.activeRevision = result[result.length - 1];
			$location.path('revision-' + $scope.activeRevision.id);

		} else {

			$scope.activeRevision = result[$route.current.params.revisionID];

		};

		$scope.videoConfig = {
		  preload: "none",
		  sources: [
		      {src: $sce.trustAsResourceUrl($scope.activeRevision.video.url), type: $scope.activeRevision.video.mime_type}
		  ],
		  theme: {
		      url: "http://www.videogular.com/styles/themes/default/latest/videogular.css"
		  }
		};

		console.log($scope.revisions);

	});


	$scope.getIncludeFile = function (location) {

		return Info.concept_type + '-' + location + '.html';

	}


	$scope.switchRevision = function (revision) {
		$scope.activeRevision = revision;
		$location.path('revision-' + revision.id);

		console.log(Info.concept_type);

		if (Info.concept_type == 'video') {
			$scope.API.stop();
			$scope.API.clearMedia();

			$scope.videoConfig.sources = [{src: $sce.trustAsResourceUrl($scope.activeRevision.video.url), type: $scope.activeRevision.video.mime_type}];

			$scope.API.changeSource( $scope.videoConfig.sources );

			$('body').fitVids();

		}
	}


	$scope.openModal = function (argument) {

		var template = Info.concept_type + '-modal.html';

		ngDialog.open({
			template: template,
			scope: $scope,
			className: 'ngdialog-theme-plain'
		});
	}


	$scope.getIframeURL = function (revision) {

		return 'http://docs.google.com/gview?url=' + revision.pdf.url + '&embedded=true';

	}


	$scope.onPlayerReady = function(API) {
		$scope.API = API;
	};

});


// --------------------------------------------------------------------------
//   Embed Directive
// --------------------------------------------------------------------------

app.directive('embedSrc', function () {
  return {
    restrict: 'A',
    link: function (scope, element, attrs) {
      var current = element;
      scope.$watch(function() { return attrs.embedSrc; }, function () {
        var clone = element
                      .clone()
                      .attr('src', attrs.embedSrc);
        current.replaceWith(clone);
        current = clone;
      });
    }
  };
})
