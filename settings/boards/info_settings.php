<?php
    include('../../mysql.php');
    header('Content-Type: text/html; charset=utf-8');
?>

<div id="privateChanges" align="center">Изменить данные:</div>
<div id="page_logo"></div>
<div id="center">
        <p class="bold">Личные: </p>
        <p>
            <form  id='changeNameForm' action='settings/changename.php' method='post' class="changeInformation" accept-charset="utf-8">
            <input id='changeName' name='changeName' type='text' class='ui-corner-all' placeholder='Имя' />
            <button type="submit" class="submitEditPage">Изменить</button>
            </form>    
        </p>
        <p>
            <form  id='changeSurnameForm' action='settings/changesurname.php' method='post' class="changeInformation" accept-charset="utf-8">
            <input id='changeSurname' name='changeSurname' type='text' class='ui-corner-all' placeholder='Фамилия' />
            <button type="submit" class="submitEditPage">Изменить</button>
            </form>
        </p>
        <p>
            <form  id='changeLoginForm' action='settings/changelogin.php' method='post' class="changeInformation" accept-charset="utf-8">
            <input id='changeLogin' name='changeLogin' type='text' class='ui-corner-all' placeholder='Логин' />
            <button type="submit" class="submitEditPage">Изменить</button>
            </form>
        </p>
        <p>
            <form  id='changeBdayForm' action='settings/changebday.php' method='post' class="changeInformation" accept-charset="utf-8">
            <input id='changeBday' name='changeBday' type='text' class='ui-corner-all' placeholder='Дата рождения' />
            <button type="submit" class="submitEditPage">Изменить</button>
            </form>
        </p>
        <p class="bold">E-mail:</p>
        <p>
            <form id='changeMailForm' action='settings/changemail.php' method='post' class="changeInformation" accept-charset="utf-8">
            <p><input id='changeMail1' name='changeMail1' type='text' class='ui-corner-all' placeholder='Введите новый E-mail' /></p>
            <p><input id='changeMail2' name='changeMail2' type='text' class='ui-corner-all' placeholder='Введите старый E-mail' /></p>
            <input id='changeMail3' name='changeMail3' type='text' class='ui-corner-all' placeholder='Повторите старый E-mail' />
            <button type="submit" class="submitEditPage">Изменить</button>
            </form>
        </p>
        <p class="bold">Пароль:</p>
        <p>
            <form id='changePasswordForm' action='settings/changepassword.php' method='post' class="changeInformation" accept-charset="utf-8">
            <p>
                <input id='changePassword1' name='changePassword1' type='password' class='ui-corner-all' placeholder='Введите старый пароль' />
                <button id="show-password">Показать пароли</button>
            </p>
            <p><input id='changePassword2' name='changePassword2' type='password' class='ui-corner-all' placeholder='Введите новый пароль' /></p>
            <input id='changePassword3' name='changePassword3' type='password' class='ui-corner-all' placeholder='Повторите новый пароль' />     
            <button type="submit" class="submitEditPage">Изменить</button>
            </form>
        </p>
        
</div>

<script src="settings/settings.js"></script>