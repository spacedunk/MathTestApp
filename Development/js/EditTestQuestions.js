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

function previewAsHTML()
{ 
  var html = convertTestQuestionListToHTMLString(document.getElementById("TQTexts").childNodes);
  
  var wnd = window.open("about:blank", "", "_blank");
  wnd.document.write(html);
}

function getTestPDF()
{
  var html = convertTestQuestionListToHTMLString(document.getElementById("TQTexts").childNodes);
  
  getPDF(html);
}

function convertTestQuestionListToHTMLString(list)
{
  var html = "<html><body>";
  for (var i = 0; i < list.length; ++i) 
  {
    if(list[i].nodeName == "LI")
    {
      for (var j = 0 ; j < list[i].childNodes.length; ++j) {
        if(list[i].childNodes[j].nodeName == "DIV")
        {
          html += list[i].childNodes[j].innerHTML; 
        }
      }
    }
  }

  html += "</body></html>";

  return html;
}