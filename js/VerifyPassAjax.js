$(document).ready(function () {
	$("#pasahitza").focusout(function () {
		var pasahitza = $("#pasahitza").val();
		$.get('../php/ClientVerifyPass.php', { 'pasahitza': pasahitza }, function (d) {
			if (d === "Pasahitz balioduna") {
				$("#baliozkoa").css('color', 'green');
				if ($("#matrikulatuta").text() === "Eposta WSn matrikulaturik dago") {
					$("#submit").prop('disabled', false);
				}
			} else {
				$("#baliozkoa").css('color', 'red');
			}
			$("#baliozkoa").html(d);
		});
	});
});
