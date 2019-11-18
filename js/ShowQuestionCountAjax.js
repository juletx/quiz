$(document).ready(function () {
	showQuestionCount();
	setInterval(showQuestionCount, 10000);

	function showQuestionCount() {
		$.post('../xml/Questions.xml', function (d) {
			var galderak = $(d).find("assessmentItem");
			var totalak = galderak.length;
			var nireak = 0;
			var eposta = $("#eposta").val();
			galderak.each(function () {
				if (eposta === $(this).attr("author")) {
					nireak++;
				}
			});
			$("#galderaKop").html("<h2>Galdera kopurua</h2><p>Zure galderak / Galdera totalak: " + nireak + " / " + totalak + "</p>");
		});
	}
});