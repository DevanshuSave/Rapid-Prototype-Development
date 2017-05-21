'use strict';

// Declare app level module which depends on views, and components
var app = angular.module('myApp', [
  'ngRoute',
  'myApp.view1',
  'myApp.view2',
  'myApp.version'
])
.controller('MainController', function($scope, $route, $routeParams, $location) {
    $scope.$route = $route;
    $scope.$location = $location;
    $scope.$routeParams = $routeParams;
	 
	$scope.coffees =
	[
	   {'id': 1,
	   'brand': "Average Andy's Coffee",
	   'name': 'Regular Coffee',
	   'country': 'Denmark',
	   'reviews': [
			   {'rating': 3,
			   'comment': "Could've been crispier",
			   'reviewer': "Chris P. Bacon"
			   }
	   ]
	   },
	   {'id': 2,
	   'brand': "Jimmy's Coffee",
	   'name': 'Mocha',
	   'country': 'America',
	   'reviews': [
	   {'rating': 10,
	   'comment': 'What everyone should drink in the morning!',
	   'reviewer': 'Earl Lee Riser'
	   },
	   {'rating': 10,
	   'comment': 'A genius of everything coffee',
	   'reviewer': 'Bob'
	   }
	   ]
	   },
	   {'id': 3,
	   'brand': "We Did Our Best",
	   'name': 'Latte',
	   'country': 'France',
	   'reviews': [
	   {'rating': 1,
	   'comment': " a 'latte' yuckiness.",
	   'reviewer': 'Tim Burr'
	   },
	   {'rating': 1,
	   'comment': 'Is this even coffee?',
	   'reviewer': 'Sue Flay'
	   },
		{'rating': 1,
	   'comment': 'The grossest thing I have ever had.',
	   'reviewer': 'Myles Long'
	   },
		{'rating': 5,
	   'comment': 'I dont know what the fuss is about, i dont think its too bad!',
	   'reviewer': 'Sara Bellum'
	   }
	   ]
	   },
	   {'id': 4,
	   'brand': "Jimmy's Special Coffee",
	   'name': 'Americano',
	   'country': 'America',
	   'reviews': [
	   {'rating': 10,
	   'comment': 'If I could rate it higher, I would!',
	   'reviewer': 'Justin Case'
	   },
	   {'rating': 10,
	   'comment': 'He does it again!',
	   'reviewer': 'Eileen Dover'
	   }
	   ]
	   }
	];
	var all_cafe = $scope.coffees.length;
	while(all_cafe>0){
        if($routeParams.cid==$scope.coffees[all_cafe-1].id){
                $scope.cafe = $scope.coffees[all_cafe-1];
        }
		all_cafe--;
	}

	//Nect 2 lines refered from http://fdietz.github.io/recipes-with-angular-js/common-user-interface-patterns/filtering-and-sorting-a-list.html
	$scope.filterfunction = function(element) {
		return element.name.match(/^Ma/) ? true : false;
	};
}
).config(function($routeProvider, $locationProvider) {
  $routeProvider
   .when('/coffees', {
    templateUrl: 'coffees.html',
    controller: 'MainController'
  })
  .when('/reviews/:cid', {
    templateUrl: 'reviews.html',
    controller: 'MainController'
  }
)
});
