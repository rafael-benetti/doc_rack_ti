<?php
require_once("conexao.php");

use Programa\Programa;

$programa      = new Programa(180);
$usuario_dados = getUsuarioItanet(getUsuarioSessao());
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <title><?php echo $programa->nome; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="../css/appv2.min.css?v=<?php echo VERSAO; ?>" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="../js/appv2.min.js?v=<?php echo VERSAO; ?>" type="text/javascript"></script>


</head>

<body>

    <div class="container">
        <?php require_once("../include/header_frame_itanet.php"); ?>

        <div class="r-wrap">
            <div class="r-head">
                <h3 style="margin:0 0 6px;"><?php echo $programa->nome; ?></h3>
                <p class="r-muted">Usuário: <?php echo htmlspecialchars($usuario_dados['nome'] ?? ''); ?></p>
            </div>

            <section class="r-grid">
                <!-- Card 1 -->
                <article class="r-card">
                    <a href="rack01.php">
                        <img class="r-card__media" src="imagens/rack1.jpg" alt="Imagem do rack1">
                    </a>
                    <div class="r-card__body">
                        <h4 class="r-card__title">Rack 01</h4>
                        <p class="r-card__desc">Rack de distribuição no bloco administrativo (patch panels e switches).</p>
                    </div>
                </article>

                <!-- Card 2 -->
                <article class="r-card">
                    <a href="rack02.php">
                    <img class="r-card__media" src="imagens/rack2.jpg" alt="Imagem do rack2">
                    </a>
                    <div class="r-card__body">
                        <h4 class="r-card__title">Rack 02</h4>
                        <p class="r-card__desc">Rack principal da sala de TI, com servidores e switches core.</p>
                    </div>
                </article>

                <!-- Card 3 -->
                <article class="r-card">
                    <a href="rack03.php">
                    <img class="r-card__media" src="imagens/rack3.jpg" alt="Imagem do rack3">
                    </a>
                    <div class="r-card__body">
                        <h4 class="r-card__title">Rack 03</h4>
                        <p class="r-card__desc">Rack de contingência com equipamentos redundantes e monitoramento.</p>
                    </div>
                </article>
            </section>
        </div>
    </div>

</body>

</html>