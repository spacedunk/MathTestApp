var editTestQuestions = angular.module("EditQuestionsTest", ['ng-sortable']);

editTestQuestions.controller("QuestionsController",function($scope,$http)
{
    var data = { F: "GetAllQuestions"};

    $http.post("http://localhost/php/ExamPOC.php",data).then(function(response)
    {
         $scope.questions = response.data.questions; 
    }
    );

    $scope.QuestionsConfig = {
        group: { name: "Questions", put: true}
     };
});

editTestQuestions.controller("TestQuestionsController",function($scope,$http)
{
    var data = { F: "GetTestQuestions", TID: "1"};

    $http.post("http://localhost/php/ExamPOC.php",data).then(function(response)
    {
         $scope.testquestions = response.data.test_questions; 
    }
    );

    $scope.TestQuestionsConfig = {
        group: { name: "TestQuestions", put: ['Questions'] }, 
        onAdd: function (evt) { 
          reOrderList(evt)
        },
        onUpdate: function (evt) { 
          reOrderList(evt)
        }  
     }; 
});

function reOrderList(evt){
  for(i = 0; i < evt.models.length; i++)
  {
    evt.models[i].QuestionNumber = i + 1; 
  }
}