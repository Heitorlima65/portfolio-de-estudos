<?php
	$session=session_start();
	if (!$session) {
		die("Não foi possível recuperar a sessão. ");
	}
	if(!isset($_SESSION['CPFPessoa'])){
		ob_clean();
		header("location: tela01.php");
		exit();
	}
	if (isset($_SESSION['tipoSenhaPessoa']) && $_SESSION['tipoSenhaPessoa'] == 'S') {
		$paginaAtual = basename($_SERVER['PHP_SELF']);
		if ($paginaAtual != 'mudSenha02.php' && $paginaAtual != 'mudSenha03.php' && $paginaAtual != 'sair.php') {
			header("location: mudSenha02.php");
			exit();
		}
	}
?>