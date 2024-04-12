<?php
date_default_timezone_set('America/Sao_Paulo');

try {
    // Conexão com o banco de dados SQLite3
    $db = new SQLite3($_SERVER['DOCUMENT_ROOT'].'/DBs/database.limadb');

    // Parâmetros de paginação
    $registrosPorPagina = 10; // Número de registros por página
    $paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Número da página atual

    // Calcular o deslocamento (offset) com base na página atual e no número de registros por página
    $offset = ($paginaAtual - 1) * $registrosPorPagina;

    // Query para obter os registros com base nos parâmetros de paginação
    $query = "SELECT * FROM actions WHERE action LIKE 'acesso%' LIMIT :limit OFFSET :offset";

    // Preparar a declaração SQL
    $stmt = $db->prepare($query);
    $stmt->bindValue(':limit', $registrosPorPagina, SQLITE3_INTEGER);
    $stmt->bindValue(':offset', $offset, SQLITE3_INTEGER);

    // Executar a consulta
    $result = $stmt->execute();

    // Array para armazenar os resultados
    $resultados = array();

    // Iterar sobre os resultados da consulta
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        // Adicionar cada linha aos resultados
        $resultados[] = $row;
    }

    // Fechar a conexão com o banco de dados
    $db->close();

    // Retornar os resultados como JSON
    header('Content-Type: application/json');
    echo json_encode($resultados);

} catch(Exception $e) {
    // Em caso de erro, exibir uma mensagem de erro
    echo "Erro ao obter informações do banco de dados: " . $e->getMessage();
}
?>
