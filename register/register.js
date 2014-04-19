$(function(){

var name = $('.regname');
var pswd1 = $('.regpassword1');
var pswd2 = $('.regpassword2');
var mail = $('.regmail');
var regbutton = $('.regbutton');

regbutton.button();

$( "#show-reg-passwords" ).button({	    
	text: false,	   
	icons:{	               
	primary: 'ui-icon-locked'	            
	}	        	
}).click(function() {	    
	var options;	    
	if ( $( this ).text() === "Показать пароли" ) 
	{	        
		options = {	   
			label: "Скрыть пароли",	            
			icons:{	                
				primary: 'ui-icon-unlocked'	            
			},	            
			text: false	        
		};	        

		pswd1.removeAttr('type');
		pswd2.removeAttr('type');
		pswd1.attr('type', 'password');
		pswd2.attr('type', 'password');

		pswd2.focus();
	} 
	else 
	{	        
		options = {	            
			label: "Показать пароли",	            
			icons:{	                
				primary: 'ui-icon-locked'	            
			},	            
			text: false	        
		};	        

		pswd1.removeAttr('type');
		pswd2.removeAttr('type');
		pswd1.attr('type', 'text');
		pswd2.attr('type', 'text');

		pswd2.focus();
	}	    

	$( this ).button( "option", options );	
}); //end click

name.focus();

$( '#reg-success-message' ).dialog({
	modal: true,
	autoOpen: false,
	buttons: {
		Ok: function(){
			document.location.href = 'signup.php';
			$( '#reg-success-message' ).dialog('close');
		}
	}
});

$( "#iamnotrobot" ).button({    
	text: false,    
	icons: {        
		primary: "ui-icon-check"    
	}    
});

var isSetLogin;
var isSetMail;

function loginValidation(){
	$.ajax({
		url: 'register/login_verify.php',
		type: 'POST',
		data: 'login='+name.val(),
		success: function(login_verify){
			if (login_verify == 'isSet')
			{
				isSetLogin = true;
			}
			else
			{
				isSetLogin = false;
			}
		}
	});
}

function mailValidation(){
	$.ajax({
		url: 'register/mail_verify.php',
		type: 'POST',
		data: 'mail='+mail.val(),
		success: function(mail_verify){
			if (mail_verify == 'isSet')
			{
				isSetMail = true;
			}
			else
			{
				isSetMail = false;
			}
		}
	});
}

name.change(function(){
	loginValidation();
});

mail.change(function(){
	mailValidation();
});


$('#regform').ajaxForm({
    	beforeSubmit: function(){
    		loginValidation();
    		mailValidation();
    		var check = $("#iamnotrobot").prop("checked");	

			if(name.val().length <= 2)
	    	{
	     		$().toastmessage('showErrorToast', 'Длина логина должна быть не меньше 3 символов!');
	     		name.focus();
	        	return false;
	    	}	
	    	else if(pswd1.val() == '')
	    	{
	     		$().toastmessage('showErrorToast', 'Вы не ввели пароль!');
	     		pswd1.focus();
	        	return false;
	    	}
	    	else if(pswd1.val() != pswd2.val())
	    	{
	    		$().toastmessage('showNoticeToast', 'Пароли не совпадают!');
	    		pswd2.focus();
	        	return false;
	    	}
	    	else if(mail.val().length <= 6) //TODO сделать проверку через regexp
	    	{
	    		$().toastmessage('showErrorToast', 'Вы ввели некорректный e-mail!');
	    		mail.focus();
	        	return false;
	    	}
	    	else if (isSetLogin == true)
			{
				$().toastmessage('showErrorToast', 'Этот логин занят!');
				name.focus();
				return false;
			}
			else if (isSetMail == true)
			{
				$().toastmessage('showErrorToast', 'Этот e-mail занят!');
				mail.focus();
				return false;
			}
			else if (check == false)
			{
				$().toastmessage('showNoticeToast', 'Подтвердите, что вы не робот!');
				name.focus();
				return false;
			}
			else
			{
				$( '#reg-success-message p' ).html('<p>Вы успешно зарегистрировались!</p><p>Ваш логин: '+name.val()+'</p><p>Ваш пароль: '+pswd1.val()+'</p><p>Ва e-mail: '+mail.val()+'</p><p>Нажмите "Ок" для перехода на страницу входа.</p>');
				$( '#reg-success-message' ).dialog('open');
				return true;
			} //endif
    	} //end beforeSubmit event
	}); //end ajaxForm

$('label').css({'width':'28px','height':'28px'});

}); //end document.ready