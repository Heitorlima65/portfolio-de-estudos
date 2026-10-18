<?php require("ses_start.php"); ?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Excluir Conta</title>
    </head>
    <body>
        <form action="exclui02.php" method="POST">
            <h2>Pretende mesmo excluir a sua conta?</h2>
            <p>Insira a sua senha para confirmar:</p>
            <label for="senhaPessoa">Senha:</label><br>
            <input type="password" name="senhaPessoa" required><br><br>
            <input type="submit" name="btnExcluir" value="Excluir conta">
        </form>
        <br>
        <a href="menu.php">Cancelar e voltar ao menu</a>
    </body>
</html>