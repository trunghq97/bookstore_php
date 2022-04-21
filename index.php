<?php

	date_default_timezone_set('Asia/Ho_Chi_Minh');
	require_once 'define.php';

	function myAutoload($className)
	{
		require_once PATH_LIBRARY . "{$className}.php";
	}

	spl_autoload_register('myAutoload');

	Session::init();
	$bootstrap = new Bootstrap();
	$bootstrap->init();


?>