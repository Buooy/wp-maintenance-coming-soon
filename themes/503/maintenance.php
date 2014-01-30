<?php

	/* Get the existing theme */
	$stylesheet_directory = get_stylesheet_directory();

	/* Check for the 503.php */
	if( !file_exists($stylesheet_directory.'/503.php') ){
		include $stylesheet_directory.'/503.php';
	}
	else{
		include dirname(dirname(__FILE__)).'/_default/maintenance.php';
	}

?>