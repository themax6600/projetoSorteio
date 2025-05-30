<?php
session_start();

include_once('../data/config.php');
include_once('../templates/header.php');
?>

<main class="d-flex align-items-center">
    <div class="container bg-secondary rounded-4 d-flex flex-row bg-opacity-50 w-100 p-3">
        <div class="col d-flex ms-4 mt-5">
            <form action="#" method="POST" class="w-100">
                <div class="d-flex mb-5 w-100 justify-content-start">
                    <img src="<?= BASE_URL ?>assets/img/user.png" class="rounded-circle" alt="">
                    <div class="d-flex flex-column justify-content-center align-items-center ms-5">
                        <h4><?php echo $nomeUser ?></h4>
                    </div>
                </div>
                <h4>Nome</h4>
                <input type="text" placeholder="*****@***.***" name="userSobrenome" class="w-75">
                <h4>Senha</h4>
                <input type="text" placeholder="********" name="userSobrenome" class="w-75">
                <h4>Confirmar Senha</h4>
                <input type="text" placeholder="********" name="userSobrenome" class="w-75">
                <div class="col mt-3 w-75 d-flex justify-content-around">
                    <?php if ($adm == 1) { ?>
                        <button class=" bg-warning ms-3"> Adicionar ADM </button>
                    <?php } else if ($adm == 0) { ?>
                    <?php }; ?>
                    <button class="btn btn-warning bg-warning w-25"> Confirmar </button>
                    <button class="btn btn-danger bg-danger w-25"> Sair</button>
                </div>
            </form>
        </div>
        <div class="col">
            <img src="<?= BASE_URL ?>assets/img/edificiosesc.png" class="rounded-4 w-100 h-100" alt="">
        </div>
    </div>
    <?php
    include_once('../templates/footer.php');
    ?>
</main>