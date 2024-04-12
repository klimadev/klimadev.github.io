<?php
function descriptografarBase64($texto) {
    return base64_decode($texto);
}
global $stop;

$stop = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['senha'])) {
    $senhaFornecida = $_POST['senha'];

    $conteudoArquivo = descriptografarBase64(file_get_contents("123_5.6A9bZd-xYqP2.c3nW8L4rTgVfS7hN1mD0"));

    if ($senhaFornecida === $conteudoArquivo) {
        $valorCookie = base64_encode($conteudoArquivo);
        setcookie('uwu', $valorCookie, time() + (86400 * 1), "/");
    } else {
        $stop = true;
        exibirFormularioSenha();
    }
} else {
    if (isset($_COOKIE['uwu'])) {
        $valorCookie = $_COOKIE['uwu'];

        $textoDescriptografado = descriptografarBase64($valorCookie);

        $conteudoArquivo = descriptografarBase64(file_get_contents("123_5.6A9bZd-xYqP2.c3nW8L4rTgVfS7hN1mD0"));

        if ($textoDescriptografado === $conteudoArquivo) {
            //echo "Conteúdo do cookie corresponde ao conteúdo do arquivo.";
        } else {
            exibirFormularioSenha();
        }
    } else {
        $stop = true;
        exibirFormularioSenha();
    }
}

function exibirFormularioSenha() {
    global $stop;
    $stop = true;
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verificação de senha</title>
    </head>
    <body>
        <h1>Por favor, insira a senha:</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <button type="submit">Enviar</button>
        </form>
    </body>
    </html>
    <?php
}

if ($stop){
    die();
}

date_default_timezone_set('America/Sao_Paulo');

// Caminho para o banco de dados SQLite3
$db_file = $_SERVER['DOCUMENT_ROOT'].'/DBs/database.limadb';

try {
    // Conectando ao banco de dados utilizando PDO
    $pdo = new PDO('sqlite:' . $db_file);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em caso de erro na conexão, exibe uma mensagem de erro
    echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
    exit();
}

// Definindo as consultas SQL
$query_hoje = "SELECT COUNT(*) AS acessos_hoje FROM actions WHERE strftime('%Y-%m-%d', timestamp) = strftime('%Y-%m-%d', 'now', 'localtime')";
$query_mes = "SELECT COUNT(*) AS acessos_mes FROM actions WHERE strftime('%Y-%m', timestamp) = strftime('%Y-%m', 'now', 'localtime')";
$query_total = "SELECT COUNT(*) AS total_acessos FROM actions";
$query_actions = "SELECT action, COUNT(*) AS quantidade FROM actions GROUP BY action";

try {
    // Executando as consultas
    $resultado_hoje = $pdo->query($query_hoje)->fetchColumn();
    $resultado_mes = $pdo->query($query_mes)->fetchColumn();
    $resultado_total = $pdo->query($query_total)->fetchColumn();
    $resultado_actions = $pdo->query($query_actions)->fetchAll(PDO::FETCH_ASSOC);

    // Calculando as médias diária e mensal
    $media_diaria = $resultado_total / intval(date('d'));
    $media_mensal = $resultado_total / intval(date('t'));
} catch (PDOException $e) {
    // Em caso de erro na execução da consulta, exibe uma mensagem de erro
    echo 'Erro ao executar consulta: ' . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Acessos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboard2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Biblioteca Chart.js para gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
</head>
<body class="bg-dark text-light">
<a href="/" class="btn-back">&#8592;</a>
    <div id="dashboard">
        <div class="container">
            <h2 class="text-center mt-5 mb-4">Dashboard de Acessos</h2>

            <!-- Acessos temporários (do dia, do mês, total) -->
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
                <div class="col">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            <h3 class="card-title">Acessos de Hoje</h3>
                            <p class="card-text fs-1"><?= $resultado_hoje ?></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            <h3 class="card-title">Acessos do Mês</h3>
                            <p class="card-text fs-1"><?= $resultado_mes ?></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-warning text-dark shadow">
                        <div class="card-body">
                            <h3 class="card-title">Total de Acessos</h3>
                            <p class="card-text fs-1"><?= $resultado_total ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acessos estáticos (média diária, média mensal) -->
            <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
                <div class="col">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            <h3 class="card-title">Média Diária</h3>
                            <p class="card-text fs-1"><?= round($media_diaria, 2) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            <h3 class="card-title">Média Mensal</h3>
                            <p class="card-text fs-1"><?= round($media_mensal, 2) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acessos específicos (Instagram, LinkedIn) -->
            <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
                <?php foreach ($resultado_actions as $row): ?>
                    <div class="col">
                        <div class="card bg-secondary text-white shadow">
                            <div class="card-body">
                                <h3 class="card-title"><?= $row['action'] ?></h3>
                                <p class="card-text fs-1"><?= $row['quantidade'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
