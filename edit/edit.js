$(document).ready(function(){
	$('#edit-feed-text').focus();
});

$( '.tags-button button' ).button();
$('#edit-feed-text').autosize();

$("#edit-feed-tag").autocomplete({
	source: "page/source.php",
	minLength: 1
});

$( '#edit-feed-submit' ).button();

$('#delete-post').button().click(function(){
	$( "#delete-post-confirm" ).dialog('open');
});

$( '#draft-post-true' ).button().click(function(){
	$( "#draft-post-true-confirm" ).dialog('open');
});

$( '#draft-post-false' ).button().click(function(){
	$( "#draft-post-false-confirm" ).dialog('open');
});

function insertTag(start, end)
{
var area = document.getElementById('edit-feed-text');
area.focus();


if (document.getSelection)
{
  	area.value = 	area.value.substring(0,area.selectionStart)+start+area.value.substring(area.selectionStart, area.selectionEnd)+end+
  					area.value.substring(area.selectionEnd,area.value.length);
}

else
{
  var selectedText=document.selection.createRange().text;
  if (selectedText!='')
    var newText=start+selectedText+end;
    document.selection.createRange().text=newText;
  }
}

$( '.tags-button button' ).click(function(){
	var tag = $( this ).attr("id");

	if(tag == 'img')
	{
		insertTag('<'+ tag +' src="">', '');
	}
	else if(tag == 'a')
	{
		insertTag('<'+ tag +' href="">', '</a>');
	}
	else
	{
		insertTag('<'+ tag +'>', '</'+ tag +'>');
	}
});

$( "#delete-post-confirm" ).dialog({
	resizable: false,
	autoOpen: false,
	modal: true,
	buttons: {
		"Удалить": function() {
			var post_id = window.location.search.substring(6); //TODO
			$.ajax({
				url: 'edit/deletepost.php',
				type: 'POST',
				data: 'post_id='+post_id,
				success: function(){
					document.location.href = 'page.php';
				}
			});	
		},
		"Отменить": function() {
			$( this ).dialog( "close" );
		}
	}
});

$( "#draft-post-false-confirm" ).dialog({
	resizable: false,
	autoOpen: false,
	modal: true,
	buttons: {
		"Переместить": function() {
		  var post_id = window.location.search.substring(6);
			$.ajax({
				url: 'edit/draftpostfalse.php',
				type: 'POST',
				data: 'post_id='+post_id,
				success: function(){
					document.location.href = 'page.php';
				}
			});	
		},
		"Отменить": function() {
		  $( this ).dialog( "close" );
		}
	}
});

$( "#draft-post-true-confirm" ).dialog({
	resizable: false,
	autoOpen: false,
	modal: true,
	buttons: {
		"Переместить": function() {
		  var post_id = window.location.search.substring(6);
			$.ajax({
				url: 'edit/draftpost.php',
				type: 'POST',
				data: 'post_id='+post_id,
				success: function(){
					document.location.href = 'page.php';
				}
			});	
		},
		"Отменить": function() {
		  $( this ).dialog( "close" );
		}
	}
});