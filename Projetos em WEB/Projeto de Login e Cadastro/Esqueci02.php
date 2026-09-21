<?php

    $CPF = $_POST['CPF'];
    if(empty($CPF)){
		die("Preencha o CPF");
    }
    require("BDconnecta.php");
    $sql = "select emailPessoa from pessoaEmail where CPFPessoa=? and prioritario='S'";
    $stmt=mysqli_prepare($BDconn,$sql);
    if(!$stmt){
        die("Erro na preparação da consulta");
    }
    $param=mysqli_stmt_bind_param($stmt,"s",$CPF);
    if(!$param){
        die("Erro na vinculação do parâmetro");
    }
    $exec=mysqli_stmt_execute($stmt);
    if(!$exec){
        die("Erro na execução da consulta");
    }
    $result=mysqli_stmt_bind_result($stmt, $emailPessoa);
    if(!$result){
        die("Erro na vinculação do resultado");
    }
    $linhaBD=mysqli_stmt_fetch($stmt);
    if(!$linhaBD){
        die("CPF não encontrado");
    }
    require("cryp2graph2.php");

    mysqli_stmt_free_result($stmt);
    $novaSenhaTexto = CriaAlgo(8);
    $novaSenhaCripto = FazSenha($CPF, $novaSenhaTexto);

    $sqlUpdate = "UPDATE pessoa SET senhaPessoa = ? , tipoSenhaPessoa = ? WHERE CPFPessoa = ?";
    $stmtUpdate = mysqli_prepare($BDconn, $sqlUpdate);
    $tipoSenha = "S";
    if(!$stmtUpdate){
        die("Erro na preparação da consulta");
    }
    $bindParam=mysqli_stmt_bind_param($stmtUpdate, "sss", $novaSenhaCripto, $tipoSenha, $CPF);
    if(!$bindParam){
        echo("nao foi possivel fazer a acão!");
    }
    $stmtExecuteSenha=mysqli_stmt_execute($stmtUpdate);
    if(!$stmtExecuteSenha){
        echo("nao foi possivel realizar a ação!");
    }
    require('email.php');
    $assunto = "Recuperacao de Senha";
    $mensagem = "Ola!<br>Sua nova senha de acesso e: <b>" . $novaSenhaTexto . "</b>";
    $enviado = mandarEmail("Usuario", $emailPessoa, $assunto, $mensagem);
    if ($enviado) {
    echo "<br>Uma nova senha foi gerada e enviada para: " . $emailPessoa;
    echo "<br><a href='tela01.php'>Voltar para o Login</a>";
    } else {
        echo "<br>Sua nova senha foi gerada, mas houve um erro no envio do e-mail.";
        echo "<br><a href='tela01.php'>Voltar para o Login</a>";
    }
?>