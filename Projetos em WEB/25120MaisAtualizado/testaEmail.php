
<?php
require("email.php");
$nomeDestinatario="Heitor Skrepnek lima soares";
$To="heitorlima797@gmail.com";
$subject="teste para envio de senha";
$Message="eai<br>sua senha nova é 12345";
if(!mandarEmail($nomeDestinatario,$To,$subject,$Message)){
    echo("Deu Ruim");
}
?>