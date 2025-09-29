<?php
session_start();

require_once '../include/config.php'; // já carrega autoload, constants, validacao, include/conexao.php (MysqliDb)
require_once 'function.php';

use Programa\Programa;

$frame_topmenu = getTopMenuProgramaITANET(180, true);
$programa      = new Programa(180);
$usuario_dados = getUsuarioItanet(getUsuarioSessao());

// pega instância MysqliDb
$db = Conexao::getLink(); // ou getDbLink()

// ID do rack (?rack_id=1) – default 1
$rack_id = isset($_GET['rack_id']) ? (int)$_GET['rack_id'] : 1;

// valor padrão
$rack = [
  'ficha_rack'         => '',
  'equipamentos'       => '',
  'patch_panels'       => '',
  'rede'               => '',
  'energia_clima'      => '',
  'manutencao_acessos' => '',
  'historico'          => '',
  'observacoes_fotos'  => '',
];

// busca / cria
$existe = $db->where('id', $rack_id)->getOne('racks');
if ($existe) {
  $rack = array_merge($rack, $existe);
} else {
  $db->insert('racks', ['id' => $rack_id]); // cria linha vazia
  $rack = $db->where('id', $rack_id)->getOne('racks') ?: $rack;
}

// helper de escape
function esc($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
