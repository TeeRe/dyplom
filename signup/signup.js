$(function(){
	loginname.focus();

	$( "#rememberme" ).button({    
		text: false,    
		icons: {        
			primary: "ui-icon-check"    
		}    
	}).click(
		function(){
			loginname.focus();
	});
	

	$('label').css({'width':'28px','height':'28px'});

	$('.loginbutton').button();

    $('#loginform').ajaxForm({
    	beforeSubmit: function(){
	    	var loginname = $( '#loginname' );
	    	var loginpassword = $( '#loginpassword' );
	    	var login = loginname.val();
	    	var pswd = loginpassword.val();
	    	if(login == '')
	    	{
	     		$().toastmessage('showErrorToast', 'Вы не ввели логин!');
	     		loginname.focus();
	        	return false;
	    	}	
	    	else if(pswd == '')
	    	{
	     		$().toastmessage('showErrorToast', 'Вы не ввели пароль!');
	     		loginpassword.focus();
	        	return false;
	    	}	
	    	else
	    	{
			$.ajax({
				url: 'signup/user_verify.php',
				type: 'POST',
				data: 'login='+login+'&password='+pswd,
				success: function(result){
						if(result=='true')
						{
							$().toastmessage('showErrorToast', 'Вы ввели неправильный логин или пароль!');
							loginname.focus();
							return false;
						}
						else
						{
							document.location.href = 'index.php';
						}
					
				}
			});

			} //endif	
    	} //end beforeSubmit event
	}); //end ajaxForm

}); //end ready