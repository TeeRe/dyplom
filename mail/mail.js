$(document).ready(function(){
	$( '#send-mail-text' ).focus();
});


$("#send-mail-receiver").autocomplete({
	source: "mail/source.php",
	minLength: 1
});

$( '#send-mail-text' ).autosize();
$( '#send-mail-submit' ).button();

$('.send-more').button({
		text: false,
		icons: {
			primary: "ui-icon-mail-closed"
		},
		label: "Написать еще"
});

$('.send-reply').button({
		text: false,
		icons: {
			primary: "ui-icon-mail-closed"
		},
		label: "Ответить"
});