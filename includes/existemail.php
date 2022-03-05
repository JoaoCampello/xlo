<?php

	$q=$_REQUEST["q"]; // recebe uma parâmetro por GET
	$lig= new mysqli ("papserver.aelc.pt", "Joao31523", "Leal2020", "Joao31523"); 
	$s="select * from Utilizador where Email = '$q'";
	$res=$lig->query($s); 
	$l=$res->fetch_array();
	if($l)
		echo "Email já existente";
?>
