<?php
$isadm = false;

function descriptografarBase64($texto) {
    return base64_decode($texto);
}

if (isset($_COOKIE['uwu'])) {
    $valorCookie = $_COOKIE['uwu'];

    $textoDescriptografado = descriptografarBase64($valorCookie);

    $conteudoArquivo = descriptografarBase64(file_get_contents($_SERVER['DOCUMENT_ROOT']."/adm/123_5.6A9bZd-xYqP2.c3nW8L4rTgVfS7hN1mD0"));

    if ($textoDescriptografado === $conteudoArquivo) {
        $isadm = true;
    }
}

$database = new SQLite3($_SERVER['DOCUMENT_ROOT']."/DBs/database.limadb");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $isadm) {
    $url_parts = explode('/', $_SERVER['REQUEST_URI']);
    $projetoID = end($url_parts);

    $query = "DELETE FROM projetos WHERE id = :id";

    $statement = $database->prepare($query);
    $statement->bindParam(':id', $projetoID, SQLITE3_INTEGER);

    $result = $statement->execute();

    if ($result) {
        http_response_code(200);
        echo json_encode(array("message" => "Projeto deletado com sucesso."));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Erro ao deletar o projeto."));
    }
} else {
    http_response_code(405);
    echo json_encode(array("message" => "Método não permitido."));
}
?>
