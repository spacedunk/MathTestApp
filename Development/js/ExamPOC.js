$(document).ready(function(){
    $("#GetUsers").click(function(){
        $.post("http://localhost/php/ExamPOC.php",
        {
            F: "GetUsers"
        },
        function(data, status)
        {
            $("#txtHi").html(data);
            $("#btnPDF").removeClass("disabled");
        }
        );
    });
    $("#GetExport").click(function()
    {
        getPDF("<html><body><p>Hi</p></body></html>");
    });
});