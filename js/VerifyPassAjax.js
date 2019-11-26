$(document).ready(function () {
	$('#pasahitza').on('change input', function () {
		var pasahitza = $("#pasahitza").val();
		$.get('../php/ClientVerifyPass.php', { 'pasahitza': pasahitza }, function (d) {
			if (d === "Pasahitz balioduna") {
				$("#baliozkoa").css('color', 'green');
				if ($("#matrikulatuta").text() === "Eposta WSn matrikulaturik dago") {
					$("#submit").prop('disabled', false);
				}
			} else {
				$("#baliozkoa").css('color', 'red');
                $("#submit").prop('disabled', true);
            }
			$("#baliozkoa").html(d);
		});
	});
});
