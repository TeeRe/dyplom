<div id="content" class="ui-corner-all">
<div id="page_logo"></div>
<div class="form">
	<form method="post" action="" id="regform">
		<p><input type="text" 		name="regname" 		placeholder="Логин" 	value="" class="regname text ui-widget-content ui-corner-all" autocomplete="off"></p>

		<p><input type="password" 	name="regpassword1" placeholder="Пароль"  	value="" class="regpassword1 text ui-widget-content ui-corner-all" autocomplete="off"></p>

		<p><input type="password" 	name="regpassword2" placeholder="Пароль"  	value="" class="regpassword2 text ui-widget-content ui-corner-all" autocomplete="off"></p>

		<p><input type="text" 		name="regmail" 		placeholder="E-mail" 	value="" class="regmail text ui-widget-content ui-corner-all" autocomplete="off"></p>
		
        <p>
        	<button id="show-reg-passwords" type="button" >Показать пароли</button>
	        <input type="checkbox" name="iamnotrobot" id="iamnotrobot">
	        <label for="iamnotrobot">Я - не робот!</label>
	        <button class="regbutton" type="submit" >Зарегистрироваться</button>
	    </p>
	</form>
</div>
</div>

<div id="reg-success-message" title="Поздравляем!">
	<p></p>
</div>