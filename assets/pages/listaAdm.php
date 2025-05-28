<?php
session_start();
include_once('../templates/header.php');
?>

<main>
    <div class="container">
        <div class="col d-flex flex-row text-center mt-4">
            <a href="<?= BASE_URL?>assets/pages/main.php"><img src="../img/seta.png" alt=""></a>
            <h4 class="w-100 d-flex justify-content-center align-items-center">Lista de Alunos</h4>
        </div>
        <div class="col">
            <div class="card-group mt-4 ">
                <?php foreach($userinfos as $userinfo) {?>
                    <?php if($userinfo['adm'] == 1) {?>
                <div class="container ps-2 mb-3">
                    <div class="row">
                        <div class="col border border-dark border-2">
                            <?= $userinfo['userName']; ?>
                        </div>
                        <div class="col border border-dark border-2">
                            Email: <?= $userinfo['userEmail']; ?>
                        </div>
                        <div class="col border border-dark border-2">
                            CPF: <?= $userinfo['userCpf']; ?>
                        </div>
                        <div class="col border border-dark border-2">
                            Idade: <?= $userinfo['userName']; ?>
                        </div>
                    </div>
                </div>
                    <?php };?>
                <?php };?>
            </div>
        </div>
    </div>
</main>

<?php
include_once('../templates/footer.php');
?>