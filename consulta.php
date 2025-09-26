<?php
require_once 'conexao.php';

header( 'Content-Type: application/json; charset=utf-8' );

if (isset($_GET['ACAO'])) {

    if ( $_GET['ACAO'] == 'Teste' ) {


        $retorno = get_teste_rack($_GET);

        echo json_encode( $retorno );
        exit;

    }

	//Mostra somente ligações dos ramais da prefeitura

	if ( $_POST['ACAO'] == 'LigacoesRamaisELASTIX' ) {

		$retorno = getRamaisTelefonesELASTIX();
		echo json_encode( $retorno );
		exit;

	}
	if ( $_POST['ACAO'] == 'LigacoesRamaisEmUsoELASTIX' ) {

		$retorno = getramaishints();
		echo json_encode( $retorno );
		exit;

	}

    if ( $_POST['ACAO'] == 'EncerrarListaRamaisForaGancho' ) {

        $retorno = resetListaRamaisForaGancho();
        echo json_encode( $retorno );
        exit;

    }

	if ( $_POST['ACAO'] == 'EncerrarLigacaoELASTIX' ) {

		$retorno = encerrarLigacaoELASTIX($_POST);
		echo json_encode( $retorno );
		exit;

	}

}
exit;