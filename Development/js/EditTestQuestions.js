var editTestQuestions = angular.module("EditQuestionsTest", []);

editTestQuestions.controller("EditTestQuestionsController",function($scope,$http)
{
/*
  $scope.names = [
      {name:'Jani',country:'Norway'},
      {name:'Hege',country:'Sweden'},
      {name:'Kai',country:'Denmark'}
      ];
*/
    var data = { F: "GetQuestions", TID: "1"};

    $http.post("http://localhost/php/ExamPOC.php",data).then(function(response)
    {
         $scope.names = response.data.questions; 
    });
});