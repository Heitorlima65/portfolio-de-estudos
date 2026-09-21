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
			require("cryp2graph2.php");

			$diasValidade = 15;				//QUANTOS DIAS PARA VENCER A SENHA//
	
			$sql ="select nomePessoa, senhaPessoa, tipoSenhaPessoa, errosLoginPessoa, validadeSenha from pessoa";
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
			$result=mysqli_stmt_bind_result($stmt, $nomePessoa,$senhaPessoa, $tipoSenhaPessoa, $errosLoginPessoa, $validadeSenha);
			if (!$result) {
				die("Não foi possível recuperar dados do BD. ");
			}
			$linhaBD=mysqli_stmt_fetch($stmt);
			if (!$linhaBD) {
				die("Não foi possível localizar CPF no banco de dados. ");
			}
			$stmtClose1=mysqli_stmt_close($stmt);
			if(!$stmtClose1){
				echo("não foi possivel fechar consulta!");
			}
			if ( checasenha($senha,$senhaPessoa) ) {
				$sqlReset = "update pessoa set errosLoginPessoa = 0 where CPFPessoa = ?";
				$stmtReset = mysqli_prepare($BDconn, $sqlReset);
				if(!$stmtReset){
					echo("não foi possivel resetar!");
				}
				$paramReset=mysqli_stmt_bind_param($stmtReset, "s", $CPF);
				if(!$paramReset){
					echo("não foi possivel resetar!!");
				}
				$execReset=mysqli_stmt_execute($stmtReset);
				if(!$execReset){
					echo("não foi possivel resetar.");
				}
				
				$session=session_start();
				if (!$session) {
					die("Não possível iniciar a sessão. ");
				}
				$_SESSION['CPFPessoa']=$CPF;
				$_SESSION['nomePessoa']=$nomePessoa;
				$_SESSION['tipoSenhaPessoa'] = $tipoSenhaPessoa;
				$dataExpiracao = strtotime($validadeSenha . " + $diasValidade days");
				if ($dataExpiracao <= time()) {

					// Senha expirou
					ob_clean();

					header("Location: trocaSenha01.php");
					exit();

				}
				if ($tipoSenhaPessoa == 'S') {
					ob_clean();
					header("Location: trocaSenha01.php");
					exit();
				} else {
					ob_clean();
					header("Location: menu.php");
					exit();
				}
			} else {
				$novoErros = $errosLoginPessoa + 1;
				if ($novoErros >= 3) {

					// busca o email prioritário da pessoa
					$sqlEmail = "select emailPessoa from pessoaEmail where CPFPessoa=? and prioritario='S'";
					if(!$sqlEmail){
						echo("não foi possivel fazer a busca no BD.");
					}
					$stmtEmail = mysqli_prepare($BDconn, $sqlEmail);
					if(!$stmtEmail){
						echo("não foi possivel fazer a busca no BD!");
					}
					$paramErros=mysqli_stmt_bind_param($stmtEmail, "s", $CPF);
					if(!$paramErros){
						echo("não foi possivel capturar informações do BD!");
					}
					$execerros=mysqli_stmt_execute($stmtEmail);
					if(!$execerros){
						echo("não foi possivel fazer a a busca no BD.");
					}
					$resultErros=mysqli_stmt_bind_result($stmtEmail, $emailPessoa);
					if(!$resultErros){
						echo("não foi possivel obter o resultado da operação!");
					}
					$temEmail = mysqli_stmt_fetch($stmtEmail);
					if(!$temEmail){
						echo("não foi possivel obter o resultado da operação.");
					}
					$stmtClose=mysqli_stmt_close($stmtEmail);
					if(!$stmtClose){
						echo("não foi possivel Realizar a operação!");
					}

					if ($temEmail) {
						$novaSenhaTexto = CriaAlgo(8);
						$novaSenhaCripto = FazSenha($CPF, $novaSenhaTexto);

						$sqlBloqueia = "update pessoa set senhaPessoa=?, tipoSenhaPessoa=?, errosLoginPessoa=0, validadeSenha=NOW() where CPFPessoa=?";
						$tipoSenhaS = "S";
						$stmtBloqueia = mysqli_prepare($BDconn, $sqlBloqueia);
						if(!$stmtBloqueia){
							echo("não foi possivel realizar a acão!!");
						}
						$paramBloqueia=mysqli_stmt_bind_param($stmtBloqueia, "sss", $novaSenhaCripto, $tipoSenhaS, $CPF);
						if(!$paramBloqueia){
							echo("não foi possivel realizar a acão!!!");
						}
						$execBloqueia=mysqli_stmt_execute($stmtBloqueia);
						if(!$execBloqueia){
							echo("não foi possivel realizar a acão...");
						}
						$stmtCloseBloquar=mysqli_stmt_close($stmtBloqueia);
						if(!$stmtCloseBloquar){
							echo("não foi possivel fechar");
						}

						require("email.php");
						$assunto = "Bloqueio por tentativas de login";
						$mensagem = "Detectamos 3 tentativas de login incorretas na sua conta.<br>";
						$mensagem.= "Por segurança, geramos uma nova senha temporária: <b>".$novaSenhaTexto."</b><br>";
						$mensagem.= "Faça login com ela — você será solicitado a trocá-la em seguida.";
						mandarEmail($nomePessoa, $emailPessoa, $assunto, $mensagem);
					} else {
						// sem email cadastrado: zera o contador pra não travar a conta sem forma de recuperação
						$sqlZera = "update pessoa set errosLoginPessoa=? where CPFPessoa=?";
						$errosLoginPessoa = 0;
						$stmtZera = mysqli_prepare($BDconn, $sqlZera);
						if(!$stmtZera){
							echo("não foi possivel zerar!");
						}
						$paramZera=mysqli_stmt_bind_param($stmtZera, "is", $errosLoginPessoa, $CPF);
						if(!$paramZera){
							echo("não foi possivel zerar!!");
						}
						$execZera=mysqli_stmt_execute($stmtZera);
						if(!$execZera){
							echo("não foi possivel zerar.");
						}
						$stmtCloseZera=mysqli_stmt_close($stmtZera);
						if(!$stmtCloseZera){
							echo("não foi possivel fechar consulta!!!");
						}
					}

					echo("Número máximo de tentativas atingido. <br>Uma nova senha foi enviada para o seu email cadastrado.");

				} else {
					$sqlIncrementa = "update pessoa set errosLoginPessoa = errosLoginPessoa + 1 where CPFPessoa=?";
					$stmtIncrementa = mysqli_prepare($BDconn, $sqlIncrementa);
					mysqli_stmt_bind_param($stmtIncrementa, "s", $CPF);
					mysqli_stmt_execute($stmtIncrementa);

					$restantes = 3 - $novoErros;
					echo("Combinação de CPF/Senha não localizada! Você tem mais $restantes tentativa(s) antes do bloqueio.");
					echo "<br><br><a href='tela01.php'>Voltar para o Login</a>";
				}
				echo("Combinação de CPF/Senha não localizado! ");
				echo "<br><br><a href='tela01.php'>Voltar para o Login</a>";
			}
		?>
	</body>
</html>