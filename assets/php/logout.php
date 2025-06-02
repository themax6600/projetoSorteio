<?php 
$_SESSION['mensagem'] = "Você saiu com sucesso!";
session_start();
session_destroy();
header("Location: ../../index.php");
exit;
?>
