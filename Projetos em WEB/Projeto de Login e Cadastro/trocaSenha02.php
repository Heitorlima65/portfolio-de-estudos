<?php
    require("ses_start.php");
    $CPFPessoa = $_SESSION['CPFPessoa'];
    $senhaPessoa = $_POST['senhaPessoa'];
    if (empty($senhaPessoa)) {
        die("Preencha a senha nova!");
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
    echo "<br> Senha atualizada com sucesso faça login novamento para validar seu acesso!";
    echo "<br><br><a href='tela01.php'>Voltar para o Login</a>";
?>