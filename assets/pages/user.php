<?php
session_start();

include_once('../data/config.php');
include_once('../templates/header.php');


?>
<main class="d-flex align-items-center">
    <div class="principal container bg-secondary rounded-4 d-flex bg-opacity-50 p-3">
        <div class="col d-flex ms-4 mt-5">
            <div class="w-25">
                <a href="<?= BASE_URL ?>assets/pages/main.php"><img src="../img/seta.png" alt="" class="w-50 setinha"></a>
            </div>
            <form action="<?= BASE_URL ?>assets/php/atualizarPerfilTESTE.php" method="POST" class="w-100">
                <?php if (isset($mensagem)) { ?>
                    <p class="alert alert-<?=$tipoMensagem?> mt-2"><?= $mensagem ?></p>
                <?php }; ?>
                <div class="d-flex mb-5 w-100 justify-content-start informacoes <?php if ($adm == 1) { ?> flex-column <?php } ?>">
                    <?php if ($adm == 1) { ?>
                        <div class="d-flex justify-content-center align-items-center w-100 h-25 mb-2">
                            <h4 class="bg-warning rounded-4 p-1 fw-bold">Conta de adm</h4>
                        </div>
                    <?php }; ?>
                    <div class="d-flex flex-row">
                        <button type="button" class="img_user bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <?php if ($imgUser == "") { ?>
                                <img src="<?= BASE_URL ?>assets/img/user.png" class="img-user rounded-circle p-1" alt="">
                            <?php } else { ?>
                                <img src="<?= BASE_URL ?>assets/php/<?= $imgUser ?>" class="img-user rounded-circle p-1" alt="">
                            <?php }; ?>
                        </button>

                        <div class="d-flex flex-column justify-content-center ms-5">
                            <h4><?php echo $nomeUser ?></h4>
                            <h4><?php echo $userEmail ?></h4>
                        </div>
                    </div>
                </div>
                <form action="<?= BASE_URL ?>assets/php/atualizarPerfilTESTE.php" method="POST">
                    <h4>Nome</h4>
                    <input type="text" name="userName" id="newName" class="w-75 form-control mb-2">
                    <h4>Senha</h4>
                    <input type="password" name="novaSenha" id="senha" placeholder="********" class="w-75 form-control mb-2">
                    <h4>Confirmar Senha</h4>
                    <input type="password" name="confirmaSenha" id="senhaNova" placeholder="********" class="w-75 form-control mb-2">
                    <div class="botao col mt-3 w-75 d-flex justify-content-around">
                        <button type="submit" class="button_user btn btn-warning bg-warning w-30"> Confirmar </button>
                        <a class="sair-botao btn btn-danger bg-danger w-50" href="../php/logout.php"> Sair</a>
                </form>
        </div>
        </form>
        <form action="<?= BASE_URL ?>assets/php/addFoto.php" method="POST" enctype="multipart/form-data">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Atualizar Imagem de perfil</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex flex-column align-items-center">
                            <?php if ($imgUser == "") { ?>
                                <img src="<?= BASE_URL ?>assets/img/user.png" class="img-user rounded-circle p-1" alt="">
                            <?php } else { ?>
                                <img src="<?= BASE_URL ?>assets/php/<?= $imgUser ?>" class="img-user rounded-circle p-1" alt="">
                            <?php }; ?>
                            <input type="hidden" name="IdUser" value="<?php echo $IdUser = $_SESSION['userId'] ?? NULL;; ?>">
                            <input type="file" name="imagem_perfil" />
                            <input type="submit" value="Upload" class="btn text-white mt-3 w-100" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col imagem_user">
        <img src="<?= BASE_URL ?>assets/img/ensinoMedioPronto.png" class="rounded-4 w-100 h-100" alt="">
    </div>
    </div>
</main>
<?php
include_once('../templates/footer.php');
?>