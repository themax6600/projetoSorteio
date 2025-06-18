<?php 

session_start();
$_SESSION['mensagem']=NULL;


include_once("../data/config.php");

if ($_SERVER['REQUEST_METHOD']==="POST"){
    $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);
try{
        $sql = "DELETE FROM userinfos WHERE userId = $userId";
        $delete = $conexao->prepare($sql);
        $delete->execute();
        $sql = "DELETE FROM usersorteados WHERE userId = $userId";
        $delete = $conexao->prepare($sql);
        $delete->execute();
        if (!$delete) {
            $_SESSION['mensagem'] = "Erro ao deletar usuario";
            header("location:" .BASE_URL. "assets/pages/info.php");
        } else {
            $_SESSION['mensagem'] = "Usuario deletado";
            header("location:" .BASE_URL. "assets/pages/sortearalunoAdm.php");
        }
    } finally {
        //desconecta o banco de dados
        unset($conexao);
    }
}