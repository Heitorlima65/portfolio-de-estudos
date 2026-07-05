<?php
	try {
		ini_set("display_errors","1");
		$BDconn=mysqli_connect("192.168.15.13","root","Raul2016","ServidorHeitor");
		if ($BDconn) {
			echo("Conexão com o BD realizada. ");
		} else {
			die("Não foi possível conexão com o BD. ");
		}
	} catch (Exception $e) {
		die("O servidor indicou o erro: ".$e->getMessage().".");
	}
?>