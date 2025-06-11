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
                <h4>Email:</h4>
                <div class="d-flex w-100 ">
                    <div class="d-flex bg-white w-50 h-75 rounded-1 mt-1 ps-2 mb-4 align-items-center"><?php echo $_POST['userEmail'] ?></div>
                </div>
                <h4>CPF:</h4>
                <div class="d-flex w-100 ">
                    <div class="d-flex bg-white w-50 h-75 rounded-1 mt-1 ps-2 mb-4 align-items-center"><?php echo $_POST['userCpf'] ?></div>
                </div>
            </div>
        </div>
        <?php
        include_once('../templates/footer.php');
        ?>
</main>