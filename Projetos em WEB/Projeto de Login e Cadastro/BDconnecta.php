<?php
	try {
		ini_set("display_errors","1");
		$BDconn=mysqli_connect("10.112.132.17","root","Raul2016","25120");
		if ($BDconn) {
			echo("Conexão com o BD realizada. ");
		} else {
			die("Não foi possível conexão com o BD. ");
		}
	} catch (Exception $e) {
		die("O servidor indicou o erro: ".$e->getMessage().".");
	}
?>