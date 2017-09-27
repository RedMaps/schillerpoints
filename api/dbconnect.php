<?php

	// this will avoid mysql_connect() deprecation error.
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	// but I strongly suggest you to use PDO or MySQLi.

	define('DBHOST', 'schillerpoints.de.mysql');
	define('DBUSER', 'schillerpoints_de_q1');
	define('DBPASS', 'KJLhkk02');
	define('DBNAME', 'schillerpoints_de_q1');

	$con = mysqli_connect(DBHOST,DBUSER,DBPASS);
	$dbcon = mysqli_select_db($con, DBNAME) or die(mysqli_error($con));

	mysqli_set_charset($con, 'utf8');

	if ( !$con ) {
		die("Connection failed : " . mysql_error());
	}

	if ( !$dbcon ) {
		die("Database Connection failed : " . mysql_error());
	}

	date_default_timezone_set('Europe/Berlin');

	define("USERBASE","users_new");
	define("PRJBASE","projects_new");
	define("POLLBASE","polls");
	define("MONEYBASE","money");
