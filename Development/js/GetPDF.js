var _AJAX_DONE = 4;
var _AJAX_OK = 200;

function getPDF(html){
    var data = new FormData();
    data.append('F','CreatePDF');
    data.append('html_string',html);
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "http://localhost/php/ExamPOC.php", true);
    ajax.responseType = 'blob';
    ajax.onreadystatechange = function(){
        if(ajax.readyState === _AJAX_DONE){
            if(ajax.status === _AJAX_OK){
                console.log("got response:");
                var blob = new Blob([ajax.response], {type: "octet/stream"});
                if(window.navigator.msSaveOrOpenBlob)
                {
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
    
    ajax.send(data);
};