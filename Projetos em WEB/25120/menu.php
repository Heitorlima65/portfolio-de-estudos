<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		<style>
			
		</style>
	</head>
	<body>
		<a href="cadPes01.php">cadastrar</a><br>
		<br>
		<a href="sair.php">SAIR</a><br>
		<hr>
		<?php
			require("ses_start.php");
			$CPFPessoa=$_SESSION['CPFPessoa'];
			$nomePessoa=$_SESSION['nomePessoa'];

			echo("Nome: $nomePessoa<br>");
			echo("CPF: $CPFPessoa<br>");
		?>
	</body>
</html>