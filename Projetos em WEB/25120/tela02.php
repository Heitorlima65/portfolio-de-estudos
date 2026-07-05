<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
	</head>
	<body>
		<?php
			$CPF=$_POST['CPF'];
			$senha=$_POST['senha'];
			if (empty($CPF)) {
				die("Preencha o CPF.");
			}
			if (empty($senha)) {
				die("Preencha a senha.");
			}
			require("BDconnecta.php");		
			$sql ="select nomePessoa, senhaPessoa from pessoa";
			$sql.="		where ";
			$sql.="			CPFPessoa = ? ";
			$stmt=mysqli_prepare($BDconn, $sql);
			if (!$stmt) {
				die("Não foi possível preparar a consulta no BD. ");
			}
			$param=mysqli_stmt_bind_param($stmt, "s", $CPF);
			if (!$param) {
				die("Não foi possível vincular parâmetro da consulta no BD. ");
			}
			$exec=mysqli_stmt_execute($stmt);
			if (!$exec) {
				die("Não foi possível executar consulta no BD. ");
			}
			$result=mysqli_stmt_bind_result($stmt, $nomePessoa,$senhaPessoa);
			if (!$result) {
				die("Não foi possível recuperar dados do BD. ");
			}
			$linhaBD=mysqli_stmt_fetch($stmt);
			if (!$linhaBD) {
				die("Não foi possível localizar CPF no banco de dados. ");
			}
			require("cryp2graph2.php");
			if ( checasenha($senha,$senhaPessoa) ) {
				$session=session_start();
				if (!$session) {
					die("Não possível iniciar a sessão. ");
				}
				$_SESSION['CPFPessoa']=$CPF;
				$_SESSION['nomePessoa']=$nomePessoa;
				ob_clean();
				header("Location: menu.php");
			} else {
				echo("Combinação de CPF/Senha não localizado! ");
			}
		?>
	</body>
</html>