<?php
session_start();

include_once('../data/config.php');
include_once('../templates/header.php');

?>

<main class="d-flex align-items-center">
    <div class="principal container bg-secondary rounded-4 d-flex bg-opacity-50 p-3">
        <div class="col d-flex ms-4 mt-5">
            <form action="<?= BASE_URL ?>assets/php/atualizarSenha.php" method="POST" class="w-100">
                <div class="d-flex mb-5 w-100 justify-content-start informacoes">
                    <button type="button" class="img_user bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <?php if ($imgUser == "") { ?>
                            <img src="<?= BASE_URL ?>assets/img/user.png" class="img-user rounded-circle p-1" alt="">

                        <?php } else { ?>
                            <img src="<?= BASE_URL ?>assets/php/<?= $imgUser ?>" class="img-user rounded-circle p-1" alt="">
                        <?php }; ?>
                    </button>
                    <div class="d-flex flex-column justify-content-center align-items-center ms-5">
                        <h4><?php echo $nomeUser ?></h4>
                        <h4><?php echo $userEmail ?></h4>
                    </div>
                </div>
                <label for="usuario" class="form-label">Nome</label>
                <input type="text" name="nomeAtualizado" id="userName
                " placeholder="<?= $_SESSION['userName'] ?>" class="w-75 form-control mb-2">
                <label for="current-password" class="form-label">
                    <h4>Senha</h4>
                </label>
                <input type="password" name="userPassword" id="current-password" placeholder="********" name="userSobrenome" class="w-75 form-control mb-2" required>
                <label for="novaSenha" class="form-label">
                    <h4>Confirmar Senha</h4>
                </label>
                <input type="text" name="novaSenha" id="novaSenha" placeholder="********" name="userSobrenome" class="w-75 form-control mb-2">
                <div class="botao col mt-3 w-75 d-flex justify-content-around">
                    <button type="submit" class="button_user btn btn-warning bg-warning w-30"> Confirmar </button>
                    <a class="sair-botao btn btn-danger bg-danger w-50" href="../php/logout.php"> Sair</a>
                </div>
                <?php if (isset($mensagem)) { ?>
                    <p class="alert alert-danger mt-2"><?= $mensagem ?></p>
                <?php }; ?>
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
            <img src="<?= BASE_URL ?>assets/img/ensinoMedioPronto.png" class="imagem_user rounded-4 w-100 h-100" alt="">
        </div>
    </div>
    <?php
    include_once('../templates/footer.php');
    ?>
</main>