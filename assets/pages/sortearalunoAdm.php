<?php
session_start();
include_once('../templates/header.php');


$sql = "SELECT * FROM userinfos ORDER BY RAND() LIMIT 1";
$select = $conexao->prepare($sql);


if ($select->execute()) {
    $sorteio = $select->fetchAll(PDO::FETCH_ASSOC);
}

function minhaFuncao() {

};

if (isset($_POST['meuBotao'])) {
    minhaFuncao();
};
?>

<main>
    <div class="container">
        <div class="col d-flex flex-row text-center mt-4">
            <a href="<?= BASE_URL ?>assets/pages/main.php"><img src="../img/seta.png" alt=""></a>
            <h4 class="w-100 d-flex justify-content-center align-items-center">Sortear Alunos</h4>
        </div>
        <div class="col d-flex flex-row justify-content-around">
            <div class="row">
                <div class="container">
                    <h4>Alunos Sorteados:</h4>
                    <?php foreach ($userinfos as $userinfo) { ?>
                        <?php if ($userinfo['adm'] == 1) { ?>
                            <div class="card border border-dark border-2 bg-success p-2 d-flex flex-row">
                                <img src="<?= BASE_URL ?>assets/img/user.png" class="rounded-circle" alt="">
                                <?= $userinfo['userName']; ?>

                            </div>
                        <?php }; ?>
                    <?php }; ?>
                </div>
            </div>
            <div class="row d-flex align-items-center">
                <form method="post">
                    <button type="submit" name="meuBotao">Sortear</button>
                </form>
                <a href="#" class="result btn btn-primary fs-1">Lançar resultados</a>
            </div>
        </div>
    </div>
</main>

<?php
include_once('../templates/footer.php');
?>