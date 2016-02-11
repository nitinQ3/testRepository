<?php
/**
* Production Database Connection Details.
* DO NOT INCLUDE LIVE CREDENTIALS IN THIS FILE ON DEV SERVERS.
*/
$GLOBALS["database_local"] = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'lenderplatform_live',
		'prefix' => ''


		//'encoding' => 'utf8',
	);