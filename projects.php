<?php
$db = new SQLite3('DBs/database.limadb');
if(!$db) {
    echo $db->lastErrorMsg();
    exit;
}

$query = "SELECT * FROM 'projetos'";

$resultado = $db->query($query);

if(!$resultado) {
    echo "Erro ao executar a consulta.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">

    <?php while($row = $resultado->fetchArray(SQLITE3_ASSOC)) { ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['titulo']; ?></h5>
                    <p class="card-text"><?php echo $row['sinopse']; ?></p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projetoModal<?php echo $row['id']; ?>">
                        Detalhes
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="projetoModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="projetoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="projetoModalLabel"><?php echo $row['titulo']; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $row['descricao']; ?></p>
                        <!-- Aqui você pode adicionar o carrossel de imagens/vídeos usando um framework como Bootstrap Carousel ou Owl Carousel -->
                        <!-- Exemplo de carrossel de imagens usando Bootstrap Carousel -->
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                    $medias = json_decode($row['medias']);
                                    foreach($medias as $media) {
                                ?>
                                <div class="carousel-item <?php echo $media == $medias[0] ? 'active' : ''; ?>">
                                    <img src="/projects/<?php echo $media; ?>" class="d-block w-100" alt="...">
                                </div>
                                <?php } ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    </div>
</div>

<!-- Bootstrap JS e dependências -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$db->close();
?>
