$(document).ready(function () {
	// set endpoint and your access key
	var ip = 'check';
	var access_key = 'e31395d9a77b1e2f9bf95eddcc9c4c0f';

	// get the API result via jQuery.ajax
	$.ajax({
		url: 'http://api.ipstack.com/' + ip + '?access_key=' + access_key + '&hostname=1',
		dataType: 'jsonp',
		success: function (json) {
			$("tbody tr td").eq(1).text(json.ip);
			$("tbody tr td").eq(2).text(json.hostname);
			$("tbody tr td").eq(3).text(json.continent_name);
			$("tbody tr td").eq(4).text(json.country_name);
			$("tbody tr td").eq(5).text(json.region_name);
			$("tbody tr td").eq(6).text(json.city);
			$("tbody tr td").eq(7).text(json.zip);
		},
		error: function () {
			alert("Errorea zerbitzarira konektatzerakoan");
		}
	});
});