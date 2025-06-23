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
            $_SESSION['tipoMensagem'] = "danger";
            header("location:" .BASE_URL. "assets/pages/info.php");
        } else {
            $_SESSION['mensagem'] = "Usuario deletado";
            $_SESSION['tipoMensagem'] = "success";
            header("location:" .BASE_URL. "assets/pages/sortearalunoAdm.php");
        }
    } finally {
        //desconecta o banco de dados
        unset($conexao);
    }
}