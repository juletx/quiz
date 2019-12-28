$(document).ready(function () {
	var liked = false;
	var disliked = false;

	$(".aldatu, .erantzun").click(function () {
		liked = false;
		disliked = false;
	});

	$(".fa-thumbs-up").click(function () {
		var likeCount = $(this).next();
		if (liked) {
			liked = false;
			likeCount.text(parseInt(likeCount.text()) - 1);
		} else {
			liked = true;
			likeCount.text(parseInt(likeCount.text()) + 1);
			if (disliked) {
				disliked = false;
				var dislikeCount = $(this).next().next().next();
				dislikeCount.text(parseInt(dislikeCount.text()) - 1);
			}
		}
	});

	$(".fa-thumbs-down").click(function () {
		var dislikeCount = $(this).next();
		if (disliked) {
			disliked = false;
			dislikeCount.text(parseInt(dislikeCount.text()) - 1);
		} else {
			disliked = true;
			dislikeCount.text(parseInt(dislikeCount.text()) + 1);
			if (liked) {
				liked = false;
				var likeCount = $(this).prev();
				likeCount.text(parseInt(likeCount.text()) - 1);
			}
		}
	});
});