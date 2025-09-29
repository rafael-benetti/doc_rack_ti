<?php
session_start();

require_once '../include/config.php'; // já carrega autoload, constants, validacao, include/conexao.php (MysqliDb)
require_once 'function.php';

use Programa\Programa;

$frame_topmenu = getTopMenuProgramaITANET(180, true);
$programa      = new Programa(180);
$usuario_dados = getUsuarioItanet(getUsuarioSessao());

// pega instância MysqliDb (uma vez só)
$db = Conexao::getLink();

/**
 * Resolve o rack_id na seguinte ordem de prioridade:
 * 1) Se já foi definido antes deste arquivo (ex.: $rack_id = 1; na rack01.php), usa-o.
 * 2) Se vier por GET (?rack_id=1), usa-o.
 * 3) Infere pelo nome do script (rack01.php => 1, rack02.php => 2, rack03.php => 3).
 * 4) Padrão final: 1.
 */
if (isset($rack_id) && is_numeric($rack_id) && (int)$rack_id > 0) {
  $rack_id = (int)$rack_id;
} elseif (isset($_GET['rack_id']) && is_numeric($_GET['rack_id']) && (int)$_GET['rack_id'] > 0) {
  $rack_id = (int)$_GET['rack_id'];
} else {
  $script = basename($_SERVER['SCRIPT_NAME'] ?? '');
  $map = [
    'rack01.php' => 1,
    'rack02.php' => 2,
    'rack03.php' => 3,
  ];
  $rack_id = isset($map[$script]) ? $map[$script] : 1;
}

/** Valor padrão dos campos do rack (evita undefined index ao renderizar) */
$rack = [
  'id'                  => $rack_id,
  'ficha_rack'          => '',
  'storage_principal'   => '',
  'gavetas_expansao'    => '',
  'controladoras'       => '',
  'conexoes_rede_san'   => '',
  'servidores'          => '',
  'dios'                => '',
  'conversores_fibra'   => '',
  'equipamentos'        => '',
  'patch_panels'        => '',
  'rede'                => '',
  'energia_clima'       => '',
  'manutencao_acessos'  => '',
  'historico'           => '',
  'observacoes_fotos'   => '',
];

/** Busca ou cria a linha do rack correspondente ao $rack_id */
$existe = $db->where('id', $rack_id)->getOne('racks');
if ($existe) {
  // mescla para garantir todas as chaves padrão presentes
  $rack = array_merge($rack, $existe);
} else {
  // cria a linha inicial somente com o ID; demais campos podem ser atualizados depois
  $db->insert('racks', ['id' => $rack_id]);
  $novo = $db->where('id', $rack_id)->getOne('racks');
  if (is_array($novo)) {
    $rack = array_merge($rack, $novo);
  }
}

/** Helper de escape para saída HTML */
function esc($s) {
  return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}
