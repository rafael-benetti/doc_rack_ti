<?php
header('Content-Type: application/json; charset=utf-8');

/**
 * ATENÇÃO:
 * - DEBUG só retorna detalhes se ?debug=1 na URL OU se RACK_DEBUG=true abaixo.
 * - O log vai para __DIR__/rack_debug.log (mesma pasta do salvar_rack.php).
 */
define('RACK_DEBUG', false); // mude para true temporariamente se quiser

$DEBUG = RACK_DEBUG || (isset($_GET['debug']) && $_GET['debug'] == '1');
$logFile = __DIR__ . '/rack_debug.log';
function dlog($msg)
{
    global $DEBUG, $logFile;
    if (!$DEBUG) return;
    if (!is_string($msg)) $msg = print_r($msg, true);
    @file_put_contents($logFile, '[' . date('Y-m-d H:i:s') . "] " . $msg . "\n", FILE_APPEND);
}

try {
    require_once __DIR__ . '/../include/config.php'; // carrega autoload, constants e include/conexao.php (MysqliDb)
    $db = Conexao::getLink(); // MysqliDb (ThingEngineer)

    // LOG de requisição
    dlog('--- NOVA REQUISIÇÃO ---');
    dlog(['REQUEST_METHOD' => $_SERVER['REQUEST_METHOD'] ?? null, 'URI' => $_SERVER['REQUEST_URI'] ?? null]);
    dlog(['POST' => $_POST]);

    $id    = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $field = $_POST['field'] ?? '';
    $value = $_POST['value'] ?? '';

    // Campos permitidos – DEVEM bater com data-field do rack01.php
    $allowed = [
        'ficha_rack',
        'storage_principal',
        'gavetas_expansao',
        'controladoras',
        'conexoes_rede_san',
        'servidores',
        'dios',
        'conversores_fibra',
        'equipamentos',
        'patch_panels',
        'rede',
        'energia_clima',
        'manutencao_acessos',
        'historico',
        'observacoes_fotos',
    ];

    if ($id <= 0 || !in_array($field, $allowed, true)) {
        dlog("Parâmetros inválidos: id={$id}, field={$field}");
        echo json_encode(['success' => false, 'msg' => 'Parâmetros inválidos', 'debug' => $DEBUG ? compact('id', 'field') : null]);
        exit;
    }

    // Sanity check do DB (opcional)
    $okPing = (bool) $db->rawQuery('SELECT 1');
    if (!$okPing) {
        $err = $db->getLastError();
        dlog('Falha no SELECT 1: ' . $err);
        echo json_encode(['success' => false, 'msg' => 'DB indisponível', 'debug' => $DEBUG ? ['db_error' => $err] : null]);
        exit;
    }

    // Existe registro?
    $exists = (bool) $db->where('id', $id)->getValue('racks', 'id');
    dlog(['exists' => $exists, 'id' => $id]);

    if ($exists) {
        $db->where('id', $id);
        $ok = $db->update('racks', [
            $field       => $value,
            'updated_at' => $db->now(),
        ]);
        dlog(['acao' => 'UPDATE', 'lastQuery' => $db->getLastQuery(), 'ok' => $ok, 'err' => $db->getLastError()]);
    } else {
        $ok = (bool) $db->insert('racks', [
            'id'    => $id,
            $field  => $value
        ]);
        dlog(['acao' => 'INSERT', 'lastQuery' => $db->getLastQuery(), 'ok' => $ok, 'err' => $db->getLastError()]);
    }

    $resp = [
        'success' => (bool)$ok,
        'msg'     => $ok ? 'Salvo' : ('Falha ao salvar'),
    ];
    if (!$ok && $DEBUG) {
        $resp['db_error']  = $db->getLastError();
        $resp['lastQuery'] = $db->getLastQuery();
    }

    echo json_encode($resp);
} catch (Throwable $e) {
    dlog('Exceção: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'msg' => 'Erro interno',
        'debug' => $DEBUG ? $e->getMessage() : null
    ]);
}
