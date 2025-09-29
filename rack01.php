<?php
$rack_id = 1;
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
                    <h3 style="margin:0 0 6px;"><?php echo $programa->nome; ?> — Documentação do Rack 01 (Redes)</h3>
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
        <div contenteditable="true" data-field="ficha_rack"><?= esc($rack['ficha_rack'] ?? '') ?></div>
      </div>
    </div>
  </div>

  <!-- EQUIPAMENTOS -->
  <div class="r-card card">
    <div class="card-header">🧰 Equipamentos (por posição U)</div>
    <div class="card-body">
      <div class="mb-3">
        <div><span class="r-badge">Observações</span></div>
        <div contenteditable="true" data-field="equipamentos"><?= esc($rack['equipamentos'] ?? '') ?></div>
      </div>
    </div>
  </div>

  <!-- PATCH PANELS -->
  <div class="r-card card">
    <div class="card-header">🧷 Patch Panels & Organização</div>
    <div class="card-body">
      <div class="mb-3">
        <div><span class="r-badge">Observações</span></div>
        <div contenteditable="true" data-field="patch_panels"><?= esc($rack['patch_panels'] ?? '') ?></div>
      </div>
    </div>
  </div>

  <!-- REDE -->
  <div class="r-card card">
    <div class="card-header">🌐 Rede & Endereçamento</div>
    <div class="card-body">
      <div class="mb-3">
        <div><span class="r-badge">Observações</span></div>
        <div contenteditable="true" data-field="rede"><?= esc($rack['rede'] ?? '') ?></div>
      </div>
    </div>
  </div>

  <!-- ENERGIA & CLIMA -->
  <div class="r-card card">
    <div class="card-header">⚡ Energia & ❄️ Climatização</div>
    <div class="card-body">
      <div class="mb-3">
        <div><span class="r-badge">Observações</span></div>
        <div contenteditable="true" data-field="energia_clima"><?= esc($rack['energia_clima'] ?? '') ?></div>
      </div>
    </div>
  </div>

  <!-- MANUTENÇÃO & ACESSOS -->
  <div class="r-card card">
    <div class="card-header">🛠️ Manutenção & Acessos</div>
    <div class="card-body">
      <div class="mb-3">
        <div><span class="r-badge">Observações</span></div>
        <div contenteditable="true" data-field="manutencao_acessos"><?= esc($rack['manutencao_acessos'] ?? '') ?></div>
      </div>
    </div>
  </div>

  <!-- HISTÓRICO -->
  <div class="r-card card">
    <div class="card-header">🗂️ Histórico de Mudanças</div>
    <div class="card-body">
      <div class="mb-3">
        <div><span class="r-badge">Observações</span></div>
        <div contenteditable="true" data-field="historico"><?= esc($rack['historico'] ?? '') ?></div>
      </div>
    </div>
  </div>

  <!-- OBS & FOTOS -->
  <div class="r-card card">
    <div class="card-header">📝 Observações & 📷 Fotos</div>
    <div class="card-body">
      <div class="mb-3">
        <div><span class="r-badge">Observações</span></div>
        <div contenteditable="true" data-field="observacoes_fotos"><?= esc($rack['observacoes_fotos'] ?? '') ?></div>
      </div>
    </div>
  </div>

</section>

        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  console.log('rack01.js boot');

  const RACK_ID = <?php echo (int)$rack_id; ?>;
  const SAVE_URL = "/php/doc_rack_ti/salvar_rack.php?debug=1"; // debug temporário

  const debounce = (fn, delay = 600) => { let t; return (...a) => { clearTimeout(t); t = setTimeout(() => fn(...a), delay); }; };

  function salvar(field, value) {
    if (!field) return;
    console.log("Salvando:", {id: RACK_ID, field, value});
    fetch(SAVE_URL, {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      body: "id=" + encodeURIComponent(RACK_ID) +
            "&field=" + encodeURIComponent(field) +
            "&value=" + encodeURIComponent(value)
    })
    .then(r => r.json())
    .then(data => { console.log("Resposta salvar:", data); })
    .catch(err => console.error("Erro de rede:", err));
  }

  const handler = debounce(function () {
    const field = this.dataset.field;
    const value = this.innerText.trim();
    salvar(field, value);
  }, 600);

  const els = document.querySelectorAll("[contenteditable]");
  console.log("contenteditable encontrados:", els.length);
  els.forEach(el => {
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