$(document).ready(function(){

});

var editTestQuestions = angular.module("EditQuestionsTest", []);

editTestQuestions.controller("EditTestQuestionsController",function($scope)
{
  $scope.names = [
      {name:'Jani',country:'Norway'},
      {name:'Hege',country:'Sweden'},
      {name:'Kai',country:'Denmark'}
      ];
});