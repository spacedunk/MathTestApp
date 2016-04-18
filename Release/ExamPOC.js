$(document).ready(function(){
    $("#GetUsers").click(function(){
        $.get("ExamPOC.php", function(data, status){
            $("#txtHi").html(data);
            $("#btnPDF").removeClass("disabled");
        });
    });
    $("#GetExport").click(function(){
       /*$.get("ExportToPDF.php",function(data,status){
            window.open(data);
       });*/

       getPDF(); 
    });
});

var _AJAX_DONE = 4;
var _AJAX_OK = 200;

function getPDF(){
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "ExportToPDF.php", true);
    ajax.responseType = 'blob';
    ajax.onreadystatechange = function(){
        if(ajax.readyState === _AJAX_DONE){
            if(ajax.status === _AJAX_OK){
                console.log("got response:");
                var blob = new Blob([ajax.response], {type: "octet/stream"});
                if(window.navigator.msSaveOrOpenBlob)
                {
                    console.log("this is ie");
                    window.navigator.msSaveOrOpenBlob(blob, "sample.pdf");
                }
                else
                {
                    var url = window.URL.createObjectURL(blob);
                    console.log(url);
                    var temp = document.createElement("a");
                    document.body.appendChild(temp);
                    temp.href = url;
                    temp.download = "sample.pdf";
                    temp.style = "display: none";
                    temp.click();
                    window.URL.revokeObjectURL(url);
                }
                
            }
            else
            {
                console.log("some error: " + ajax.status);
            }
        }
    };
    
    ajax.send("moo");
};