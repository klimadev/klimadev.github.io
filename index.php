<?php
$db = new SQLite3('DBs/database.limadb');
if (!$db) {
    echo $db->lastErrorMsg();
    exit;
}

$query = "SELECT * FROM 'projetos'";

$resultado = $db->query($query);

if (!$resultado) {
    echo "Erro ao executar a consulta.";
    exit;
}

$isadm = false;

function descriptografarBase64($texto)
{
    return base64_decode($texto);
}

if (isset($_COOKIE['uwu'])) {
    $valorCookie = $_COOKIE['uwu'];

    $textoDescriptografado = descriptografarBase64($valorCookie);

    $conteudoArquivo = descriptografarBase64(file_get_contents("adm/123_5.6A9bZd-xYqP2.c3nW8L4rTgVfS7hN1mD0"));

    if ($textoDescriptografado === $conteudoArquivo) {
        $isadm = true;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/devicon@2.15.1/devicon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="index.css" />
</head>

<body>

    <!-- Hero Section -->
    <section id="hero-section">
        <div class="container">
            <div id="type-container">
                <h1><span id="type"></span></h1>
            </div>
            <p>Web Systems Developer</p>

            <div>
                <a href="#about-me" class="btn btn-primary btn-lg sensible_card"><i class="fas fa-user"></i> Sobre mim</a>
                <a href="#skills" class="btn btn-primary btn-lg sensible_card"><i class="fas fa-code"></i> Habilidades</a>
                <a href="#projects" class="btn btn-primary btn-lg sensible_card"><i class="fas fa-laptop-code"></i> Projetos</a>
                <a href="#contact" class="btn btn-primary btn-lg sensible_card"><i class="fas fa-envelope"></i> Contato</a>
                <?php if ($isadm) : ?>
                    <a href="/adm/" class="btn btn-primary btn-lg sensible_card"><i class="fas fa-gears"></i> ADM</a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- About Me Section -->
    <section id="about-me">
        <div class="container">
            <h2>SOBRE MIN</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <img src="images/logo.png" alt="Perfil" class="img-fluid rounded-circle mb-4 sensible_card">
                    <p>Olá! Eu sou <strong>Kauã Lima</strong>, um entusiasta desenvolvedor fullstack, formado em Web Systems Development (wsd ou spi)</p>
                    <p>Minha jornada no desenvolvimento de software é marcada por uma vasta experiência na
                        criação de sistemas eficientes para automatização de tarefas, bem como soluções
                        robustas para gestão de vendas, processamento de pagamentos centralizados ou descentralizados e gerenciamento de BigData.</p>
                    <p>Minha abordagem é impulsionada pela combinação de habilidades técnicas sólidas e
                        uma paixão pela resolução de problemas. Com um histórico em sistemas de automação e expertise
                        em backend, busco criar soluções web intuitivas e atraentes que unam a eficiência funcional
                        com uma experiência de usuário envolvente.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Habilidades -->
    <section id="skills">
        <div class="container">
            <h2 class="mb-4">HABILIDADES</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="skill-container sensible_card">
                        <h3 class="mb-3">Frontend</h3>
                        <ul class="list-unstyled">
                            <li><i class="devicon-html5-plain"></i> HTML5</li>
                            <li><i class="devicon-css3-plain"></i> CSS3</li>
                            <li><i class="devicon-javascript-plain"></i> JavaScript</li>
                            <li><i class="devicon-bootstrap-plain"></i> Bootstrap</li>
                            <li><i class="devicon-vuejs-plain"></i> Vue.js</li>
                            <li><i class="devicon-tailwindcss-plain"></i> Tailwind CSS</li>
                        </ul>
                    </div>
                    <div class="skill-container sensible_card">
                        <h3 class="mb-3">Backend</h3>
                        <ul class="list-unstyled">
                            <li><i class="devicon-nodejs-plain"></i> Node.js</li>
                            <li><i class="devicon-python-plain"></i> Python</li>
                            <li><i class="devicon-php-plain"></i> PHP</li>
                            <li><i class="devicon-django-plain"></i> Django</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="skill-container sensible_card">
                        <h3 class="mb-3">DataBases</h3>
                        <ul class="list-unstyled">
                            <li><i class="devicon-mysql-plain"></i> MySQL</li>
                            <li><i class="devicon-mongodb-plain"></i> MongoDB</li>
                            <li><i class="devicon-postgresql-plain"></i> PostgreSQL</li>
                            <li><i class="devicon-sqlite-plain"></i> SQLite</li>
                        </ul>
                    </div>
                    <div class="skill-container sensible_card">
                        <h3 class="mb-3">APIs</h3>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-code"></i> XML</li>
                            <li><i class="fas fa-code"></i> JSON</li>
                            <li><i class="fas fa-code"></i> REST</li>
                            <li><i class="fas fa-code"></i> APIs Bancárias</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects">
        <h2>PROJECTS</h2>

        <!-- Barra de Pesquisa -->
        <div class="container mb-4">
            <input type="text" id="searchInput" class="form-control" placeholder="Pesquisar...">
        </div>

        <div class="container bg-dark" style="height: 400px; overflow-y: auto;">
            <div class="container" id="projectContainer">
                <div class="row">
                    <?php while ($row = $resultado->fetchArray(SQLITE3_ASSOC)) { ?>
                        <div class="col-md-4 mb-4 projectCard">
                            <div class="card sensible_card">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title"><?= $row['titulo'] ?></h5>
                                        <p class="card-text"><?= $row['sinopse'] ?></p>
                                    </div>
                                    <div>
                                        <a href="#" class="btn btn-primary mt-auto" onclick='openProjectPopup("<?= $row["titulo"] ?>","<?= $row["descricao"] ?>", <?= $row["medias"] ?>)'><i class="fas fa-info-circle"></i> Detalhes</a>
                                        <?php if ($isadm) : ?>
                                            <a href="#" class="btn btn-warning mt-auto" onclick='delete_project(<?= $row["id"] ?>)'><i class="fas fa-x"></i> Deletar</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>


    <!-- Projects popup -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span onclick="closeProjectPopup()" class="close" id="closePopupBtn">&times;</span>
            <h2 id="project-title">Título do Popup</h2>
            <p id="project-description">Descrição do Popup</p>
            <div id="project-carousel" class="carousel">
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <h2>CONTATO</h2>
            <p>Entre em contato comigo para discutir seus projetos ou ideias.</p>
            <a onclick="registrarAcao('email')" href="mailto:devhenrike@gmail.com" class="btn btn-primary btn-lg"><i class="fas fa-envelope"></i> Enviar Email</a>
        </div>
    </section>

    <footer id="footer">
        <div class="container">
            <div class="social-icons">
                <a onclick="registrarAcao('instagram')" href="https://www.instagram.com/000_kaua000/" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a onclick="registrarAcao('linkedin')" href="https://www.linkedin.com/in/kau%C3%A3-lima-ba80912bb/" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                <a onclick="registrarAcao('email')" href="mailto:devhenrike@gmail.com" class="social-icon"><i class="fas fa-envelope"></i></a>
            </div>
            <code>Made with 💟 by <a href="#">Lima</a></code>
        </div>
    </footer>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.4/howler.min.js" integrity="sha512-xi/RZRIF/S0hJ+yJJYuZ5yk6/8pCiRlEXZzoguSMl+vk2i3m6UjUO/WcZ11blRL/O+rnj94JRGwt/CHbc9+6EA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#popup').hide();

        function openProjectPopup(title, description, list) {
            var carouselContainer = $('#project-carousel');
            carouselContainer.empty();

            var media = list.map(function(item) {
                var type;
                var extension = item.split('.').pop().toLowerCase();
                if (extension === 'jpg' || extension === 'jpeg' || extension === 'png' || extension === 'gif') {
                    type = 'image';
                } else if (extension === 'mp4' || extension === 'webm' || extension === 'avi') {
                    type = 'video';
                }
                return {
                    type: type,
                    src: item
                };
            });

            media.forEach(function(item) {
                if (item.type === 'image') {
                    $('<img>').attr('src', item.src).appendTo(carouselContainer);
                } else if (item.type === 'video') {
                    $('<video>').attr({
                        src: item.src,
                        controls: true
                    }).appendTo(carouselContainer);
                }
            });

            $('#project-title').text(title);
            $('#project-description').text(description);

            $('#popup').show();

            $('.carousel').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true
            });
        }

        function closeProjectPopup() {
            $('.carousel').slick('unslick');
            $('#popup').hide();
        }

        function registrarAcao(action) {
            $.ajax({
                type: "POST",
                url: "/apis/reg_ac.php",
                data: {
                    action: action
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error("Erro ao registrar ação:", error);
                }
            });
        }

        function delete_project(id) {
            var confirmacao = confirm("Tem certeza que deseja deletar este projeto?");

            if (confirmacao) {
                fetch('/apis/delete_project.php/' + id, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            alert("Projeto deletado com sucesso!");
                            location.reload();
                        } else {
                            alert("Erro ao deletar o projeto!");
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        alert("Erro ao deletar o projeto!");
                    });
            }
        }

        $(document).ready(function() {
            registrarAcao('acesso=index');
            $(window).scroll(function() {
                var elemento = $('.sensible_card');
                var posicaoTop = elemento.offset().top;


                if (posicaoTop < $(window).scrollTop() + $(window).height() * 0.75) {
                    elemento.addClass('sensible_card-active');

                    setTimeout(function() {
                        elemento.removeClass('sensible_card-active');
                    }, 400);
                }
            });

            var textos = ["HI, I'M KAUÃ LIMA", "WEB SYSTEMS DEVELOPER", "API DEVELOPER", "+4 YEARS"];
            var indice = 0;
            var elemento = $('#type');
            var intervalo;

            function digitarTexto() {
                var textoAtual = textos[indice];
                var textoExibido = "";
                var contador = 0;

                intervalo = setInterval(function() {
                    if (contador < textoAtual.length) {
                        textoExibido += textoAtual[contador];
                        elemento.text(textoExibido);
                        contador++;
                    } else {
                        clearInterval(intervalo);
                        setTimeout(function() {
                            apagarTexto();
                        }, 1000);
                    }
                }, 100);
            }

            function apagarTexto() {
                var textoAtual = elemento.text();
                var contador = textoAtual.length;

                intervalo = setInterval(function() {
                    if (contador > 0) {
                        elemento.text(textoAtual.slice(0, contador - 1));
                        contador--;
                    } else {
                        clearInterval(intervalo);
                        setTimeout(function() {
                            proximoTexto();
                        }, 500);
                    }
                }, 50);
            }

            function proximoTexto() {
                indice = (indice + 1) % textos.length;
                digitarTexto();
            }

            digitarTexto();

            $('#searchInput').keyup(function(){
            var searchText = $(this).val().toLowerCase();
            $('.projectCard').each(function(){
                var title = $(this).find('.card-title').text().toLowerCase();
                var sinopse = $(this).find('.card-text').text().toLowerCase();
                if(title.includes(searchText) || sinopse.includes(searchText)){
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        });
    </script>

</body>

</html>