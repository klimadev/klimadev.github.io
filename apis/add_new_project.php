<?php
date_default_timezone_set('America/Sao_Paulo');
ini_set('upload_max_filesize', '4G');
ini_set('post_max_size', '4G');


// Verifica se o método da solicitação é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se há arquivos enviados
    if (isset($_FILES['medias'])) {
        // Extrai os dados do novo projeto
        $titulo = $_POST['titulo'];
        $sinopse = $_POST['sinopse'];
        $descricao = $_POST['descricao'];
        $medias = $_FILES['medias'];

        $pastaProjeto = $_SERVER['DOCUMENT_ROOT'] . "/images/projects/$titulo";
        if (!file_exists($pastaProjeto)) {
            mkdir($pastaProjeto, 0777, true);
        } else {
            // Limpa todas as imagens existentes na pasta do projeto
            $files = glob($pastaProjeto . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }

        // Move cada mídia para a pasta do projeto e obtém seus caminhos
        $caminhosMedias = array();
        foreach ($medias['tmp_name'] as $key => $tmp_name) {
            $nomeAleatorio = uniqid() . '.' . pathinfo($medias['name'][$key], PATHINFO_EXTENSION);
            $caminhoMedia = "$pastaProjeto/$nomeAleatorio";
            move_uploaded_file($tmp_name, $caminhoMedia);
            $caminhoMedia = "/images/projects/$titulo/$nomeAleatorio";
            $caminhosMedias[] = $caminhoMedia;
        }

        // Insere ou atualiza os dados do projeto no banco de dados SQLite3
        try {
            // Conexão com o banco de dados SQLite3
            $db = new SQLite3($_SERVER['DOCUMENT_ROOT'].'/DBs/database.limadb');

            // Verifica se o título já existe no banco de dados
            $stmt_check = $db->prepare('SELECT COUNT(*) FROM projetos WHERE titulo = :titulo');
            $stmt_check->bindValue(':titulo', $titulo, SQLITE3_TEXT);
            $result = $stmt_check->execute()->fetchArray();

            if ($result[0] > 0) {
                // O título já existe, então faz um update
                $stmt = $db->prepare('UPDATE projetos SET sinopse = :sinopse, descricao = :descricao, medias = :medias WHERE titulo = :titulo');
            } else {
                // O título não existe, então faz um insert
                $stmt = $db->prepare('INSERT INTO projetos (titulo, sinopse, descricao, medias) VALUES (:titulo, :sinopse, :descricao, :medias)');
            }

            // Binde os valores e execute a declaração SQL
            $stmt->bindValue(':titulo', $titulo, SQLITE3_TEXT);
            $stmt->bindValue(':sinopse', $sinopse, SQLITE3_TEXT);
            $stmt->bindValue(':descricao', $descricao, SQLITE3_TEXT);
            $stmt->bindValue(':medias', json_encode($caminhosMedias), SQLITE3_TEXT);
            $stmt->execute();

            // Fecha a conexão com o banco de dados
            $db->close();

            // Retorna uma resposta de sucesso
            echo json_encode(array('success' => true, 'message' => 'Projeto adicionado/atualizado com sucesso!'));
        } catch (Exception $e) {
            // Retorna uma resposta de erro em caso de falha
            echo json_encode(array('success' => false, 'message' => 'Erro ao adicionar/atualizar projeto: ' . $e->getMessage()));
        }
    } else {
        // Retorna uma resposta de erro se não houver arquivos enviados
        echo json_encode(array('success' => false, 'message' => 'Nenhum arquivo enviado.'));
    }
} else {
    // Retorna uma resposta de erro se o método da solicitação não for POST
    echo json_encode(array('success' => false, 'message' => 'Método inválido. Apenas solicitações POST são permitidas.'));
}
?>
