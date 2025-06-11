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
                        <div class="card border border-dark border-2 bg-success d-flex flex-row align-items-center justify-content-between m-2 p-2">
                            <div class="px-2">
                                <div class="container d-flex align-items-center">
                                    <img src="<?= BASE_URL ?>assets/img/<?= $usersorteado['imgUser'] ?>" class="img-user rounded-circle" alt="">
                                    <h5 class="fw-bold text-light ps-1"><?= $usersorteado['userName'] ?> <?= $usersorteado['userSobrenome'] ?></h5>
                                </div>
                                <div class="container">
                                    <h6 class="text-light"><?= $usersorteado['userEmail']; ?></h6>
                                </div>
                            </div>
                            <form action="<?= BASE_URL ?>assets/pages/info.php" method="POST">
                                <input hidden type="text" name="userName" value="<?= $usersorteado['userName'] ?>">
                                <input hidden type="text" name="userEmail" value="<?= $usersorteado['userEmail'] ?>">
                                <input hidden type="text" name="userCpf" value="<?= $usersorteado['userCpf'] ?>">
                                <input hidden type="text" name="imgUser" value="<?= $usersorteado['imgUser'] ?>">
                            <button href="<?= BASE_URL ?>assets/pages/info.php" class="border-0 rounded-4 text-black fw-bold p-2" type="submit">Informações</button>
                            </form>
                        </div>
                    <?php }; ?>
                </div>
            </div>
            <div class="row d-flex align-items-center">
                <form method="post" action="<?= BASE_URL ?>assets/php/sortear.php" class="w-100">
                    <button type="submit" name="meuBotao" class="sorteio btn btn-primary fs-2 w-100 border-0 text-dark fw-bold">Sortear </button>
                </form>
                <a href="#" class="result btn btn-primary fs-2 w-100 fw-bold">Lançar resultados</a>
                <?php if (isset($mensagem)) { ?>
                    <p class="alert alert-danger mt-2"><?= $mensagem?></p>
                <?php }; ?>
            </div>
        </div>
    </div>
</main>

<?php
include_once('../templates/footer.php');
?>