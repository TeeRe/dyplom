<?php

 //    define("HOST", "mysql.hostinger.com.ua");
	// define("USER", "u401033836_thug");
	// define("PASSWORD", "thuglife");
	// define("DB", "u401033836_asylum");


	define("HOST", "localhost");
	define("USER", "root");
	define("PASSWORD", "thuglife");
	define("DB", "u659288337_asylum");


	$db = mysql_connect(HOST, USER, PASSWORD) or die (mysql_error());
    mysql_query('SET NAMES utf-8');
	mysql_select_db(DB, $db) or die (mysql_error());

    mysql_query("set character_set_client	='utf8'");
    mysql_query("set character_set_results	='utf8'");
    mysql_query("set collation_connection	='utf8_general_ci'");

    function slashes(&$el)
	{
		if (is_array($el))
			foreach($el as $k=>$v)
				slashes($el[$k]);
		else $el = stripslashes($el); 
    }

	if (ini_get('magic_quotes_gpc'))
	{
	    slashes($_GET);
	    slashes($_POST);    
	    slashes($_COOKIE);
	}
?>