$(document).ready(function(){
    $("#CreateTest").click(function()
    {
        $("#txtTest").html("");
        $.post("ExamPOC.php",
        {
            F: "CreateTest",
            Title: $("#title").val(),
            Description: $("#desc").val(),
            Class: $("#class").val() 
        },
        function(data, status)
        {
            $("#txtTest").html("<p>Test Added Successfully</p>");
        });
    });
});