<?php

$c = oci_connect('system', '5590', 'localhost:1522/orcl');
	
	if (!$c) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	}
?>