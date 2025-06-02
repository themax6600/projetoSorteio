<?php
session_start();
include_once('../templates/header.php');
?>

<main>
    <div class="container">
        <div class="col d-flex flex-row text-center mt-4">
            <a href="<?= BASE_URL ?>assets/pages/main.php"><img src="../img/seta.png" alt=""></a>
            <h4 class="w-100 d-flex justify-content-center align-items-center">Sortear Alunos</h4>
        </div>
        <div class="col d-flex flex-row">
            <div class="row">
                <?php foreach ($userinfos as $userinfo) { ?>
                    <?php if ($userinfo['adm'] == 0) { ?>
                        <div class="container">
                            <div class="col border border-dark border-2 bg-success w-25 d-flex flex-row align-items-center justify-content-between">
                                <img src="<?= BASE_URL?>assets/img/user.png" alt="">
                                <h5 class="p-5"><?= $userinfo['userName']; ?></h5>
                                <a href="#" class="btn btn-warning border-0 h-25">Informações</a>
                            </div>
                        </div>
                    <?php }; ?>
                <?php }; ?>
            </div>
            <div class="row">
                <a href="#" class="btn btn-warning border-0">Sortear</a>
                <a href="#" class="result btn btn-primary">Lançar resultados</a>
            </div>
        </div>
    </div>
</main>

<?php
include_once('../templates/footer.php');
?>