$(document).ready(function(){
    $( document ).tooltip({
      track: true
    });
	
	$('.home').button({
			text: false,
			icons: {
				primary: "ui-icon-home"
			},
			label: "Главная"
	});

	$('.boards').button({
			text: false,
			icons: {
				primary: "ui-icon-note"
			},
			label: "Доски"
	});

	$('.messages').button({
			text: false,
			icons: {
				primary: "ui-icon-mail-closed"
			},
			label: "Сообщения"
	});

	$('.page').button({
			text: false,
			icons: {
				primary: "ui-icon-person"
			},
			label: "Моя страница"
	});

	$('.settings').button({
			text: false,
			icons: {
				primary: "ui-icon-wrench"
			},
			label: "Настройки"
	});

	$('.search').button({
			text: false,
			icons: {
				primary: "ui-icon-search"
			},
			label: "Поиск"
	});

	$('.exit').button({
			text: false,
			icons: {
				primary: "ui-icon-power"
			},
			label: "Выход"
	});

	$('.login').button({
			text: false,
			icons: {
				primary: "ui-icon-key"
			},
			label: "Вход"
	});

	$('.register').button({
			text: false,
			icons: {
				primary: "ui-icon-link"
			},
			label: "Регистрация"
	});

	$( '#error404 a, #post-in-draft a' ).button();
});