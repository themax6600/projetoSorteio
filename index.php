<?php
session_start();

include_once('./assets/data/config.php');

$mensagem = $_SESSION['mensagem'] ?? NULL;

$_SESSION['mensagem'] = NULL;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesc</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Georama&family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
</head>

<body class="container-fluid">
    <header>
        <div class="container d-flex justify-content-center mt-3">
            <img src="<?= BASE_URL ?>assets/img/sesc1.png" alt="">
            <img src="<?= BASE_URL ?>assets/img/site_senac.png" alt="">
        </div>
    </header>
    <main>
        <div class="container-lg d-flex justify-content-center botaoInicio">
            <a href="<?= BASE_URL ?>assets/pages/entrar.php" class="btn btn-warning p-1 border-0 rounded-3 ms-4 fs-4 w-25 fw-bold text-dark botaoDeEntrada">Logar</a>
            <a href="<?= BASE_URL ?>assets/pages/cadastrar.php" class="btn btn-warning p-1 border-0 rounded-3 ms-4 fs-4 w-25 fw-bold text-dark botaoDeEntrada">Cadastrar</a>
        </div>
        <div class="container-lg d-flex justify-content-center ">
            <a href="<?= BASE_URL ?>assets/pages/entrarAdm.php" class="text-warning bg-transparent">Sou administrador</a>
        </div>
    </main>
    <script src="<?= BASE_URL ?>assets/js/script.js"></script>
    <script src="<?= BASE_URL ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>