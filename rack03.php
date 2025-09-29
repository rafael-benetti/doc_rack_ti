<?php
require_once("conexao.php");

use Programa\Programa;
$programa      = new Programa(180);
$usuario_dados = getUsuarioItanet(getUsuarioSessao());
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title><?php echo $programa->nome; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="../css/appv2.min.css?v=<?php echo VERSAO; ?>" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="../js/appv2.min.js?v=<?php echo VERSAO; ?>" type="text/javascript"></script>

    
</head>
<body>

<div class="container">
    <?php require_once("../include/header_frame_itanet.php"); ?>

    <div class="r-wrap">
        <div class="r-head d-flex align-items-center justify-content-between">
            <div>
                <h3 style="margin:0 0 6px;"><?php echo $programa->nome; ?> — Documentação do Rack 03 (Storage)</h3>
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
                        <div contenteditable="true">Rack dedicado a storage corporativo, com gavetas de discos, controladoras e expansão de capacidade.</div>
                    </div>
                </div>
            </div>

            <!-- STORAGE PRINCIPAL -->
            <div class="r-card card">
                <div class="card-header">💾 Storage Principal</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Detalhes do storage principal: modelo, número de discos, controladoras, protocolos (iSCSI, FC, NFS, SMB).</div>
                    </div>
                </div>
            </div>

            <!-- GAVETAS DE EXPANSÃO -->
            <div class="r-card card">
                <div class="card-header">📦 Gavetas de Expansão</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Detalhes sobre as gavetas adicionais para expansão de discos.</div>
                    </div>
                </div>
            </div>

            <!-- CONTROLADORAS -->
            <div class="r-card card">
                <div class="card-header">🛠️ Controladoras</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Controladoras redundantes, firmware, configurações de cache e failover.</div>
                    </div>
                </div>
            </div>

            <!-- CONEXÕES DE REDE -->
            <div class="r-card card">
                <div class="card-header">🌐 Conexões de Rede / SAN</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Interfaces de rede, portas Fibre Channel ou iSCSI, VLANs e IPs utilizados.</div>
                    </div>
                </div>
            </div>

            <!-- ENERGIA & CLIMA -->
            <div class="r-card card">
                <div class="card-header">⚡ Energia & ❄️ Climatização</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Detalhes sobre PDUs, redundância de energia e requisitos de refrigeração específicos do storage.</div>
                    </div>
                </div>
            </div>

            <!-- HISTÓRICO -->
            <div class="r-card card">
                <div class="card-header">🗂️ Histórico de Mudanças</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Registro de upgrades de firmware, substituição de discos e expansões de capacidade.</div>
                    </div>
                </div>
            </div>

            <!-- OBS & FOTOS -->
            <div class="r-card card">
                <div class="card-header">📝 Observações & 📷 Fotos</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div><span class="r-badge">Observações</span></div>
                        <div contenteditable="true">Fotos das gavetas de discos, controladoras e conexões traseiras.</div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>


</body>
</html>
