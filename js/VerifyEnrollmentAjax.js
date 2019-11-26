$(document).ready(function () {
	$('#eposta').on('change input', function () {
		var eposta = $("#eposta").val();
		$.get('../php/ClientVerifyEnrollment.php', { 'eposta': eposta }, function (d) {
			if (d === "Eposta WSn matrikulaturik dago") {
				$("#matrikulatuta").css('color', 'green');
				if ($("#baliozkoa").text() === "Pasahitz balioduna") {
					$("#submit").prop('disabled', false);
				}
			} else {
				$("#matrikulatuta").css('color', 'red');
                $("#submit").prop('disabled', true);
            }
			$("#matrikulatuta").html(d);
		});
	});
});