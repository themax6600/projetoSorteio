<?php
session_start();
$mensagem = $_SESSION['mensagem'] ?? NULL;

include_once('../data/config.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["imgPost"]) && !empty($_FILES["imgPost"]["name"])) {
        $allowedTypes = ["image/png", "image/jpeg"];
        $fileType = mime_content_type($_FILES["imgPost"]["tmp_name"]);
        $ext = strtolower(pathinfo($_FILES["imgPost"]["name"], PATHINFO_EXTENSION));

        if (in_array($fileType, $allowedTypes) && ($ext == "jpg" || $ext == "jpeg" || $ext == "png")) {
            $nameFile = pathinfo($_FILES["imgPost"]["name"], PATHINFO_FILENAME);
            $imagem_url = hash("md5", $nameFile) . "." . $ext;
            $dir = "../img/";
            move_uploaded_file($_FILES["imgPost"]["tmp_name"], $dir . $imagem_url);
        } else {
            $_SESSION['mensagem'] =  "Erro: Apenas arquivos JPG ou PNG são permitidos.";
            header("Location: " . BASE_URL . "assets/pages/user.php");
            exit;
        }
    } else {

        $imagem_url = "";
    }

    try {
        $sql = "UPDATE userinfos SET imagem_url=:imagem_url WHERE userId=:userId";
        $insert = $conexao->prepare($sql);
        $insert->bindParam(":imagem_url", $imagem_url);

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
