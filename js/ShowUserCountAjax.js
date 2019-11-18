$(document).ready(function () {
	$.get("IncreaseGlobalCounter.php");

	showUserCount();
	setInterval(showUserCount, 5000);

	function showUserCount() {
		$.post('../xml/Counter.xml', function (d) {
			var counter = $(d).find("counter").text();
			$("#erabiltzaileKop").html("<h2>Erabiltzaile kopurua</h2><p>Galderak kudeatzen ari diren erabiltzaileak: " + counter + "</p>");
		});
	}

	$(window).on("beforeunload", function () {
		$.get("DecreaseGlobalCounter.php");
	});
});