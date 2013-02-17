<?php
// Secret Settings

// Twitter OAuth KEY & TOKEN
// highta2
define('CONSUMER_KEY', '*****');
define('CONSUMER_SECRET', '*****');
define('ACCESS_TOKEN', '*****');
define('ACCESS_TOKEN_SECRET', '*****');

// pega3s
/*
define('CONSUMER_KEY', '*****');
define('CONSUMER_SECRET', '*****');
define('ACCESS_TOKEN', '*****');
define('ACCESS_TOKEN_SECRET', '*****');
*/

// Twitter Bot Form Login Password
define('FORM_PASSWORD', '*****');
define('ADMIN_PASSWORD','*****');

// Database Settings
if($_SERVER['SERVER_NAME']=="localhost"){
	// localhost
	define('SERVER', 'localhost');
	define('DB_ACCOUNT', 'root');
	define('DB_PASSWORD', 'root');
	define('DB_SCHEMA', 'PegasusTable');
	define('DB_TABLE', 'TextRes');
}
else{
	// lolipop
	define('SERVER', 'mysql597.phy.lolipop.jp');
	define('DB_ACCOUNT', 'LAA*****');
	define('DB_PASSWORD', '*****');
	define('DB_SCHEMA', 'LAA*****-*****');
	define('DB_TABLE', 'textres');
}
