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
ini_set('upload_max_filesize', '4G');
ini_set('post_max_size', '4G');

try {
    // Conexão com o banco de dados SQLite3
    $db = new SQLite3($_SERVER['DOCUMENT_ROOT'].'/DBs/database.limadb');

    // Query para obter todos os registros de ações que começam com "acesso"
    $query = "SELECT * FROM actions WHERE action LIKE 'acesso%'";

    // Executar a consulta
    $result = $db->query($query);

    // Inicializar contadores
    $acessosHoje = 0;
    $acessosMes = 0;
    $acessosTotal = 0;

    // Obter a data atual
    $dataAtual = date("Y-m-d");

    // Iterar sobre os resultados da consulta
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        // Incrementar o contador de acessos totais
        $acessosTotal++;

        // Verificar se a data da ação é igual à data atual (hoje)
        if (substr($row['timestamp'], 0, 10) === $dataAtual) {
            // Se sim, incrementar o contador de acessos de hoje
            $acessosHoje++;
        }

        // Obter o mês e o ano da ação
        $mesAcao = date("Y-m", strtotime($row['timestamp']));

        // Obter o mês e o ano atual
        $mesAtual = date("Y-m");

        // Verificar se a ação ocorreu no mês atual
        if ($mesAcao === $mesAtual) {
            // Se sim, incrementar o contador de acessos do mês
            $acessosMes++;
        }
    }

    // Fechar a conexão com o banco de dados
    $db->close();
} catch (Exception $e) {
    // Em caso de erro, exibir uma mensagem de erro
    print($e);
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Adicione os links para Vue.js e Bootstrap (ou outro framework de sua preferência) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    /* Estilos para o corpo da página */
    body {
        font-family: 'Roboto', sans-serif;
        color: #ffffff;
        margin: 0;
        padding: 0;
    }

    .theme-dark {
        background-color: #121212;
    }

    .card {
        background-color: #121212;
    }

    th, td {
        color: #fff;
    }

    /* Estilos para a navbar */
    .navbar {
        background-color: #212121 !important;
        border-bottom: 2px solid #fff;
    }

    /* Estilos para os links da navbar */
    .navbar-nav .nav-link {
        color: #ffffff !important;
        font-family: 'Open Sans', sans-serif;
    }

    .navbar-nav:hover .nav-link:hover {
        color: #ce62f7 !important;
        border-color: #ce62f7;
        border-radius: 10px;
        border: 1px solid #555;
        font-family: 'Open Sans', sans-serif;
    }

    .nav-link:active {
        color: #ce62f7 !important;
        border-color: #ce62f7;
        border-radius: 10px;
        border: 1px solid #555;
        background-color: #fff;
        font-family: 'Open Sans', sans-serif;
    }

    input[type=file] {
        color: #ce62f7 !important;
        border-color: #ce62f7;
        border-radius: 10px;
        border: 1px solid #555;
        font-family: 'Open Sans', sans-serif;
    }
    input[type=file]::file-selector-button {
  margin-right: 20px;
  border: none;
  background: #084cdf;
  padding: 10px 20px;
  border-radius: 10px;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
}

input[type=file]::file-selector-button:hover {
  background: #0d45a5;
}


    /* Estilos para o conteúdo */
    .container {
        background-color: #212121;
        border-radius: 10px;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
        padding: 20px;
        margin-top: 20px;
        justify-content: spac;
    }

    .btn-back {
    position: fixed;
    top: 20px;
    left: 20px;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border-radius: 50%;
    text-decoration: none;
    transition: background-color 0.3s;
    z-index: 999;
}

.btn-back:hover {
    background-color: #0056b3;
}

</style>


</head>

<body>
<a href="/" class="btn-back">&#8592;</a>
<div id="app" class="theme-dark">
    <!-- Navbar responsiva -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container d-flex">
        <a class="navbar-brand" href="/index.php">LIMA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item" @click="selectedOption = 'atividades'">
                    <a class="nav-link" href="#"><i class="fas fa-tasks"></i> Atividades</a>
                </li>
                <li class="nav-item" @click="selectedOption = 'conteudos'">
                    <a class="nav-link" href="#"><i class="fas fa-file-alt"></i> Conteúdos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <!-- Conteúdo dinâmico -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-lg p-4">
                    <div v-if="selectedOption === 'atividades'">
                        <h2 class="text-center mb-4">Atividades</h2>
                        <!-- Adicione as informações dinâmicas aqui -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card bg-info text-white p-3">
                                    <h5>Hoje</h5>
                                    <p>{{ acessosHoje }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card bg-success text-white p-3">
                                    <h5>Mês</h5>
                                    <p>{{ acessosMes }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card bg-danger text-white p-3">
                                    <h5>Total</h5>
                                    <p>{{ acessosTotal }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Opção de detalhes -->
                        <h3 class="mt-5 mb-3 text-center">Detalhes</h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>IP</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Verificar se existem detalhes das atividades -->
                                    <template v-if="atividadeDetalhes.length > 0">
                                        <!-- Preencha com os detalhes dinâmicos -->
                                        <tr v-for="detail in atividadeDetalhes">
                                            <td>{{ detail.timestamp }}</td>
                                            <td>{{ detail.ip }}</td>
                                            <td>{{ detail.action }}</td>
                                        </tr>
                                    </template>
                                    <!-- Se não houver detalhes das atividades, exibir uma mensagem -->
                                    <template v-else>
                                        <tr>
                                            <td colspan="3" class="text-center">Não há mais registros disponíveis.</td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        <!-- Navegação da página -->
                        <div class="text-center mt-4">
                            <!-- Representação da página atual -->
                            <p>Página: {{ paginaAtual }}</p>
                            <button class="btn btn-secondary" @click="paginaAnterior" v-show="paginaAtual > 1"><i class="fas fa-chevron-left"></i> Página Anterior</button>
                            <button class="btn btn-secondary" @click="proximaPagina">Próxima Página <i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>

                    <div v-else-if="selectedOption === 'conteudos'">
                        <h2 class="text-center mb-4">Conteúdos</h2>
                        <!-- Formulário para adicionar projetos -->
                        <form @submit.prevent="adicionarProjeto">
                            <div class="form-group">
                                <label for="titulo">Título:</label>
                                <input type="text" class="form-control" id="titulo" v-model="novoProjeto.titulo" required>
                            </div>
                            <div class="form-group">
                                <label for="sinopse">Sinopse:</label>
                                <input type="text" class="form-control" id="sinopse" v-model="novoProjeto.sinopse" required>
                            </div>
                            <div class="form-group">
                                <label for="descricao">Descrição:</label>
                                <textarea class="form-control" id="descricao" rows="3" v-model="novoProjeto.descricao" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="medias">Medias:</label>
                                <input class="custom-file-upload" type="file" id="medias" multiple @change="handleMediasUpload">
                            </div>
                            <button type="submit" class="btn btn-primary" :disabled="uploading">
                                <span v-if="uploading">Enviando <i class="fas fa-spinner fa-spin"></i></span>
                                <span v-else>Adicionar Projeto</span>
                            </button>
                        </form>
                    </div>

                    <div v-else-if="selectedOption === 'teste'">
                        <h2 class="text-center mb-4">Teste</h2>
                        <!-- Conteúdo do teste aqui -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- Adicione os scripts para Vue.js e Bootstrap (ou outro framework de sua preferência) -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js" integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        new Vue({
            el: '#app',
            data: {
                selectedOption: 'atividades',
                acessosHoje: '<?= $acessosHoje ?>',
                acessosMes: '<?= $acessosMes ?>',
                acessosTotal: '<?= $acessosTotal ?>',
                atividadeDetalhes: [],
                paginaAtual: 1,
                uploading: false,
                novoProjeto: {
                    titulo: '',
                    sinopse: '',
                    descricao: '',
                    medias: []
                }

            },
            methods: {
                carregarDetalhes() {
                    axios.get('/apis/get_regs.php', {
                            params: {
                                pagina: this.paginaAtual
                            }
                        })
                        .then(response => {
                            // Se a resposta contiver dados, atribua-os ao array de detalhes de atividades
                            this.atividadeDetalhes = response.data;
                        })
                        .catch(error => {
                            // Em caso de erro, exiba uma mensagem de erro usando SweetAlert2
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Ocorreu um erro ao carregar os detalhes das atividades!'
                            });
                        });
                },
                proximaPagina() {
                    // Função para avançar para a próxima página
                    this.paginaAtual++;
                    // Carregar os detalhes das atividades da próxima página
                    this.carregarDetalhes();
                },
                paginaAnterior() {
                    // Função para retroceder para a página anterior
                    if (this.paginaAtual > 1) {
                        this.paginaAtual--;
                        // Carregar os detalhes das atividades da página anterior
                        this.carregarDetalhes();
                    }
                },
                handleMediasUpload(event) {
                    const files = event.target.files;
                    for (let i = 0; i < files.length; i++) {
                        this.novoProjeto.medias.push(files[i]);
                    }
                },
                adicionarProjeto() {
                    // Criar um objeto FormData
                    let formData = new FormData();
                    let media_count = 0;

                    // Adicionar os campos de texto ao FormData
                    formData.append('titulo', this.novoProjeto.titulo);
                    formData.append('sinopse', this.novoProjeto.sinopse);
                    formData.append('descricao', this.novoProjeto.descricao);

                    // Adicionar as mídias ao FormData
                    for (let i = 0; i < this.novoProjeto.medias.length; i++) {
                        media_count++;
                        formData.append('medias[]', this.novoProjeto.medias[i]);
                    }

                    if (media_count > 0) {
                        this.uploading = true; // Define o estado de upload como verdadeiro
                    }

                    // Enviar os dados do novo projeto para o servidor
                    axios.post('/apis/add_new_project.php', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data' // Definir cabeçalho Content-Type como multipart/form-data
                            }
                        })
                        .then(response => {
                            this.uploading = false;
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso!',
                                text: response.data.message
                            });

                            // Reinicializar o objeto novoProjeto para limpar o formulário
                            this.novoProjeto = {
                                titulo: '',
                                sinopse: '',
                                descricao: '',
                                medias: []
                                // Reinicie os outros campos conforme necessário
                            };
                        })
                        .catch(error => {
                            // Em caso de erro, exibir uma mensagem de erro
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Ocorreu um erro ao adicionar o projeto!'
                            });
                        });
                }


            },
            created() {
                // Carregar os detalhes das atividades quando o componente for criado
                this.carregarDetalhes();
            }
        });
    </script>
</body>

</html>