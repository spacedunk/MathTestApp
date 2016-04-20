$(document).ready(function(){
    $("#CreateQuestion").click(function(){
        $.post("ExamPOC.php",
        {
            F: "CreateQuestion",
            Type: $("#type").val(),
            Title: $("#title").val(),
            Description: $("#desc").val(),
            Text: $("#text").val(),
            Answer: $("#answer").val()
        },
        function(data, status)
        {
            $("#txtExport").html("<p>Question Added Successfully</p>");
        }
        );
    });
});