<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>cadastro-pessoa</title>
    </head>
    <body>
    <?php
			require("ses_start.php");
			$CPFPessoa=$_POST['CPFPessoa'];
			$nomePessoa=$_POST['nomePessoa'];
			$senha1=$_POST['senha1'];
			$senha2=$_POST['senha2'];
			if (empty($CPFPessoa)) {
				die("Preencha o CPF!");
			}
			if (empty($nomePessoa)) {
				die("Preencha o nome!");
			}
			if (empty($senha1)) {
				die("Preencha a senha!");
			}
			if (empty($senha2)) {
				die("Preencha a confirmação da senha!");
			}
			if ($senha1!=$senha2) {
				die("Senhas não conferem! Verifique!");
			}

			require("BDconnecta.php");
			$sql=" insert into pessoa (CPFPessoa,nomePessoa,senhaPessoa) values (?,?,?) ";
			$stmt=mysqli_prepare($BDconn,$sql);
			if (!$stmt) {
				die("Não consegui preparar o cadastro no BD");
			}
			require("cryp2graph2.php");
			$senhaCrypto=FazSenha($CPFPessoa,$senha1);
			$param=mysqli_stmt_bind_param($stmt, "sss", $CPFPessoa, $nomePessoa, $senhaCrypto);
			if (!$param) {
				die("Não consegui vincular parâmetro da consulta no BD");
			}
			$exec=mysqli_stmt_execute($stmt);
			if (!$exec) {
				die("Não consegui executar cadastro no BD");
			}
			if (isset($_POST['emails'])) {
				$vetEmails=$_POST['emails']; // 1 ou + emails no vetor

				$sqlEmails=" insert into pessoaEmail (CPFPessoa, emailPessoa) values (?,?) ";
				$stmtEmails=mysqli_prepare($BDconn,$sqlEmails);
				if (!$stmtEmails) {
					die("Não consegui preparar o cadastro de emails no BD");
				}
				$umEmail="";
				$paramEmail=mysqli_stmt_bind_param($stmtEmails, "ss", $CPFPessoa, $umEmail);
				if (!$paramEmail) {
					die("Não consegui vincular parâmetro de emails no cadastro do BD");
				}
				foreach ($vetEmails as $key => $value) {
					$umEmail=$value;
					$execEmail=mysqli_stmt_execute($stmtEmails);
					if (!$execEmail) {
						die("Não consegui executar cadastro de emails no BD");
					}
				}
			}
			if (isset($_POST['telefones'])) {
				$vetTelefones=$_POST['telefones']; // 1 ou + telefones no vetor

				$sqlTelefones=" insert into pessoaTelefone (CPFPessoa, telefonePessoa) values (?,?) ";
				$stmtTelefones=mysqli_prepare($BDconn,$sqlTelefones);
				if (!$stmtTelefones) {
					die("Não consegui preparar o cadastro de telefones no BD");
				}
				$umTelefone="";
				$paramTelefone=mysqli_stmt_bind_param($stmtTelefones, "ss", $CPFPessoa, $umTelefone);
				if (!$paramTelefone) {
					die("Não consegui vincular parâmetro de telefones no cadastro do BD");
				}
				foreach ($vetTelefones as $key => $value) {
					$umTelefone=$value;
					$execTelefone=mysqli_stmt_execute($stmtTelefones);
					if (!$execTelefone) {
						die("Não consegui executar cadastro de telefones no BD");
					}
				}
			}
			if (isset($_POST['bairro']) && isset($_POST['rua']) && isset($_POST['cidade']) && isset($_POST['uf']) && isset($_POST['cep']) && isset($_POST['numero'])) {
				$vetBairro = $_POST['bairro'];
				$vetRua = $_POST['rua'];
				$vetCidade = $_POST['cidade'];
				$vetUf = $_POST['uf'];
				$vetCep = $_POST['cep'];
				$vetNumero = $_POST['numero'];

				$sqlEnderecos = " insert into pessoaEndereco (CPFPessoa, enderecoBairroPessoa, enderecoRuaPessoa, enderecoNumeroPessoa, enderecoCidadePessoa, enderecoEstadoPessoa, enderecoCEPPessoa) values (?,?,?,?,?,?,?) ";
				$stmtEnderecos = mysqli_prepare($BDconn, $sqlEnderecos);
				
				if (!$stmtEnderecos) {
					die("Não consegui preparar o cadastro de endereços no BD");
				}

				$umBairro = "";
				$umaRua = "";
				$umaNumero = "";
				$umaCidade = "";
				$umaUF = "";
				$umaCEP = "";

				$paramEndereco = mysqli_stmt_bind_param($stmtEnderecos, "sssssss", $CPFPessoa, $umBairro, $umaRua, $umaNumero, $umaCidade, $umaUF, $umaCEP);
				
				if (!$paramEndereco) {
					die("Não consegui vincular parâmetro de endereços no cadastro do BD");
				}

				foreach ($vetBairro as $key => $value) {
					$umBairro = $value;
					$umaNumero = isset($vetNumero[$key]) ? $vetNumero[$key] : '';
					$umaRua     = isset($vetRua[$key]) ? $vetRua[$key] : '';
					$umaCidade  = isset($vetCidade[$key]) ? $vetCidade[$key] : '';
					$umaUF      = isset($vetUf[$key]) ? $vetUf[$key] : '';
					$umaCEP     = isset($vetCep[$key]) ? $vetCep[$key] : '';
					
					$execEndereco = mysqli_stmt_execute($stmtEnderecos);
					if (!$execEndereco) {
						die("Não consegui executar cadastro de endereços no BD");
					}
				}
			}
			echo('Cadastros efetuados com sucesso!<br>');
			echo('<a href="menu.php">Voltar ao menu</a><br>');
			echo('<a href="sair.php">Sair</a>');
			

		?>
    </body>
</html>