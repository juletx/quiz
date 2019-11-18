$(document).ready(function () {
	$("#eposta").focusout(function () {
		var eposta = $("#eposta").val();
		$.get('../php/ClientVerifyEnrollment.php', { 'eposta': eposta }, function (d) {
			if (d === "Eposta WSn matrikulaturik dago") {
				$("#matrikulatuta").css('color', 'green');
				if ($("#baliozkoa").text() === "Pasahitz balioduna") {
					$("#submit").prop('disabled', false);
				}
			} else {
				$("#matrikulatuta").css('color', 'red');
			}
			$("#matrikulatuta").html(d);
		});
	});
});