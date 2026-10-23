<?php
    require("ses_start.php");
    $CPFPessoa = $_SESSION['CPFPessoa'];
    $senhaPessoa = $_POST['senhaPessoa'];
    $ConfirmacaoSenhaPessoa = $_POST['ConfirmacaoSenhaPessoa'];
    if (empty($senhaPessoa)) {
        die("Preencha a senha nova!");
    }
    if (empty($ConfirmacaoSenhaPessoa)) {
	    die("Preencha a confirmação da senha!");
	}
	if ($senhaPessoa!=$ConfirmacaoSenhaPessoa) {
		die("Senhas não conferem! Verifique!");
	}
    require("BDconnecta.php");
    $sql = "UPDATE pessoa SET senhaPessoa = ? , tipoSenhaPessoa = ?, validadeSenha = NOW() WHERE CPFPessoa = ?";
    $stmt=mysqli_prepare($BDconn,$sql);
    $tipoSenha = "U";
    if (!$stmt) {
		die("Não consegui preparar o cadastro no BD");
	}
	require("cryp2graph2.php");
	$senhaCrypto=FazSenha($CPFPessoa,$senhaPessoa);
	$param = mysqli_stmt_bind_param($stmt, "sss", $senhaCrypto, $tipoSenha, $CPFPessoa);
	if (!$param) {
		die("Não consegui vincular parâmetro da consulta no BD");
	}
    $exec=mysqli_stmt_execute($stmt);
	if (!$exec) {
		die("Não consegui executar cadastro no BD");
	}
    session_destroy();
    echo "<br> Senha atualizada com sucesso faça login novamento para validar seu acesso!";
    echo "<br><br><a href='tela01.php'>Voltar para o Login</a>";
?>