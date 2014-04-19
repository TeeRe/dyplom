$('.details-post, .author-post, .create-post, .likes').button().disableSelection();

$('.find-user-info').button({
		text: false,
		icons: {
			primary: "ui-icon-info"
		},
		label: "На страницу пользователя"
});

$('.find-user-receiver').button({
		text: false,
		icons: {
			primary: "ui-icon-mail-closed"
		},
		label: "Отправить сообщение пользователю"
});

$(document).ready(function(){
	var post_id = window.location.search.substring(3);
});