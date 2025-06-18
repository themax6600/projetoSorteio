<?php


//inicia as variaveis de sessão
session_start();
$_SESSION['mensagem'] = NULL;

//Estabelece a conexao com o banco de dados
include_once("../data/config.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $userName = filter_input(INPUT_POST, 'nomeAtualizado', FILTER_SANITIZE_SPECIAL_CHARS);

    try {
        $sql = "UPDATE userinfos SET userName=:nomeAtualizado where userId = :IdUser";
        $update = $conexao->prepare($sql);
        $update->bindParam(":nomeAtualizado", $nome);
        

        if ($update->execute()) {

            $_SESSION['mensagem'] = "Perfil atualizado com sucesso";
            header("Location: ../pages/user.php");

            if ($insertNoti->execute()) {
                header("Location: ../pages/user.php");
                exit;
            }
            
        } else {
            throw new Exception("Erro ao atualizar");
            header("Location: ../pages/user.php");
        }
    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Ocorreu um erro ao Atualizar" . $e;
        header("Location: ../pages/user.php");
        exit;
    } finally {
        //desconecta o banco de dados
        unset($conexao);
    }
}
