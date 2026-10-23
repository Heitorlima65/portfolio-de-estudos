<?php
    require("ses_start.php"); 
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
    </head>
    <body>
        <form action="mudSenha03.php" name="formTroca" method="POST">

            <label for="CPFPessoa">Digite a senha nova:</label><br>
            <input type="password" id="senhaPessoa" name="senhaPessoa" required><br>
            <br>
            <label>confirme a senha nova:</label><br>
            <br>
            <input type="password" name="ConfirmacaoSenhaPessoa" id="ConfirmacaoSenhaPessoa" required><br>
            <input type="submit" name="Enviar" class="enviar" value="Enviar">
        </form>
    </body>
</html>