<?php
session_start();

include_once('../data/config.php');
include_once('../templates/header.php');

$id = $IdUser;

$sql = "SELECT * FROM usersorteados WHERE userId = :id";
$stmt = $conexao->prepare($sql);

$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<main>
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
        <div class="bg-warning d-flex flex-column justify-content-center rounded-4">
            <?php if ($sorteioSim == false){ ?> 
                <h1 class="text-center mt-5 m-5">SORTEIO AINDA NÃO FEITO </h1>
            <?php } elseif($user) { ?>
                <h1 class="text-center mt-5 m-5">VOCÊ FOI SORTEADO EBA PARABÉNS </h1>
            <?php } else { ?>
                <h1 class="text-center mt-5 m-5">NÃO FOI DESSA VEZ, QUE PENA <?php echo $nomeUser ?></h1>
            <?php };?>
            <a href="../pages/main.php" class="btn btn-primary fs-4 p-3 border-0 rounded-4 mt-4 m-5">VOLTAR PARA A TELA INICIAL</a>
        </div>
        <?php if ($user) { ?>
        <div class="d-flex justify-content-evenly">
            <img src="../img/sorteadoE.png" alt="imagem de fogos de artifício">
            <img src="../img/sorteado.png" alt="imagem de fogos de artifício">
        </div>
        <?php }?>

    </div>
</main>

<?php
include_once('../templates/footer.php');
?>