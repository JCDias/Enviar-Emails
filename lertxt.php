<?php
	$f = fopen("emails.txt", "r");

	// Lê cada uma das linhas do arquivo
	while(!feof($f)) { 
	    echo "'".trim(fgets($f))."',";
	}
	
	fclose($f);
?>