<?php
session_start();
$mensagem = $_SESSION['mensagem'] ?? NULL;

include_once('../data/config.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $imagem_usuario = filter_input(INPUT_POST, 'imagem_usuario_cad', FILTER_SANITIZE_SPECIAL_CHARS);

    
    try {
        $sql = "UPDATE userinfos SET imgPost=:imgPost WHERE userId=:userId";
        $insert = $conexao->prepare($sql);
        $insert->bindParam(":imgPost", $imgPost);

        if ($insert->execute()) {
            $_SESSION['mensagem'] = " Post criado com sucesso!";
            header("Location: " . BASE_URL . "assets/pages/user.php");
        } else {
            throw new Exception(" Ocorreu um erro ao cadastrar!");
        }
    } catch (exception $e) {
        $_SESSION['mensagem'] = " Erro " . $e;
        header("Location: " . BASE_URL . "assets/pages/user.php");
    } finally {
        unset($conexao);
    }
}
