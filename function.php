<?php

function get_teste_rack($dados): array
{
   // $db = MysqliDb::getInstance();
    $retorno = [
        'status' => false,
        'dados'  => $dados,
        'msg'    => 'Erro ao conectar no banco de dados.'
    ];
        if ($dados != null) {
            $retorno['msg'] = 'Teste Retornou Ok';
            $retorno['status'] = true;
        }
         return $retorno;

}