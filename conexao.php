<?php
session_start();
require_once '../include/config.php';
require_once 'function.php';
//require_once 'function.php';
//require_once 'Iluminacao.php';
$frame_topmenu = getTopMenuProgramaITANET(180, true);

//Conecta no Banco de Dados
/*$db = getDbLink();
//Seleciona a Base de Dados
db1();
db2();

$iduser_log     = getUsuarioSessao();
$ilpubusu          = getIlPubUsuario();
$link           = getDbLink();
$db_selected    = db2();
//$biblioteca_usuario = getBibliotecaBIBLIOCOM( $biblio['setor'], 'setor' );
$usuario_dados      = getUsuarioItanet( getUsuarioSessao() );*/
