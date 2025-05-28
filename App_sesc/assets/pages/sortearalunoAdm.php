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
        <div class="col">
            <div class="row"></div>
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