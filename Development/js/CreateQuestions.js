$(document).ready(function(){
    $("#CreateQuestion").click(function(){
        $("#txtQuestion").html("");
        var data = new FormData();
        data.append('fileImage',document.getElementById('imageFile').files[0]);
        data.append('Title',$("#title").val());
        data.append('F',"UploadImage");
        $.ajax(
        {   
            url: "http://localhost/php/ExamPOC.php",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data)
            {
                $.post("http://localhost/php/ExamPOC.php",
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
                });
            }
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