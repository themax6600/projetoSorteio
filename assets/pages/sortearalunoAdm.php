<?php
session_start();
include_once('../templates/header.php');


$sql = "SELECT * FROM userinfos ORDER BY RAND() LIMIT 1";
$select = $conexao->prepare($sql);


if ($select->execute()) {
    $sorteio = $select->fetchAll(PDO::FETCH_ASSOC);
}

function minhaFuncao() {};

if (isset($_POST['meuBotao'])) {
    minhaFuncao();
};

if (isset($_GET['ids'])) {
    $ids = explode(',', $_GET['ids']);
    print_r($ids);
} else {
    echo "Nenhum ID de usuário fornecido.";
}

?>

<main>
    <div class="container">
        <div class="col d-flex flex-row text-center mt-4 w-75">
            <a href="<?= BASE_URL ?>assets/pages/main.php"><img src="../img/seta.png" alt="" class="w-25"></a>
            <h4 class="w-100 d-flex justify-content-center align-items-center">Sortear Alunos</h4>
        </div>
        <div class="col d-flex justify-content-around mt-4">
            <div class="row">
                <div class="container">
                    <h4>Alunos Sorteados:</h4>
                    <?php foreach ($userinfos as $userinfo) { ?>
                        <?php if ($userinfo['adm'] == 1) { ?>
                            <div class="card border border-dark border-2 bg-success d-flex flex-row align-items-center justify-content-between m-2 p-2">
                                <div class="px-2">
                                    <div class="container d-flex align-items-center">
                                        <img src="<?= BASE_URL ?>assets/img/user.png" class="img-user rounded-circle" alt="">
                                        <h5 class="fw-bold text-light ps-1"><?= $userinfo['userName'] ?> <?= $userinfo['userSobrenome'] ?></h5>
                                    </div>
                                    <div class="container">
                                        <h6 class="text-light"><?= $userinfo['userEmail']; ?></h6>
                                    </div>
                                </div>
                                <a href="<?= BASE_URL ?>assets/pages/listaAdm.php" class="border-0 rounded-4 text-black fw-bold p-2">Informações</a>
                            </div>
                        <?php }; ?>
                    <?php }; ?>
                </div>
            </div>
            <div class="row d-flex align-items-center">
                <form method="post" action="<?= BASE_URL ?>assets/php/sortear.php" class="w-100">
                    <input type="hidden" name="userName" value="<?php echo $nomeUser = $_SESSION['userName'] ?? NULL;?>">
                    <input type="hidden" name="userName" value="<?php echo $nomeUser = $_SESSION['userName'] ?? NULL;?>">
                    <input type="hidden" name="userName" value="<?php echo $nomeUser = $_SESSION['userName'] ?? NULL;?>">
                    <input type="hidden" name="userName" value="<?php echo $nomeUser = $_SESSION['userName'] ?? NULL;?>">
                    <input type="hidden" name="userName" value="<?php echo $nomeUser = $_SESSION['userName'] ?? NULL;?>">
                    <button type="submit" name="meuBotao" class="sorteio btn btn-primary fs-2 w-100 border-0 text-dark fw-bold">Sortear</button>
                </form>
                <a href="#" class="result btn btn-primary fs-2 w-100 fw-bold">Lançar resultados</a>
                <?php if (isset($mensagem)) { ?>
                    <p class="alert alert-danger mt-2"><?= $mensagem ?></p>
                <?php }; ?>
            </div>
        </div>
    </div>
</main>

<?php
include_once('../templates/footer.php');
?>