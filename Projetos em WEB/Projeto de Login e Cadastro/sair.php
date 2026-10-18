<?php
	require("ses_start.php");
	unset($_SESSION['CPFPessoa']);
	unset($_SESSION);
	session_destroy();
	header("Location: menu.php");
?>