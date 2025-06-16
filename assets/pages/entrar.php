<?php
session_start();

include_once('../data/config.php');

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
    <main class="d-flex align-items-center">
        <div class="container bg-white rounded-4 p-3 h-50  ">
            <div class="col d-flex ms-4">
                <form action="<?= BASE_URL ?>assets/php/login.php" method="POST" class="d-flex flex-column justify-content-center w-75 pe-5 ps-5">
                    <h1 class="text-center">ENTRAR</h1>
                    <h4>CPF</h4>
                    <input type="text" placeholder="***.***.***-**" name="userCpf" maxlength="14" id="cpf">
                    <h4>Senha</h4>
                    <input type="password" placeholder="********" name="userPassword">
                    <div class="box d-flex flex-column align-items-center">
                        <button type="submit" class="btn btn-primary rounded-4 border-0 mt-2 w-75">Continuar</button>
                        <a href="./cadastrar.php" class="text-warning">Não tem uma conta? Cadastre-se aqui</a>
                        <?php if (isset($mensagem)) { ?>
                            <p class="alert alert-danger mt-2"><?= $mensagem ?></p>
                        <?php }; ?>
                    </div>
                </form>
            </div>
            <div class="w-100% h-100  d-flex justify-content-center">
                <img src="<?= BASE_URL ?>assets/img/ensinoMedioPronto.png" class="  rounded-4  w-75% h-100 " alt="">
            </div>
        </div>
    </main>
    <script src="<?= BASE_URL ?>assets/js/script.js"></script>
    <script src="<?= BASE_URL ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>