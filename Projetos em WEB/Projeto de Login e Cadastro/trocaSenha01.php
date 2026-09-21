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
        <form action="trocaSenha02.php" name="formTroca" method="POST">

            <label for="CPFPessoa">Digite a senha nova:</label><br>
            <input type="password" id="senhaPessoa" name="senhaPessoa" required><br>
            <br>
            <input type="submit" name="Enviar" class="enviar" value="Enviar">
        </form>
    </body>
</html>