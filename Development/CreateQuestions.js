$(document).ready(function(){
    $("#CreateQuestion").click(function(){
        var data = new FormData();
        data.append('fileImage',document.getElementById('imageFile').files[0]);
        data.append('Title',$("#title").val());
        data.append('F',"UploadImage");
        $.ajax(
        {   
            url: "ExamPOC.php",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data){
                alert(data);
            }
        }
 
        );
        $.post("ExamPOC.php",
        {
            F: "CreateQuestion",
            Type: $(".type").val(),
            Title: $("#title").val(),
            Description: $("#desc").val(),
            Text: $("#text").val(),
            Answer: $("#answer").val()
        },
        function(data, status)
        {
            $("#txtQuestion").html("<p>Question Added Successfully</p>");
        }
        );
    });
    $("#imageDiv").hide();
    $("#textDiv").hide();
    $(".type").change(function(){
        if($(this).val() == "Image")
        {
            $("#imageDiv").show();
            $("#textDiv").hide();
        }
        if($(this).val() == "Text")
        {
            $("#imageDiv").hide();
            $("#textDiv").show();
        }  
    });
});