<?php
session_start();
$_SESSION['mensagem'] = NULL;
include_once("../data/config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_SPECIAL_CHARS);
    $userSobrenome = filter_input(INPUT_POST, "userSobrenome", FILTER_SANITIZE_SPECIAL_CHARS);
    $userEmail = filter_input(INPUT_POST, "userEmail", FILTER_SANITIZE_SPECIAL_CHARS);
    $userCpf = filter_input(INPUT_POST, "userCpf", FILTER_SANITIZE_SPECIAL_CHARS);
    $userPassword = filter_input(INPUT_POST, "userPassword", FILTER_SANITIZE_EMAIL);
}

$userCpf = preg_replace('/\D/', '', $userCpf);

if (!$userName || !$userPassword || !$userSobrenome || !$userEmail || !$userCpf) {
    $_SESSION['mensagem'] = "Preencha todos os campos!";
    $_SESSION['tipoMensagem'] = "danger";
    header('Location: ' . BASE_URL . 'assets/pages/cadastrar.php');
    exit;
}

    $sql = "SELECT * FROM userinfos WHERE userEmail = :userEmail";
    $select = $conexao->prepare($sql);
    $select->bindParam(':userEmail', $userEmail);
    $select->execute();
    $login = $select->fetch(PDO::FETCH_ASSOC);

    if ($login) {
        $_SESSION['mensagem'] = "EMAIL JÁ CADASTRADO";
        $_SESSION['tipoMensagem'] = "danger";
        header('Location: ' . BASE_URL . 'assets/pages/cadastrar.php');
        exit;
    }

$senhaCriptografada = password_hash($userPassword, PASSWORD_DEFAULT);

try {
    $sql = "INSERT INTO userinfos (userName, userSobrenome, userEmail, userCpf, userPassword) VALUES (:userName, :userSobrenome, :userEmail, :userCpf, :userPassword)";

    $insert = $conexao->prepare($sql);

    $insert->bindParam(':userName', $userName);
    $insert->bindParam(':userSobrenome', $userSobrenome);
    $insert->bindParam(':userEmail', $userEmail);
    $insert->bindParam(':userCpf', $userCpf);
    $insert->bindParam(':userPassword', $senhaCriptografada);


    if ($insert->execute() && $insert->rowCount() > 0) {
        $_SESSION['mensagem'] = "Cadastro com sucesso!";
        $_SESSION['tipoMensagem'] = "success";
        header('Location: ' . BASE_URL . 'assets/pages/entrar.php');
        exit;
    } else {
        throw new Exception("Ocorreu um probleminha");
    header('Location: ' . BASE_URL . 'assets/pages/cadastrar.php');
    }
} catch (Exception $e) {
    $_SESSION['mensagem'] = "Ocorreu um erro ao cadastrar / Usuário já cadastrado!";
    $_SESSION['tipoMensagem'] = "danger";
    header('Location: ' . BASE_URL . 'assets/pages/cadastrar.php');
    exit;
} finally {
    unset($conexao);
}
