'use strict';

var app = angular.module('review',
	['ngSanitize',
	'ngRoute',
	'ngDialog',
	'com.2fdevs.videogular',
	'mgcrea.ngStrap',
	'ngSelect',
	'angular-underscore'
	]
);


// --------------------------------------------------------------------------
//	 Config
// --------------------------------------------------------------------------

app.config(function($routeProvider, $sceDelegateProvider, $locationProvider) {

	$routeProvider.when('/revision-:revisionID', {
		controller: 'mainController'
	});

	$routeProvider.when('/', {
		controller: 'mainController',
		reloadOnSearch: false
	});

	$sceDelegateProvider.resourceUrlWhitelist([
		'self',
		'http://docs.google.com/**'
	]);

});

// --------------------------------------------------------------------------
//	 Info Factory
// --------------------------------------------------------------------------

app.factory('Info', function() {
	return info;
});


// --------------------------------------------------------------------------
//	 Revisions Factory
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
//	 Concepts Factory
// --------------------------------------------------------------------------

app.factory('ConceptsFactory', function($http, Info) {

	var params = {};

	params.action = 'review_get_concepts';
	params.user_id = Info.user_id;

	return {

		getConcepts: function(projects) {

			console.log(projects);

			params.projects = null;

			if (projects)
				params.projects = _.pluck(projects,'term_id').join(',');

			return $http({
				method: 'get',
				url: Info.ajax_url,
				params: params
			});
		}
	};
});


// --------------------------------------------------------------------------
//	 Concepts Factory
// --------------------------------------------------------------------------

app.factory('FiltersFactory', function($http, Info) {

	var factory = {};

	factory.getClients = function() {

		var params = {};

		params.user_id = Info.user_id;
		params.action = 'review_get_clients';

		return $http({
			method: 'get',
			url: Info.ajax_url,
			params: params
		});
	}

	factory.getProjects = function(client, project) {

		var params = {};

		params.user_id = Info.user_id;

		params.client_id = null;
		params.project_id = null;

		if (client)
			params.client_id = client.ID;

		if (project)
			params.project_id = project.term_id;

		params.action = 'review_get_projects';

		return $http({
			method: 'get',
			url: Info.ajax_url,
			params: params
		});
	}

	return factory;

});


// --------------------------------------------------------------------------
//	 Copy Controller
// --------------------------------------------------------------------------

app.controller('mainController', function($sce, $route, $routeParams, $location, $scope, RevisionsFactory, Info, ngDialog) {

	$scope.info = Info;

	$scope.viewLoading = true;


	// --------------------------------------------------------------------------
	//   Get Revisions
	// --------------------------------------------------------------------------

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

		if ('video' == Info.concept_type) {

			$scope.videoConfig = {
				preload: "none",
				sources: [
						{src: $sce.trustAsResourceUrl($scope.activeRevision.video.url), type: $scope.activeRevision.video.mime_type}
				],
				theme: {
						url: "http://www.videogular.com/styles/themes/default/latest/videogular.css"
				}
			};
		}

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

	$scope.setActive = function (image) {
		$scope.activeImage = image;
	}


	$scope.getIframeURL = function (revision) {

		return 'http://docs.google.com/gview?url=' + revision.pdf.url + '&embedded=true';

	}


	$scope.onPlayerReady = function(API) {
		$scope.API = API;
	};

});


// --------------------------------------------------------------------------
//	 Embed Directive
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
});


// --------------------------------------------------------------------------
//	 Concept Filter
// --------------------------------------------------------------------------

app.controller('ConceptFilter', function($location, $scope, ConceptsFactory, FiltersFactory) {

	// --------------------------------------------------------------------------
	//	 Watch for selection
	// --------------------------------------------------------------------------

	$scope.changeClient = function (client) {

		if ($scope.selectedClient != client) {

			$location.search('selectedClient', null);

		} else {

			$location.search('selectedClient', $scope.selectedClient.ID);

		}

	};

	$scope.changeProject = function (project) {

		if ($scope.selectedProject != project) {

			$location.search('selectedProject', null);

		} else {

			$location.search('selectedProject', $scope.selectedProject.term_id);

		}

	};


	// --------------------------------------------------------------------------
	//	 Refresh Clients
	// --------------------------------------------------------------------------

	$scope.refreshClients = function () {

		return FiltersFactory.getClients().then(function (result) {

			$scope.clients = result.data;

			// --------------------------------------------------------------------------
			//	 Set Active
			// --------------------------------------------------------------------------

			if ($location.search().selectedClient) {

				var client = _.find($scope.clients, function (obj) {
					return $location.search().selectedClient == obj.ID;
				});

				$scope.selectedClient = client;

			};

		});

	};


	// --------------------------------------------------------------------------
	//	 Refresh Projects
	// --------------------------------------------------------------------------

	$scope.refreshProjects = function () {

		$scope.viewLoading = true;

		FiltersFactory.getProjects($scope.selectedClient, $scope.selectedProject).then(function (result) {

			$scope.projects = result.data;

			$scope.selectedProjects = result.data;

			// --------------------------------------------------------------------------
			//	 Set Active
			// --------------------------------------------------------------------------

			if ($location.search().selectedProject) {

				var project = _.find($scope.projects, function (obj) {
					return $location.search().selectedProject == obj.term_id;
				});

				$scope.selectedProjects = [];
				$scope.selectedProject = project;

				$scope.selectedProjects.push(project);

			};


			// --------------------------------------------------------------------------
			//	 Refresh Concepts based on Project/s
			// --------------------------------------------------------------------------

			return ConceptsFactory.getConcepts($scope.selectedProjects);

		}).then(function (result) {

			$scope.concepts = result.data;

			$scope.viewLoading = false;

		});

	};


	// --------------------------------------------------------------------------
	//	 Refresh Concepts
	// --------------------------------------------------------------------------

	$scope.refreshConcepts = function () {

		var projects = [];

		if ($scope.selectedProject != null) {
			projects.push($scope.selectedProject);
		} else {
			projects = $scope.projects;
		}

		ConceptsFactory.getConcepts(projects).then(function (result) {
			$scope.concepts = result.data;
		});

	};



	$scope.refreshAll = function () {

		$scope.refreshClients().then(function () {

			$scope.refreshProjects();

		});


	}

	// --------------------------------------------------------------------------
	//	 Init
	// --------------------------------------------------------------------------

	$scope.refreshAll();

});


app.directive('loadingSpinner', function() {
	return {
		restrict: 'A',
		replace: true,
		transclude: true,
		scope: {
			loading: '=loadingSpinner'
		},
		template: '<div><div ng-show="loading" class="loading-spinner-container"></div><div ng-hide="loading" ng-transclude></div></div>',
		link: function(scope, element, attrs) {
			var spinner = new Spinner({
				lines: 9, // The number of lines to draw
				length: 8, // The length of each line
				width: 3, // The line thickness
				radius: 10, // The radius of the inner circle
				corners: 1, // Corner roundness (0..1)
				rotate: 0, // The rotation offset
				direction: 1, // 1: clockwise, -1: counterclockwise
				color: '#ffd500', // #rgb or #rrggbb or array of colors
				speed: 1, // Rounds per second
				trail: 50, // Afterglow percentage
				top: '50%', // Top position relative to parent
				left: '50%' // Left position relative to parent
			}).spin();
			var loadingContainer = element.find('.loading-spinner-container')[0];
			loadingContainer.appendChild(spinner.el);
		}
	};
});
