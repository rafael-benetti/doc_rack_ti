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
    <link href="css/style.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="container">
    <?php require_once("../include/header_frame_itanet.php"); ?>

    <div class="r-wrap">
        <div class="r-head d-flex align-items-center justify-content-between">
            <div>
                <h3 style="margin:0 0 6px;"><?php echo $programa->nome; ?> — Documentação do Rack 02 (Servidores)</h3>
                <p class="r-muted">Usuário: <?php echo htmlspecialchars($usuario_dados['nome'] ?? ''); ?></p>
            </div>
            <div class="no-print">
                <a class="btn btn-primary btn-sm" href="#" onclick="window.print()">Imprimir</a>
            </div>
        </div>

        <section class="r-grid">

            <!-- FICHA DO RACK -->
            <div class="r-card card">
                <div class="card-header">📄 Ficha do Rack</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Rack voltado para servidores, DIOs, patch panels e conversores de fibra que conectam a Prefeitura a locais externos.</div>
                    </div>
                </div>
            </div>

            <!-- SERVIDORES -->
            <div class="r-card card">
                <div class="card-header">🖥️ Servidores</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Detalhes sobre os servidores instalados neste rack.</div>
                    </div>
                </div>
            </div>

            <!-- DIOs -->
            <div class="r-card card">
                <div class="card-header">🔌 DIOs (Distribuidores Internos Ópticos)</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Detalhes sobre os DIOs utilizados para gerenciamento das fibras ópticas.</div>
                    </div>
                </div>
            </div>

            <!-- PATCH PANELS -->
            <div class="r-card card">
                <div class="card-header">🧷 Patch Panels & Organização</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Detalhes sobre patch panels de rede e interligações internas.</div>
                    </div>
                </div>
            </div>

            <!-- CONVERSORES DE FIBRA -->
            <div class="r-card card">
                <div class="card-header">🔄 Conversores de Fibra</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Conversores responsáveis pela ligação da Prefeitura com outros prédios externos.</div>
                    </div>
                </div>
            </div>

            <!-- HISTÓRICO -->
            <div class="r-card card">
                <div class="card-header">🗂️ Histórico de Mudanças</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Registro de alterações, substituições e expansões realizadas no rack.</div>
                    </div>
                </div>
            </div>

            <!-- OBS & FOTOS -->
            <div class="r-card card">
                <div class="card-header">📝 Observações & 📷 Fotos</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Fotos da frente, traseira e detalhes de cabos/fibras do rack.</div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>

</body>

</html>