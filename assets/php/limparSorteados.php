<?php 

session_start();
$_SESSION['mensagem']=NULL;



include_once("../data/config.php");
include_once('../templates/header.php');



$sql = "DELETE FROM usersorteados";
        $delete = $conexao->prepare($sql);
        $delete->execute();


    $sql = "UPDATE userinfos SET passou = 0 WHERE passou = 1";
    $update = $conexao->prepare($sql);
    $update->execute();
        header("location:" .BASE_URL. "assets/pages/sortearalunoAdm.php");