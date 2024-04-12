<?php

date_default_timezone_set('America/Sao_paulo');
// Função para obter o endereço IP do cliente
function getIPAddress() {
    // Verifica se o endereço IP está disponível na variável $_SERVER
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Parâmetros recebidos via POST
$action = $_POST['action'];
$timestamp = date("Y-m-d H:i:s"); // Obtém o timestamp atual
$ip = getIPAddress(); // Obtém o endereço IP do cliente

// Conexão com o banco de dados SQLite3
try {
    // Abre a conexão com o banco de dados
    $db = new SQLite3($_SERVER['DOCUMENT_ROOT'].'/DBs/database.limadb');

    // Verifica se a tabela "actions" existe, se não existir, cria-a
    $db->exec("CREATE TABLE IF NOT EXISTS actions (
                id INTEGER PRIMARY KEY,
                timestamp DATETIME,
                ip TEXT,
                action TEXT
            )");

    // Prepara a declaração SQL para inserir os dados na tabela
    $stmt = $db->prepare("INSERT INTO actions (timestamp, ip, action) VALUES (:timestamp, :ip, :action)");

    // Vincula os parâmetros à declaração SQL
    $stmt->bindValue(':timestamp', $timestamp, SQLITE3_TEXT);
    $stmt->bindValue(':ip', $ip, SQLITE3_TEXT);
    $stmt->bindValue(':action', $action, SQLITE3_TEXT);

    // Executa a declaração SQL para inserir os dados na tabela
    $stmt->execute();

    // Fecha a conexão com o banco de dados
    $db->close();

    // Retorna uma resposta de sucesso
    echo "Registrada com sucesso!";

} catch(Exception $e) {
    // Em caso de erro, retorna uma mensagem de erro
    echo "Erro ao registrar ação: " . $e->getMessage();
}
?>
