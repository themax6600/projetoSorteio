<?php
session_start();

include_once('../data/config.php');
include_once('../templates/header.php');
?>

<main>
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
        <div class="bg-warning d-flex flex-column justify-content-center rounded-4">
            <?php if ($passou == 1) { ?>
                <h1 class="text-center mt-5 m-5">VOCÊ FOI SORTEADO EBA PARABÉNS </h1>
            <?php } else if ($passou == 0) { ?>
                <h1 class="text-center mt-5 m-5">NÃO FOI DESSA VEZ, QUE PENA <?php echo $nomeUser ?></h1>
            <?php } else { ?>
                <h1 class="text-center mt-5 m-5">SORTEIO NÃO REALIZADO AINDA <?php echo $nomeUser ?></h1>
            <?php }; ?>
            <a href="../pages/main.php" class="btn btn-primary fs-4 p-3 border-0 rounded-4 mt-4 m-5">VOLTAR PARA A TELA INICIAL</a>
        </div>
        <?php if ($passou == 1) { ?>
        <div class="d-flex justify-content-evenly">
            <img src="../img/sorteadoE.png" alt="imagem de fogos de artifício">
            <img src="../img/sorteado.png" alt="imagem de fogos de artifício">
        </div>
        <?php } else {{}} ?>
    </div>
</main>

<?php
include_once('../templates/footer.php');
?>