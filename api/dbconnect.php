<?php

	// this will avoid mysql_connect() deprecation error.
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	// but I strongly suggest you to use PDO or MySQLi.

	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBNAME', 'schillerpoints_de');

	$con = mysqli_connect(DBHOST,DBUSER,DBPASS);
	$dbcon = mysqli_select_db($con, DBNAME) or die(mysqli_error($con));

	mysqli_set_charset($con, 'utf8');

	if ( !$con ) {
		die("Connection failed : " . mysql_error());
	}

	if ( !$dbcon ) {
		die("Database Connection failed : " . mysql_error());
	}

	define("USERBASE","users");
	define("PRJBASE","projects");
	define("POLLBASE","polls");
