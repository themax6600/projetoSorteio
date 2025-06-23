<?php
session_start();
$_SESSION['mensagem'] = null;

include_once("../data/config.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS);
    $novaSenha = filter_input(INPUT_POST, 'novaSenha', FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmaSenha = filter_input(INPUT_POST, 'confirmaSenha', FILTER_SANITIZE_SPECIAL_CHARS);
    $IdUser = $_SESSION['userId'];

    if(!$userName & !$novaSenha & !$confirmaSenha){
        $_SESSION['mensagem'] = "Preencha os campos!";
        $_SESSION['tipoMensagem'] = "danger";
        header("Location: " . BASE_URL . "assets/pages/user.php");
        exit;
    }

    if ($novaSenha !== $confirmaSenha) {
        $_SESSION['mensagem'] = "As senhas tem que ser iguais.";
        $_SESSION['tipoMensagem'] = "danger";
        header("Location: " . BASE_URL . "assets/pages/user.php");
        exit;
    }

    $novaSenhaCrip = password_hash($novaSenha, PASSWORD_DEFAULT);

    if($novaSenha == null){
        $sql = "UPDATE userinfos SET userName = :userName WHERE userId = :IdUser";
        $update = $conexao->prepare($sql);
        $update->bindParam(":userName", $userName);
        $update->bindParam(":IdUser", $IdUser, PDO::PARAM_INT);

        if ($update->execute()) {
            $_SESSION['mensagem'] = "Perfil atualizado com sucesso.";
            $_SESSION['tipoMensagem'] = "success";
            header("Location: " . BASE_URL . "assets/pages/user.php");
            exit;
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar perfil.";
            $_SESSION['tipoMensagem'] = "danger";
        }
    } elseif ($userName == null){
        $sql = "UPDATE userinfos SET userPassword = :novaSenha WHERE userId = :IdUser";
        $update = $conexao->prepare($sql);
        $update->bindParam(":novaSenha", $novaSenhaCrip);
        $update->bindParam(":IdUser", $IdUser, PDO::PARAM_INT);

        if ($update->execute()) {
            $_SESSION['mensagem'] = "Perfil atualizado com sucesso.";
            $_SESSION['tipoMensagem'] = "success";
            header("Location: " . BASE_URL . "assets/pages/user.php");
            exit;
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar perfil.";
            $_SESSION['tipoMensagem'] = "danger";
        }
    }

    try {
        $sql = "UPDATE userinfos SET userName = :userName, userPassword = :novaSenha  WHERE userId = :IdUser";
        $update = $conexao->prepare($sql);
        $update->bindParam(":userName", $userName);
        $update->bindParam(":novaSenha", $novaSenhaCrip);
        $update->bindParam(":IdUser", $IdUser, PDO::PARAM_INT);

        if ($update->execute()) {
            $_SESSION['mensagem'] = "Perfil atualizado com sucesso.";
            $_SESSION['tipoMensagem'] = "success";
            header("Location: " . BASE_URL . "assets/pages/user.php");
            exit;
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar perfil.";
            $_SESSION['tipoMensagem'] = "danger";
        }
    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Ocorreu um erro ao atualizar: " . $e->getMessage();
    } finally {
        unset($conexao);
        header("Location: " . BASE_URL . "assets/pages/user.php");
        exit;
    }
}
