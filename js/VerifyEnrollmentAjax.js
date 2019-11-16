$(document).ready(function () {
	$("#eposta").focusout(function () {
		var eposta = $("#eposta").val();
		$.get('../php/ClientVerifyEnrollment.php', { 'eposta': eposta }, function (d) {
			if (d === "BAI") {
				$("#matrikulatuta").css('color', 'green');
				$("#matrikulatuta").html("Eposta WSn matrikulaturik dago");
			} else {
				$("#matrikulatuta").css('color', 'red');
				$("#matrikulatuta").html("Eposta ez dago WSn matrikulaturik");
				$("#submit").attr("disabled", "disabled");
			}
		});
	});
});