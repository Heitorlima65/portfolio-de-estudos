<?php
    require("ses_start.php");
    
    // Garante que a sessão está ativa
    if (!isset($_SESSION['CPFPessoa'])) {
        header("Location: tela01.php");
        exit();
    }

    $CPFPessoa = $_SESSION['CPFPessoa'];
    $senhaPessoa = $_POST['senhaPessoa'] ?? '';

    if (empty($senhaPessoa)) {
        die("Preencha a senha para excluir conta. <br><br><a href='exclui01.php'>Voltar</a>");
    }

    require("BDconnecta.php");
    require("cryp2graph2.php");

    // 1. Obter a senha cifrada atual da base de dados
    $sql = "SELECT senhaPessoa FROM pessoa WHERE CPFPessoa = ?";
    $stmt = mysqli_prepare($BDconn, $sql);
    if (!$stmt) {
        die("Não foi possível preparar a consulta no BD: " . mysqli_error($BDconn));
    }
    
    mysqli_stmt_bind_param($stmt, "s", $CPFPessoa);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $senhaHashBD);
    
    if (!mysqli_stmt_fetch($stmt)) {
        mysqli_stmt_close($stmt);
        die("Não foi possível localizar o CPF no banco de dados.");
    }
    mysqli_stmt_close($stmt);

    // 2. Validar a senha inserida com a função de criptografia do sistema
    if (!checasenha($senhaPessoa, $senhaHashBD)) {
        die("Senha incorreta! A exclusão foi cancelada. <br><br><a href='exclui01.php'>Tentar novamente</a>");
    }

    // 3. Eliminar os registos das tabelas dependentes e por fim da tabela principal
    $tabelas = ['pessoaEmail', 'pessoaTelefone', 'pessoaEndereco', 'pessoa'];
    foreach ($tabelas as $tabela) {
        $stmtDel = mysqli_prepare($BDconn, "DELETE FROM $tabela WHERE CPFPessoa = ?");
        if ($stmtDel) {
            mysqli_stmt_bind_param($stmtDel, "s", $CPFPessoa);
            mysqli_stmt_execute($stmtDel);
            mysqli_stmt_close($stmtDel);
        }
    }

    // 4. Destruir a sessão e concluir
    session_destroy();
    echo "Conta eliminada com sucesso!<br><br><a href='tela01.php'>Voltar para o Login</a>";
?>