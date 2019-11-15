  function verifyEnrollment(str){
        $.get('../php/ClientVerifyEnrollment.php',{'eposta':str}, function (d) {
                $("#pasahitz").html($(d));
        });        
 }