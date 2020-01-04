$(document).ready(function () {
	var liked = false;
	var disliked = false;

	$(".aldatu, .erantzun").click(function () {
		liked = false;
		disliked = false;
	});

	$(".fa-thumbs-o-up, .fa-thumbs-up").click(function () {
		var likeCount = $(this).next();
		if (liked) {
			liked = false;
			likeCount.text(parseInt(likeCount.text()) - 1);
			$(this).removeClass("fa-thumbs-up").addClass("fa-thumbs-o-up");
		} else {
			liked = true;
			likeCount.text(parseInt(likeCount.text()) + 1);
			$(this).removeClass("fa-thumbs-o-up").addClass("fa-thumbs-up");
			if (disliked) {
				disliked = false;
				var dislikeCount = $(this).next().next().next();
				dislikeCount.text(parseInt(dislikeCount.text()) - 1);
				$(this).next().next().removeClass("fa-thumbs-down").addClass("fa-thumbs-o-down");
			}
		}
	});

	$(".fa-thumbs-o-down, .fa-thumbs-down").click(function () {
		var dislikeCount = $(this).next();
		if (disliked) {
			disliked = false;
			dislikeCount.text(parseInt(dislikeCount.text()) - 1);
			$(this).removeClass("fa-thumbs-down").addClass("fa-thumbs-o-down");
		} else {
			disliked = true;
			dislikeCount.text(parseInt(dislikeCount.text()) + 1);
			$(this).removeClass("fa-thumbs-o-down").addClass("fa-thumbs-down");
			if (liked) {
				liked = false;
				var likeCount = $(this).prev();
				likeCount.text(parseInt(likeCount.text()) - 1);
				$(this).prev().prev().removeClass("fa-thumbs-up").addClass("fa-thumbs-o-up");
			}
		}
	});
});
function isLiked(value){
    var name='isLiked'.concat(value);
    if($('input[name='+ name +']').val()=="1")
        $('input[name='+ name +']').val('0');
    else  $('input[name='+ name +']').val('1');
}
function notLiked(value){
    var name='isLiked'.concat(value);
    if($('input[name='+ name +']').val()=="-1")
        $('input[name='+ name +']').val('0');
    else  $('input[name='+ name +']').val('-1');
}