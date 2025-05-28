<?php

$mensagem = $_SESSION['mensagem'] ?? NULL;

$_SESSION['mensagem'] = NULL;

include_once('../data/config.php');

$logado = $_SESSION['logado'] ?? NULL;
$nomeUser = $_SESSION['userName'] ?? NULL;
$IdUser = $_SESSION['userId'] ?? NULL;
$adm = $_SESSION['adm'];
$login = NULL;

$sql = "SELECT * FROM userinfos";
$select = $conexao->prepare($sql);


if ($select->execute()) {
    $userinfos = $select->fetchAll(PDO::FETCH_ASSOC);
}

// Verifica se esta logado
if (!$logado) {
    header("Location: " . BASE_URL . "assets/pages/entrar.php");
    exit;
}

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

<body>
    <header>
        <div class="container d-flex flex-row">
            <div class="col d-flex align-items-center">
                <div class="container d-flex align-items-center">
                    <a href="<?= BASE_URL ?>assets/pages/main.php" class="bg-transparent">
                        <img src="<?= BASE_URL ?>assets/img/sesc1.png" alt="">
                    </a>
                    <a href="<?= BASE_URL ?>assets/pages/main.php" class="bg-transparent">
                        <img src="<?= BASE_URL ?>assets/img/senac1.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-user bg-light rounded-5 d-flex align-items-center">
                <a href="<?= BASE_URL ?>assets/pages/user.php" class="w-25">
                    <img src="<?= BASE_URL ?>assets/img/user.png" class="rounded-circle w-75" alt="">
                </a>
                <h5 class="ms-2">
                    <?php echo $nomeUser ?>
                </h5>
            </div>
        </div>
    </header>