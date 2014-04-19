$( "#show-password" ).button({
    text: false,
    icons:{
                primary: 'ui-icon-locked'
            }
        
})
.click(function() {
    var options;
    if ( $( this ).text() === "Показать пароли" ) {
        options = {
            label: "Скрыть пароли",
            icons:{
                primary: 'ui-icon-unlocked'
            },
            text: false
        };
        $('#changePassword1').removeAttr('type');
        $('#changePassword1').attr('type', 'text');
        $('#changePassword2').removeAttr('type');
        $('#changePassword2').attr('type', 'text');
        $('#changePassword3').removeAttr('type');
        $('#changePassword3').attr('type', 'text');
    } else {
        options = {
            label: "Показать пароли",
            icons:{
                primary: 'ui-icon-locked'
            },
            text: false
        };
        $('#changePassword1').removeAttr('type');
        $('#changePassword1').attr('type', 'password');
        $('#changePassword2').removeAttr('type');
        $('#changePassword2').attr('type', 'password');
        $('#changePassword3').removeAttr('type');
        $('#changePassword3').attr('type', 'password');
    }
    $( this ).button( "option", options );
});

setPassword();
setEmail();
setLogin();

var returnedPassword;
var returnedEmail;
var returnedLogin;
function setPassword()   
    {   
         $.ajax({   
            url: "settings/setpassword.php",   
            cache: false,   
            success: function(k){
                returnedPassword = k;   
            }
        });       
    };

function setEmail()   
    {   
         $.ajax({   
            url: "settings/setmail.php",   
            cache: false,   
            success: function(l){
                returnedEmail = l;
            }
        });       
    };

function setLogin()  
    {   
         $.ajax({   
            url: "settings/setlogin.php",   
            cache: false,   
            success: function(m){
                returnedLogin = m;
                $('.log').html(m);
            }
        });
    };  

$(document).ready(function(){
    function checkMail( x, y, z)
    {        
        if ( y.val() != z.val())
        {
            updateTips( "E-mail'ы не совпадают!", y );
            z.addClass( 'changeError' );
            return true;
        }

        if ( x.val() != returnedEmail )
        {
            updateTips( 'Вы ввели неверный e-mail!', x );
            x.val('');
            return true;
        }
        else
        {
            return false;
        }
    };

    function checkPassword( x, y, z)
    {
        if ( y.val() != z.val())
        {
            updateTips( "Пароли не совпадают!", y );
            z.addClass( 'changeError' );
            return true;
        }

        if ( x.val() != returnedPassword )
        {
            updateTips( 'Вы ввели неверный пароль!', x );
            x.val('');
            return true;
        }
        else
        {
            return false;
        }
    };

    $('.submitEditPage').button();
    $('#changeBday').datepicker( $.datepicker.regional[ "ru" ] );
    var tips = $( "#privateChanges" );

    function updateTips( t, form ) {
            tips
                .text( t )
                .addClass( "ui-state-highlight" );
                $('.changeInformation input').removeClass('changeError');
                form.addClass('changeError');
            setTimeout(function() {
                tips.removeClass( "ui-state-highlight", 1500 );
            }, 500 );
        };

    function checkLength(o , n, minimum, maximum) {
        var symb; 
        if (minimum == 2) symb = ' символа!';
        else symb = ' символов!';
        
        if (o.val().length <= minimum || o.val().length > maximum)
        {
            if(o.val().length <= minimum) updateTips( "Минимальная длина " + n + " " + (minimum+1) + symb, o );
            else updateTips( "Максимальная длина " + n + " " + (maximum) + ' символов!', o ); 
            return false;
        }
        else
        {           
            return true;
        }
    };

    function checkRegexp( o, regexp, n ) {
        if ( !( regexp.test( o.val() )) ) 
        {
            o.addClass( "changeError" );
            updateTips( n, o );
            return false;
        } 
        else 
        {
            return true;
        }
    };

    $('#changeNameForm').ajaxForm({
        beforeSubmit: function(){
            var cName = $('#changeName');
            if(
                (checkLength( cName, 'имени - ', 2, 10 )) &&
                (checkRegexp( cName, /^[a-zа-я]([0-9a-zа-я_])+$/i, "Неверный формат имени!" ))
                )
            {
                updateTips( 'Имя изменено!', cName );
                cName.val('');
                $('.changeInformation input').removeClass('changeError');
                return true;                
            }
            else
            {
                return false;
            }
        }
    });

    $('#changeSurnameForm').ajaxForm({
        beforeSubmit: function(){
            var cSurname = $('#changeSurname');
            if(
                (checkLength( cSurname, 'фамилии - ', 2, 10 )) &&
                (checkRegexp( cSurname, /^[a-zа-я]([0-9a-zа-я_])+$/i, "Неверный формат фамилии!" )) 
            )
            {
                updateTips( 'Фамилия изменена!', cSurname );
                cSurname.val('');
                $('.changeInformation input').removeClass('changeError');
                return true;                
            }
            else
            {
                return false;
            }
        }
    });

    $('#changeLoginForm').ajaxForm({
        beforeSubmit: function(){
            var cLogin = $('#changeLogin');                   
            if(
                (checkLength( cLogin, 'логина - ', 2, 8 )) &&
                (checkRegexp( cLogin, /^[a-z]([0-9a-z_])+$/i, "Неверный формат логина!" ))
            )
            {
                updateTips( 'Логин изменен!', cLogin );
                cLogin.val('');
                $('.changeInformation input').removeClass('changeError');
                return true;                
            }
            else
            {
                return false;
            }
        },
        success: function(){
            setLogin();
        }
    });

    $('#changeBdayForm').ajaxForm({
        beforeSubmit: function(){
            var cBday = $('#changeBday');
            if(
                (checkLength( cBday, 'даты рождения - ', 9, 10 )) &&
                (checkRegexp( cBday, /^([0-2]\d|3[01])\/(0\d|1[012])\/([1-2]\d{3})$/i, "Неверный формат даты рождения!" ))
            )
            {
                updateTips( 'Дата рождения изменена!', cBday );
                cBday.val('');
                $('.changeInformation input').removeClass('changeError');
                return true;                
            }
            else
            {
                return false;
            }
        }
    });

    $('#changeMailForm').ajaxForm({
        beforeSubmit: function(){
            if(
                (!checkLength( $('#changeMail1'), "e-mail'a - ", 5, 20 )) ||
                (!checkLength( $('#changeMail2'), "e-mail'a - ", 5, 20 )) ||
                (!checkLength( $('#changeMail3'), "e-mail'a - ", 5, 20 )) ||
                (!checkRegexp( $('#changeMail1'), /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "Неверный формат e-mail'a!" )) ||
                (!checkRegexp( $('#changeMail2'), /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "Неверный формат e-mail'a!" )) ||
                (!checkRegexp( $('#changeMail3'), /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "Неверный формат e-mail'a!" )) ||
                (checkMail( $('#changeMail1'), $('#changeMail2'), $('#changeMail3') ) )
            )
            {  
                return false;
            }
            else
            {
                updateTips( 'E-mail изменен!', $('#changeMail1') );
                $('#changeMail1').val('');
                $('#changeMail2').val('');
                $('#changeMail3').val('');
                $('.changeInformation input').removeClass('changeError');
                return true;
            }
        },
        success: function(){
            setEmail();
        }
    });

    $('#changePasswordForm').ajaxForm({
        beforeSubmit: function(){
            if(     
                (!checkLength( $('#changePassword1'), "пароля - ", 5, 24 )) ||
                (!checkLength( $('#changePassword2'), "пароля - ", 5, 24 )) ||
                (!checkLength( $('#changePassword3'), "пароля - ", 5, 24 )) ||
                (checkPassword( $('#changePassword1'), $('#changePassword2'), $('#changePassword3') ) )
            )
            {  
                return false;
            }
            else
            {
                updateTips( 'Пароль изменен!', $('#changePassword1') );
                $('#changePassword1').val('');
                $('#changePassword2').val('');
                $('#changePassword3').val('');
                $('.changeInformation input').removeClass('changeError');
                return true;
            }
        },
        success: function(){
            setPassword();
        }
    });

    $( "#add-feed-visible-setting" ).buttonset();
    $( '#add-feed-visible-hide, #add-feed-visible-show' ).click(
        function(){
            $( "#add-feed-visible-form" ).ajaxSubmit();
        }
    );
    

}); //end document.ready