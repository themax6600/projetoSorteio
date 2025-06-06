<?php

$mensagem = $_SESSION['mensagem'] ?? NULL;

$_SESSION['mensagem'] = NULL;

include_once('../data/config.php');

$logado = $_SESSION['logado'] ?? NULL;
$nomeUser = $_SESSION['userName'] ?? NULL;
$IdUser = $_SESSION['userId'] ?? NULL;
$userEmail = $_SESSION['userEmail'];
$adm = $_SESSION['adm'];
$passou = $_SESSION['passou'];

$sql = "SELECT * FROM userinfos";
$select = $conexao->prepare($sql);


if ($select->execute()) {
    $userinfos = $select->fetchAll(PDO::FETCH_ASSOC);
}




if (!$logado) {
    header("Location: " . BASE_URL . "assets/pages/entrar.php");
    exit;
}



try {
    // Consulta para buscar o caminho da imagem de perfil
    $sql = "SELECT imgUser FROM userinfos WHERE userId = :userId";
    $select = $conexao->prepare($sql);
    $select->bindParam(':userId', $IdUser);
    $select->execute();

    // Verifica se encontrou o usuário
    if ($select->rowCount() > 0) {
        $dados = $select->fetch(PDO::FETCH_ASSOC);
        $imgUser = $dados['imgUser'];
    } else {
        echo "Usuário não encontrado.";
    }
} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
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
        <nav class="navbar navbar-expand-lg w-100 d-flex justify-content-between">
            <div class="container">
                <a class="navbar-brand d-flex justify-content-center align-items-center rounded-5 ps-3"
                    href="<?= BASE_URL ?>assets/pages/main.php">
                    <img src="<?= BASE_URL ?>assets/img/sesc1.png" alt="">
                    <img src="<?= BASE_URL ?>assets/img/senac1.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end d-flex align-items-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-body bg-light rounded-4 d-flex align-items-center w-25">
                        <a href="<?= BASE_URL ?>assets/pages/user.php" class="w-100">
                            <?php if ($imgUser == "") { ?>
                                <img src="<?= BASE_URL ?>assets/img/user.png" class="img-user rounded-circle p-1" alt="">
                                
                            <?php } else { ?>
                                <img src="<?= BASE_URL ?>assets/php/<?= $imgUser ?>" class="img-user rounded-circle p-1" alt="">
                            <?php }; ?>
                        </a>
                        <h5 class="w-100 h-100">
                            <?php echo $nomeUser ?>
                        </h5>
                    </div>
                </div>
            </div>
        </nav>
    </header>