<?php
// força este arquivo a trabalhar com o rack_id = 3
$rack_id = 3;
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
            <div contenteditable="true" data-field="ficha_rack">
              <?= esc($rack['ficha_rack'] ?? 'Rack dedicado a storage corporativo, com gavetas de discos, controladoras e expansão de capacidade.') ?>
            </div>
          </div>
        </div>
      </div>

      <!-- STORAGE PRINCIPAL -->
      <div class="r-card card">
        <div class="card-header">💾 Storage Principal</div>
        <div class="card-body">
          <div class="mb-3">
            <div><span class="r-badge">Observações</span></div>
            <div contenteditable="true" data-field="storage_principal">
              <?= esc($rack['storage_principal'] ?? 'Modelo, número de discos, controladoras, protocolos (iSCSI, FC, NFS, SMB).') ?>
            </div>
          </div>
        </div>
      </div>

      <!-- GAVETAS DE EXPANSÃO -->
      <div class="r-card card">
        <div class="card-header">📦 Gavetas de Expansão</div>
        <div class="card-body">
          <div class="mb-3">
            <div><span class="r-badge">Observações</span></div>
            <div contenteditable="true" data-field="gavetas_expansao">
              <?= esc($rack['gavetas_expansao'] ?? 'Detalhes sobre gavetas adicionais para expansão de discos.') ?>
            </div>
          </div>
        </div>
      </div>

      <!-- CONTROLADORAS -->
      <div class="r-card card">
        <div class="card-header">🛠️ Controladoras</div>
        <div class="card-body">
          <div class="mb-3">
            <div><span class="r-badge">Observações</span></div>
            <div contenteditable="true" data-field="controladoras">
              <?= esc($rack['controladoras'] ?? 'Controladoras redundantes, firmware, cache e failover.') ?>
            </div>
          </div>
        </div>
      </div>

      <!-- CONEXÕES DE REDE / SAN -->
      <div class="r-card card">
        <div class="card-header">🌐 Conexões de Rede / SAN</div>
        <div class="card-body">
          <div class="mb-3">
            <div><span class="r-badge">Observações</span></div>
            <div contenteditable="true" data-field="conexoes_rede_san">
              <?= esc($rack['conexoes_rede_san'] ?? 'Interfaces de rede, portas FC/iSCSI, VLANs e IPs utilizados.') ?>
            </div>
          </div>
        </div>
      </div>

      <!-- ENERGIA & CLIMA -->
      <div class="r-card card">
        <div class="card-header">⚡ Energia & ❄️ Climatização</div>
        <div class="card-body">
          <div class="mb-3">
            <div><span class="r-badge">Observações</span></div>
            <div contenteditable="true" data-field="energia_clima">
              <?= esc($rack['energia_clima'] ?? 'PDUs, redundância de energia e requisitos de refrigeração.') ?>
            </div>
          </div>
        </div>
      </div>

      <!-- HISTÓRICO -->
      <div class="r-card card">
        <div class="card-header">🗂️ Histórico de Mudanças</div>
        <div class="card-body">
          <div class="mb-3">
            <div><span class="r-badge">Observações</span></div>
            <div contenteditable="true" data-field="historico">
              <?= esc($rack['historico'] ?? 'Upgrades de firmware, substituições e expansões de capacidade.') ?>
            </div>
          </div>
        </div>
      </div>

      <!-- OBS & FOTOS -->
      <div class="r-card card">
        <div class="card-header">📝 Observações & 📷 Fotos</div>
        <div class="card-body">
          <div class="mb-3">
            <div><span class="r-badge">Observações</span></div>
            <div contenteditable="true" data-field="observacoes_fotos">
              <?= esc($rack['observacoes_fotos'] ?? 'Fotos das gavetas, controladoras e conexões traseiras.') ?>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const RACK_ID = <?php echo (int)$rack_id; ?>;
  const SAVE_URL = "/php/doc_rack_ti/salvar_rack.php";

  const debounce = (fn, delay = 600) => { let t; return (...a) => { clearTimeout(t); t = setTimeout(() => fn(...a), delay); }; };

  function salvar(field, value) {
    if (!field) return;
    fetch(SAVE_URL, {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      body: "id=" + encodeURIComponent(RACK_ID) +
            "&field=" + encodeURIComponent(field) +
            "&value=" + encodeURIComponent(value)
    })
    .then(r => r.json())
    .then(data => { if (!data.success) console.warn("Falha ao salvar:", data); })
    .catch(err => console.error("Erro de rede:", err));
  }

  const handler = debounce(function () {
    const field = this.dataset.field;
    const value = this.innerText.trim();
    salvar(field, value);
  }, 600);

  document.querySelectorAll("[contenteditable]").forEach(el => {
    el.addEventListener("input", handler);
    el.addEventListener("keyup", handler);
    el.addEventListener("paste", handler);
    el.addEventListener("blur", function () {
      const field = this.dataset.field;
      const value = this.innerText.trim();
      salvar(field, value);
    });
  });
});
</script>

</body>
</html>
