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
                    <button type="button" class="bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="<?= BASE_URL ?>assets/img/user.png" class="rounded-circle" alt="">
                    </button>
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

            <form action="<?= BASE_URL ?>assets/php/addFoto.php" method="POST">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="file" name="imgPost" class="form-control" accept="image/png, image/jpeg">
                                <button type="submit" class="btn btn-primary rounded-4 border-0 mt-2 w-75">Continuar</button>
                            </div>
                        </div>
                    </div>
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