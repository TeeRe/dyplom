$(document).ready(function(){
	var topic = $('#add-feed-topic-draft');
	var text = $('#add-feed-text-draft');
	var tag = $('#add-feed-tag-draft');

$('#add-feed-form-draft').ajaxForm({
    beforeSubmit: function(){
    	if (topic.val() == '')
    	{
    		errorMessage('Вы не ввели <b>заголовок</b>!', topic);
        	return false;
    	}
	    else if (text.val() == '')
        {
        	errorMessage('Вы не ввели <b>текст</b>!', text);
        	return false;
        }
        else if(tag.val() == '')
        {
        	errorMessage('Вы не ввели <b>категорию</b>!', tag);
        	return false;
        }
        else
        {
        	return true;
        }
    },
    success: function(){
		// topic.val('');
		// text.val('');
		// tag.val('');
		// errorMessage('Запись <b>успешно</b> добавлена!');
        document.location.href = "page.php";
        //TODO ajax-вывод нового сообщения
    }
});
});

function errorMessage(error, input){
	$( '.error_message p' ).html(error);
	$( '.error_message' ).dialog('open');
	input.focus();
}

$('#add-feed-submit-draft').button();
$('#add-feed-text-draft').autosize();

$( '.tags-button button' ).button();

function insertTag(start, end)
{
var area = document.getElementById('add-feed-text-draft');
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
		insertTag('<'+ tag +' src="', '">');
	}
	else if(tag == 'a')
	{
		insertTag('<'+ tag +' href="', '"></a>');
	}
	else
	{
		insertTag('<'+ tag +'>', '</'+ tag +'>');
	}
});

$('.details-post, .edit-post, .category-post').button();

$("#add-feed-tag-draft").autocomplete({
	source: "page/source.php",
	minLength: 1
});

$( '.error_message' ).dialog({
		// show: {effect: "fadeIn", duration: 500},
		//hide: {effect: "fadeOut", duration: 1500},
		height: 80,
		width: 200,
		autoOpen: false,
		position: ['right', 'top']
}).parent().find('.ui-dialog-titlebar-close').removeAttr('title');

$('a').click(function(){
	$( '.error_message' ).dialog('destroy');
});