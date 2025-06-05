<?php
session_start();
$mensagem = $_SESSION['mensagem'] ?? NULL;

include_once('../data/config.php');

$IdUser = filter_input(INPUT_POST, 'IdUser', FILTER_SANITIZE_SPECIAL_CHARS);

if ($_FILES["imagem_perfil"]["error"] == 0) {
    $caminho_destino = "imgUser/" . basename($_FILES["imagem_perfil"]["name"]);
    if (move_uploaded_file($_FILES["imagem_perfil"]["tmp_name"], $caminho_destino)) {

        $sql = "UPDATE userinfos SET imgUser=:imgUser WHERE userId=$IdUser";
        $update = $conexao->prepare($sql);
        $update->bindParam(":imgUser", $caminho_destino);

        if ($update->execute()) {
            $_SESSION['mensagem'] = "Foto de perfil atualizada.";
            header("Location:" . BASE_URL . "assets/pages/user.php");
            exit;
        } else {
            throw new Exception("Erro ao atualizar");
        }
    } else {
        echo "Problemas ao mover o arquivo.";
    }
} else {
    echo "Erro no upload: " . $_FILES["imagem_perfil"]["error"];
}
