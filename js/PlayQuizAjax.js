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
					}
				});

				$("#galdera_gaia>fieldset").removeAttr("disabled");
			} else {
				galde[i + 1].style.display = 'block';
			}
			break;
		}
	}
}

$(document).ready(function () {
	$(".aldatu").click(function () {
		next();
	});

	$(".erantzun").click(function () {
		if ($("input:radio").is(':checked')) {
			next();
    	} else {
			alert('Aukeratu erantzun bat');
		}
	});

	$(".amaitu").click(function () {
		$.ajax({
			type: "POST",
			url: "ShowResult.php",
			data: $('#form_galderak').serialize(),
			success: function (d) {
				$("#galderak").hide();
				$("#emaitza").html(d);
			}
		});

		$("#galdera_gaia>fieldset").removeAttr("disabled");
	});
});