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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="description" content="Portofolio do Desenvolvedor Kauã lima">
    <meta name="keywords" content="Desenvolvedor, Programador">
    <meta name="author" content="LIMA">


    <style>
        /* Estilos para os botões de próximo e anterior do Slick Carousel */
        .slick-controls {
            text-align: center;
            margin-top: 20px;
        }

        .slick-prev,
        .slick-next {
            background-color: #4a5568;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .slick-prev:hover,
        .slick-next:hover {
            background-color: #2d3748;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease-in-out, transform 0.8s ease-in-out;
        }

        .fade-in.active {
            opacity: 1;
            transform: translateY(0);
        }


        .shadow-hover:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }


        .shadow-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }


        .hover-scale:hover {
            transform: scale(1.05);
        }


        .rotate-icon:hover {
            transform: rotate(360deg);
            transition: transform 0.5s ease-in-out;
        }


        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }


        #typing-container {
            min-height: 6em;
            position: relative;
        }

        #typing-text {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            transition: opacity 0.8s ease-in-out;
        }


        .btn-link {
            display: inline-block;
            padding: 0.5rem 1rem;
            text-align: center;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(to right, #4a90e2, #8a2be2);
            border: 2px solid #4a90e2;
            border-radius: 0.375rem;
            transition: all 0.3s ease-in-out;
        }

        .btn-link:hover {
            background: linear-gradient(to right, #8a2be2, #4a90e2);
            border-color: #8a2be2;
            transform: scale(1.05);
        }


        @media (max-width: 767px) {
            .btn-link {
                width: 100%;
            }


        }

        .border-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
            border: 10px solid transparent;
            background-clip: padding-box;
            background-image: linear-gradient(to bottom right, #4a90e2, #8a2be2);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .border-gradient:hover::before {
            opacity: 1;
        }

        #project-popup .overflow-auto {
            max-height: 80vh;
            /* Ajuste conforme necessário */
        }

        #project-popup {
            transition: opacity 0.3s ease, visibility 0.3s ease;
            opacity: 0;
            visibility: hidden;
        }

        #project-popup.active {
            opacity: 1;
            visibility: visible;
        }



        .carousel .slick-prev,
        .carousel .slick-next {
            width: 100%;
        }
    </style>


    <title>LIMA - Portfólio</title>
</head>

<body class="bg-gray-900 text-white font-sans">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 fade-in shadow-card">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-semibold hover-scale rotate-icon">LIMA</div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="hero-section" class="bg-gradient-to-r from-blue-500 to-purple-600 text-center py-20 fade-in shadow-card parallax">
        <div class="container mx-auto">
            <div id="typing-container">
                <h1 id="typing-text" class="text-4xl font-bold mb-4"></h1>
            </div>
            <p class="text-lg mb-6">Desenvolvedor BackEnd Experiente, Brincando com FrontEnd</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#about-me" class="btn-link">Sobre mim</a>
                <a href="#technologies" class="btn-link">Tecnologias com Experiencia</a>
                <a href="#github-stats" class="btn-link">Estatísticas</a>
                <a href="#main-projects" class="btn-link">Projetos</a>
                <a href="#social-media" class="btn-link">Contatos</a>
                <a href="#social-media" class="btn-link">Minhas Redes</a>
            </div>

        </div>
    </header>


    <!-- About Me Section -->
    <section id="about-me" class="py-16 fade-in shadow-card">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold mb-8">Sobre Mim</h2>
            <div class="flex flex-col md:flex-row items-center md:items-start">
                <div class="md:w-1/2 mb-4 md:mb-0 relative overflow-hidden">
                    <div class="rounded-lg shadow-lg hover-scale border-gradient mx-auto md:mx-0">
                        <img src="images/logo.png" alt="LIMA" class="rounded-lg hover-scale">
                    </div>
                </div>
                <div class="md:w-1/2">
                    <p class="mb-4 text-lg">
                        Olá! Eu sou <strong>Kauã Lima</strong>, um entusiasta desenvolvedor backend que, ocasionalmente,
                        se aventura no mundo do frontend por diversão.
                    </p>
                    <p class="mb-4 text-lg">
                        Minha jornada no desenvolvimento de software é marcada por uma vasta experiência na criação de
                        sistemas eficientes para automatização de tarefas repetitivas, bem como soluções robustas para
                        gestão de vendas e processamento de pagamentos.
                    </p>
                    <p class="text-lg">
                        Minha abordagem é impulsionada pela combinação de habilidades técnicas sólidas e uma paixão pela
                        resolução de problemas. Com um histórico em sistemas de automação e expertise em backend, busco
                        criar soluções web intuitivas e atraentes que unam a eficiência funcional com uma experiência de
                        usuário envolvente.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <!-- Technologies Section-->
    <section id="technologies" class="py-16 bg-gradient-to-r from-purple-600 to-blue-500 text-white fade-in shadow-card">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-8">Skills</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="flex items-center hover-scale hover-bg-purple-700 hover-border-purple-300 transition-all duration-300 ease-in-out">
                    <i class="devicon-python-plain text-4xl mr-2"></i>
                    <a href="https://www.python.org/">Python</a>
                </div>
                <div class="flex items-center hover-scale hover-bg-purple-700 hover-border-purple-300 transition-all duration-300 ease-in-out">
                    <i class="devicon-php-plain text-4xl mr-2"></i>
                    <a href="https://www.php.net/">PHP</a>
                </div>
                <div class="flex items-center hover-scale hover-bg-purple-700 hover-border-purple-300 transition-all duration-300 ease-in-out">
                    <i class="devicon-javascript-plain text-4xl mr-2"></i>
                    <a href="https://developer.mozilla.org/en-US/docs/Web/javascript">JavaScript</a>
                </div>
                <div class="flex items-center hover-scale hover-bg-purple-700 hover-border-purple-300 transition-all duration-300 ease-in-out">
                    <i class="devicon-lua-plain text-4xl mr-2"></i>
                    <a href="https://www.lua.org/">Lua</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Projetos Principais -->
    <section id="main-projects" class="py-16 text-white fade-in shadow-card active">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-8">Principais Projetos</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ($row = $resultado->fetchArray(SQLITE3_ASSOC)) { ?>
                    <div class="p-4 bg-gray-800 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold mb-2"><?= $row['titulo'] ?></h3>
                        <p class="text-lg"><?= $row['sinopse'] ?></p>
                        <button class="btn-link mt-4" onclick='openProjectPopup("<?= $row["titulo"] ?>","<?= $row["descricao"] ?>", <?= $row["medias"] ?>)'>Saiba mais</button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Popup de Projeto -->

    <div id="project-popup" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-75 flex justify-center items-center z-50">
        <div class="bg-gray-800 p-6 rounded-lg max-w-lg w-full overflow-hidden">
            <div class="overflow-auto">
                <h2 id="project-title" class="text-2xl font-bold mb-4"></h2>
                <p id="project-description" class="mb-4"></p>
                <div id="project-carousel" class="carousel">

                </div>
            </div>
            <button id="close-popup" class="btn-link mt-4" onclick="closeProjectPopup()">Fechar</button>
        </div>
    </div>


    <!-- Social Media Section -->
    <section id="social-media" class="py-16 bg-gradient-to-r from-purple-600 to-blue-500 text-white fade-in shadow-card">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-8">Conecte-se comigo</h2>
            <div class="social-icons grid grid-cols-2 md:grid-cols-4 gap-8">
                <a href="https://github.com/Henrique3h0" class="flex items-center justify-center flex-col hover-scale shadow-hover">
                    <i class="fab fa-github text-4xl mb-2"></i>
                    <span>GitHub</span>
                </a>
                <a href="https://www.instagram.com/000_kaua000/" class="flex items-center justify-center flex-col hover-scale shadow-hover">
                    <i class="fab fa-instagram text-4xl mb-2"></i>
                    <span>Instagram</span>
                </a>
                <a href="./" class="flex items-center justify-center flex-col hover-scale shadow-hover">
                    <i class="fab fa-whatsapp text-4xl mb-2"></i>
                    <span>WhatsApp</span>
                </a>
                <a href="https://www.linkedin.com/in/kauã-lima-ba80912bb" class="flex items-center justify-center flex-col hover-scale shadow-hover">
                    <i class="fab fa-linkedin text-4xl mb-2"></i>
                    <span>LinkeDin</span>
                </a>
            </div>
        </div>
    </section>




    <!-- GitHub Stats Section -->
    <section id="github-stats" class="py-16 fade-in shadow-card">
        <div class="container mx-auto text-center grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <a href="https://github.com/Henrique3h0">
                <img class="mb-4 w-full" src="https://github-readme-stats.vercel.app/api?username=Henrique3h0&show_icons=true&theme=dracula&include_all_commits=true&count_private=true&locale=pt-br" alt="GitHub Stats" />
            </a>
            <a href="https://github.com/Henrique3h0">
                <img class="mb-4 w-full" src="https://github-readme-stats.vercel.app/api/top-langs/?username=Henrique3h0&layout=compact&langs_count=7&theme=dracula&locale=pt-br" alt="Top Languages" />
            </a>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white text-center py-4 fade-in shadow-card">
        <p>&copy; 2024 LIMA. Todos os direitos reservados.</p>
    </footer>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sections = document.querySelectorAll('.fade-in');
            var options = {
                root: null,
                rootMargin: '0px',
                threshold: 0.5
            };

            var observer = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            }, options);

            sections.forEach(function(section) {
                observer.observe(section);
            });
        });

        var typingText = document.getElementById('typing-text');
        var textArray = ["Olá, eu sou Kauã Lima.", "Desenvolvedor Backend.", "Apaixonado por programação."];
        var index = 0;
        var arrayIndex = 0;

        function type() {
            if (index < textArray[arrayIndex].length) {
                typingText.innerHTML += textArray[arrayIndex].charAt(index);
                index++;
                setTimeout(type, 100);
            } else {
                setTimeout(erase, 1500);
            }
        }

        function erase() {
            if (index > 0) {
                typingText.innerHTML = textArray[arrayIndex].substring(0, index - 1);
                index--;
                setTimeout(erase, 50);
            } else {
                arrayIndex = (arrayIndex + 1) % textArray.length;
                setTimeout(type, 500);
            }
        }

        window.onload = function() {
            type();
        };

        function openProjectPopup(title, description, list) {
            alert(list);
            var carouselContainer = document.getElementById('project-carousel');

            carouselContainer.innerHTML = '';

            // Converter lista de mídias para o formato desejado
            var media = list.map(function(item) {
                var type;
                // Identificar o tipo com base na extensão do arquivo
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
                    var img = document.createElement('img');
                    img.src = item.src;
                    carouselContainer.appendChild(img);
                } else if (item.type === 'video') {
                    var video = document.createElement('video');
                    video.src = item.src;
                    video.controls = true;
                    carouselContainer.appendChild(video);
                }
            });

            document.getElementById('project-title').innerText = title;
            document.getElementById('project-description').innerText = description;

            document.getElementById('project-popup').classList.remove('hidden');

            $('.carousel').slick({
                nextArrow: '<button class="slick-next" aria-label="Próxima Imagem" title="Próxima Imagem">➡️PROXIMO➡️</button>',
                prevArrow: '<button class="slick-prev" aria-label="Imagem anterior" title="Imagem anterior">⬅️ANTERIOR⬅️</button>',
                adaptiveHeight: true,
                autoPlay: true
            });

            document.getElementById('project-popup').classList.add('active');
        }




        function closeProjectPopup() {
            // Ocultar o popup
            $('.carousel').slick('unslick');
            document.getElementById('project-popup').classList.add('hidden');
        }

        $(document).ready(function() {
            $('a[href^="#"]').on('click', function(event) {
                event.preventDefault();

                var targetId = $(this).attr('href');
                var targetOffsetTop = $(targetId).offset().top;
                var duration = 2000; // Duração da animação em milissegundos

                $('html, body').animate({
                    scrollTop: targetOffsetTop
                }, duration);
            });
        });

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

        $(document).ready(function() {
            registrarAcao('acesso=Pagina Principal')
            $(document).on('click', '.slick-slide', function() {
                var imagem = $(this);
                if (!imagem.hasClass('zoomed')) {
                    var rect = imagem[0].getBoundingClientRect();
                    var mouseX = event.clientX - rect.left;
                    var mouseY = event.clientY - rect.top;

                    var percentX = mouseX / rect.width * 100;
                    var percentY = mouseY / rect.height * 100;

                    imagem.css({
                        'transform-origin': percentX + '% ' + percentY + '%',
                        'transform': 'scale(3)'
                    }).addClass('zoomed');
                } else {
                    imagem.css({
                        'transform': 'scale(1)'
                    }).removeClass('zoomed');
                }
            });
        });
    </script>

</body>

</html>