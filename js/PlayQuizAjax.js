function next() {
	var galde = document.querySelectorAll('#form_galderak>div');
	for (var i = 0; i < galde.length; i++) {
		if (galde[i].style.display != 'none') {
			galde[i].style.display = 'none';
			if (i == galde.length - 1) {
				$.ajax({
					type: "POST",
					url: "ShowResult.php",
					data: $('#form_galderak').serialize(),
					success: function (d) {
						$("#galderak").hide();
						$("#emaitza").html(d);
						$("#galdera_gaia>fieldset").removeAttr("disabled");
					}
				});
			} else {
				galde[i + 1].style.display = 'block';
			}
			break;
		}
	}
}

$(document).ready(function () {
	$(".erantzun").click(function () {
		if ($(this).siblings(".form-group").find("input:radio").is(':checked')) {
			next();
		} else {
			alert('Aukeratu erantzun bat');
		}
	});

	$(".aldatu").click(function () {
		$(this).siblings(".form-group").find("input:radio").prop('checked', false);
		next();
	});

	$(".amaitu").click(function () {
		$(this).siblings(".form-group").find("input:radio").prop('checked', false);

		$.ajax({
			type: "POST",
			url: "ShowResult.php",
			data: $('#form_galderak').serialize(),
			success: function (d) {
				$("#galderak").hide();
				$("#emaitza").html(d);
				$("#galdera_gaia>fieldset").removeAttr("disabled");
			}
		});
	});
});