$(document).ready(function () {
	var location = window.location.href;
	$('.navbar-nav .nav-link').each(function () {
		if (location.indexOf(this.href) > - 1) {
			$(this).addClass('active');
		}
	});
});