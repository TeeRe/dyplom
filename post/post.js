


$('.category-post').button();

$('#add-comment').autosize();
$('#add-comment-submit').button();

$('#like').ajaxForm({
	success: function(){
		var like = parseInt($('.like-post span').html(), "10")+1;
		$('.like-post span').html(like);

		var dislike = parseInt($('.dislike-post span').html(), "10");
		var dlp = $('.dislike-post').prop('disabled');

		if (dislike == 0) 
		{
			dislike = 0;
		}
		else if (dlp == true )
		{
			dislike = dislike - 1;
		}
		else if (dlp == false )
		{
			dislike = dislike + 0;
		}

		$('.dislike-post span').html(dislike);

		$('.like-post').prop('disabled', true);
		$('.dislike-post').prop('disabled', false);		
	}
});

$('#dislike').ajaxForm({
	success: function(){
		var dislike = parseInt($('.dislike-post span').html(), "10")+1;
		$('.dislike-post span').html(dislike);

		var like = parseInt($('.like-post span').html(), "10");
		var lp = $('.like-post').prop('disabled');

		if (like == 0) 
		{
			like = 0;
		}
		else if (lp == true )
		{
			like = like - 1;
		}
		else if (lp == false )
		{
			like = like + 0;
		}

		$('.like-post span').html(like);

		$('.dislike-post').prop('disabled', true);		
		$('.like-post').prop('disabled', false);
	}
});