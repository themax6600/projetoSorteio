<?php
session_start();
include_once('../templates/header.php');

$sql = "SELECT * FROM usersorteados";
$select = $conexao->prepare($sql);


if ($select->execute()) {
    $usersorteados = $select->fetchAll(PDO::FETCH_ASSOC);
}

?>


<main class="d-flex align-items-center">
    <div class="principal container bg-secondary rounded-4 d-flex bg-opacity-50 p-3">
        <div class="col d-flex ms-4 mt-5">
            <div class="d-flex mb-5 w-100 justify-content-start informacoes flex-column">
                <div class="w-25">
                            <a href="<?= BASE_URL ?>assets/pages/main.php"><img src="../img/seta.png" alt="" class="w-25 position-static"></a>
                </div>
                <div class="d-flex w-100 justify-content-center">
                    <?php if ($_POST['imgUser'] == "") { ?>
                        <img src="<?= BASE_URL ?>assets/img/user.png" class="img-user rounded-circle p-1" alt="">
                    <?php } else { ?>
                        <img src="<?= BASE_URL ?>assets/php/<?= $_POST['imgUser'] ?>" class="img-user rounded-circle p-1" alt="">
                    <?php }; ?>
                </div>
                <div class="d-flex w-100 justify-content-center">
                    <div class="d-flex bg-white w-25 h-50 rounded-2 justify-content-center align-items-center mt-2 mb-5"><?php echo $_POST['userName'] ?></div>
                </div>
                <div class="d-flex flex-row">
                <div class="esquerda d-flex mb-5 w-100 justify-content-start informacoes flex-column">
                    <h4>Email:</h4>
                    <div class="d-flex w-100 ">
                        <div class="d-flex bg-white w-75 h-75 rounded-1 mt-1 ps-2 mb-4 align-items-center"><?php echo $_POST['userEmail'] ?></div>
                    </div>
                    <h4>CPF:</h4>
                    <div class="d-flex w-100 ">
                        <div class="d-flex bg-white w-75 h-75 rounded-1 mt-1 ps-2 mb-4 align-items-center"><?php echo $_POST['userCpf'] ?></div>
                    </div>
                </div>
                <div class="direita d-flex mb-5 w-100 justify-content-center align-items-center informacoes flex-column">
                    <form class="direita d-flex mb-5 w-25 justify-content-center align-items-center informacoes flex-column" action="<?= BASE_URL ?>assets/php/deletaruser.php" method="POST">
                        <input hidden type="text" name="userId" value="<?= $_POST['userId'] ?>">
                        <button class="bg-danger w-100 d-flex align-items-center btn btn-danger" type="submit"><p class=" fw-bold">Deletar a conta</p></button>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <?php
        include_once('../templates/footer.php');
        ?>
</main>