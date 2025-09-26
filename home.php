<?php
require_once( "conexao.php" );

use Programa\Programa;
$programa           = new Programa(180);
$usuario_dados      = getUsuarioItanet( getUsuarioSessao() );

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8"/>
    <title><?php echo $programa->nome;?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link href="../css/appv2.min.css?v=<?php echo VERSAO; ?>" type="text/css" rel="stylesheet">
    <script src="../js/appv2.min.js?v=<?php echo VERSAO;?>" type="text/javascript"></script>


</head>

<body>

<div class="container">
    <?php
    require_once( "../include/header_frame_itanet.php" );


    ?>
    <div class="modal fade bd-example-modal-xl" id="myModal" tabindex="-1" role="dialog"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_titulo">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>

                </div>
                <div class="modal-body" id="conteudo_modal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12 small">

            <div class="row">
                <div class="col-sm-12">
                    <?php

                    echo ' <p class="text-muted" style="font-size: 8pt;">';
                    echo '[ Usuário ] - '.$usuario_dados['nome'].'<br>';
                    echo ' </p>';

                    ?>
                </div>
            </div>
        </div>

        <div id="retorno"></div>


</body>

<script>

    $(document).ready(function () {

        $('#telefone').mask('(99) 99999-9999');
        // $('#cpf').mask('999.999.999-99');
        $("#data_solic").datepicker({
            language: 'pt-BR',
            format: 'dd/mm/yyyy',
        });

        $.ajax({
            type: 'GET',
            url: "consulta.php?ACAO=Teste",
           // method: 'get',
            dataType: 'json',
            data: 1,
            success: function (retorno) {
                //console.log('?: '+retorno);
                $('#retorno').text(retorno.msg);


            }
        });

    });



</script>



</html>