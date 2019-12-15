$(document).ready(function () {
	$("#jolastu").click(function () {
        var form = $("#galdera_gaia").get(0);
        $.ajax({
			url: "GetQuestions.php",
            type: 'POST',
		    data: new FormData(form),
		    mimeType: 'multipart/form-data',
		    contentType: false,
		    processData: false,
		    dataType: 'HTML',
			success: function (d) {
                $("#form").hide();
            }
		});
	});

	$("#erantzun").click(function () {
		$.ajax({
			url: "SaveResponse.php",
			data: $('#galdera').serialize(),
			success: function (d) {
			}
		});
	});

	$("#aldatu").click(function () {
        if( $('#selector').length )
        {
            
        }
    });

	$("#amaitu").click(function () {
		$.ajax({
			url: "ShowResult.php",
			data: $('#galdera').serialize(),
			success: function (d) {
			}
		});
	});
});