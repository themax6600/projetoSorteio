<?php
session_start();
include_once('../templates/header.php');
?>

<main class="img-fundo">
    <div class="container d-flex justify-content-center align-items-center flex-column pt-5">
        <?php if (isset($mensagem)) { ?>
            <p class="alert alert-danger mt-2"><?= $mensagem ?></p>
        <?php }; ?>
        <h5>Numero de participantes:</h5>
        <h2 class="numParticipantes w-25 rounded-4 text-center fs-1 mt-2">1500</h2>
        <?php if ($adm == 1) { ?>
            <a href="<?= BASE_URL ?>assets/pages/sortearAlunoAdm.php" class="btn btn-primary fs-4 p-3 border-0 rounded-4 mt-4">Sortear Aluno</a>
            <a href="<?= BASE_URL ?>assets/pages/listaAdm.php" class="btn btn-primary fs-4 p-3 border-0 rounded-4 mt-4">Ver Lista de Alunos</a>
        <?php }else if ($adm == 0){ ?>
            <a href="<?= BASE_URL ?>assets/pages/sorteio.php" class="btn btn-primary fs-4 p-3 border-0 rounded-4 mt-4">Clique para revelar o resultado</a>
            <?php };?>
    </div>
</main>

<?php 
include_once('../templates/footer.php');
?>