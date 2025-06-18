<?php
session_start();
include_once('../templates/header.php');

$sql = "SELECT * FROM usersorteados";
$select = $conexao->prepare($sql);


if ($select->execute()) {
    $usersorteados = $select->fetchAll(PDO::FETCH_ASSOC);
}

?>

<main>
    <div class="container">
        <div class="col d-flex flex-row text-center mt-4 w-75">
            <a href="<?= BASE_URL ?>assets/pages/main.php"><img src="../img/seta.png" alt="" class="w-25"></a>
            <h4 class="w-100 d-flex justify-content-center align-items-center">Sortear Alunos</h4>
        </div>
        <div class="col d-flex justify-content-around mt-4">
            <div class="row">
                <div class="container">
                    <h4>Alunos Sorteados:</h4>
                    <?php foreach ($usersorteados as $usersorteado) { ?>
                        <div class="card border border-dark border-2 bg-warning d-flex flex-row align-items-center justify-content-between m-2 p-2">
                            <div class="px-2">
                                <div class="container d-flex align-items-center">
                                    <?php if ($usersorteado['imgUser'] == "") { ?>
                                        <img src="<?= BASE_URL ?>assets/img/user.png" class="img-user rounded-circle p-1" alt="">
                                    <?php } else { ?>
                                        <img src="<?= BASE_URL ?>assets/php/<?= $usersorteado['imgUser'] ?>" class="img-user rounded-circle p-1" alt="">
                                    <?php }; ?>
                                    <h5 class="fw-bold ps-1"><?= $usersorteado['userName'] ?> <?= $usersorteado['userSobrenome'] ?></h5>
                                </div>
                                <div class="container">
                                    <h6><?= $usersorteado['userEmail']; ?></h6>
                                </div>
                            </div>
                            <form action="<?= BASE_URL ?>assets/pages/info.php" method="POST">
                                <input hidden type="text" name="userName" value="<?= $usersorteado['userName'] ?>">
                                <input hidden type="text" name="userEmail" value="<?= $usersorteado['userEmail'] ?>">
                                <input hidden type="text" name="userCpf" value="<?= $usersorteado['userCpf'] ?>">
                                <input hidden type="text" name="imgUser" value="<?= $usersorteado['imgUser'] ?>">
                                <input hidden type="text" name="userId" value="<?= $usersorteado['userId'] ?>">
                                <button href="<?= BASE_URL ?>assets/pages/info.php" class="border-0 rounded-4 text-black fw-bold p-2" type="submit">Informações</button>
                            </form>
                        </div>
                    <?php }; ?>
                </div>
            </div>
            <div class="row d-flex">
                <div class="container">
                    <?php if (isset($mensagem)) { ?>
                        <p class="alert alert-danger mt-2"><?= $mensagem ?></p>
                    <?php }; ?>
                    <form method="post" action="<?= BASE_URL ?>assets/php/sortear.php" class="w-100 p-2">
                        <input type="number" placeholder="Numero de pessoas para sortear" name="numPessoa" class="w-100 p-2 rounded-2 mb-2">
                        <button type="submit" name="meuBotao" class="sorteio btn btn-primary fs-2 w-100 border-0 text-dark fw-bold">Sortear </button>
                    </form>
                    <form method="post" action="#" class="w-100 p-2">
                        <button class="result btn btn-primary fs-2 w-100 fw-bold">Lançar resultados</button>
                    </form>
                    <form action="<?= BASE_URL ?>assets/php/limparSorteados.php" class="d-flex align-items-center justify-content-center p-2">
                        <button class="btn btn-danger bg-danger w-175" type="submit">Limpar o sorteio</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once('../templates/footer.php');
?>