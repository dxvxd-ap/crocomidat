<?php
include('./php/conexion.php');
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Crocomidat - Descubre la Gastronomía Local</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="./estilos/style.css?v=<?php echo time(); ?>">
        <link rel="icon" href="./img/logo.png" type="image/x-icon">
        <style>
            body {
                background-color: #f8fafc;
                color: #1e293b;
                font-family: 'Poppins', sans-serif;
            }
            .navbar-custom {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
                border-bottom: 1px solid #e2e8f0;
                transition: all 0.3s ease;
            }
            .navbar-custom .nav-link {
                color: #334155 !important;
                font-weight: 500;
                padding: 8px 16px;
                border-radius: 8px;
                transition: all 0.2s ease;
            }
            .navbar-custom .nav-link:hover {
                color: #65a30d !important;
                background: #f1f5f9;
            }
            .btn-login-nav {
                background: #65a30d;
                color: #ffffff !important;
                font-weight: 600;
                border-radius: 10px;
                padding: 8px 18px;
                box-shadow: 0 2px 8px rgba(101, 163, 13, 0.25);
                transition: all 0.2s ease;
            }
            .btn-login-nav:hover {
                background: #4d7c0f;
                box-shadow: 0 4px 12px rgba(101, 163, 13, 0.35);
                transform: translateY(-1px);
            }
            .local-card {
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 18px;
                overflow: hidden;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
                transition: transform 0.25s ease, box-shadow 0.25s ease;
                height: 100%;
                display: flex;
                flex-direction: column;
            }
            .local-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
                border-color: #cbd5e1;
            }
            .local-card img {
                height: 220px;
                width: 100%;
                object-fit: cover;
                border-bottom: 1px solid #f1f5f9;
            }
            .local-card-body {
                padding: 24px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                flex-grow: 1;
                text-align: center;
            }
            .section-badge {
                display: inline-block;
                background: #ecfccb;
                color: #365314;
                font-weight: 700;
                font-size: 0.85rem;
                padding: 6px 14px;
                border-radius: 30px;
                margin-bottom: 12px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }
            .about-box {
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 20px;
                padding: 48px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom">
                <div class="container">
                    <a href="index.php" class="navbar-brand fw-bold fs-4" style="color: #0f172a;">
                        <img src="./img/logo.png" alt="Crocomidat Logo" width="38" height="38" class="d-inline-block align-text-top me-2" style="filter: drop-shadow(0 2px 4px rgba(101,163,13,0.3));">
                        <span style="color: #65a30d;">Croco</span>midat
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar-start" aria-controls="navbar-start" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbar-start">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center gap-2">
                            <li class="nav-item">
                                <a href="index.php" class="nav-link">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a href="#Locales" class="nav-link">Locales</a>
                            </li>
                            <li class="nav-item">
                                <a href="#conocenos" class="nav-link">Conócenos</a>
                            </li>
                            <li class="nav-item ms-lg-2">
                                <a href="./php/login.php" class="btn btn-login-nav">
                                    <i class="bi bi-person-fill"></i> Iniciar Sesión / Registro
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- CARRUSEL HERO -->
        <div id="carouselE1" class="carousel slide" data-bs-ride="carousel" style="margin-top: 72px;">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselE1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselE1" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselE1" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/pexels/pexels-chanwalrus-958545.jpg" class="d-block w-100" style="height: 480px; object-fit: cover;" alt="Gastronomía">
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="bottom: 0;">
                        <h1 class="fw-bold" style="font-size: 2.8rem; text-shadow: 0 4px 16px rgba(0,0,0,0.7);">¡Prueba lo desconocido en Gutiérrez Zamora!</h1>
                        <p class="fs-5" style="text-shadow: 0 2px 8px rgba(0,0,0,0.8);">Sabores tradicionales y auténticos que te van a encantar.</p>
                    </div>
                </div>
            
                <div class="carousel-item">
                    <img src="./img/pexels/pexels-chanwalrus-941861.jpg" class="d-block w-100" style="height: 480px; object-fit: cover;" alt="Platillos deliciosos">
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="bottom: 0;">
                        <h1 class="fw-bold" style="font-size: 2.8rem; text-shadow: 0 4px 16px rgba(0,0,0,0.7);">Busca y encuentra delicias escondidas</h1>
                        <p class="fs-5" style="text-shadow: 0 2px 8px rgba(0,0,0,0.8);">Los mejores rincones culinarios al alcance de un clic.</p>
                    </div>
                </div>
                
                <div class="carousel-item">
                    <img src="./img/pexels/pexels-pixabay-260922.jpg" class="d-block w-100" style="height: 480px; object-fit: cover;" alt="Experiencia gourmet">
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="bottom: 0;">
                        <h1 class="fw-bold" style="font-size: 2.8rem; text-shadow: 0 4px 16px rgba(0,0,0,0.7);">Deja que tu paladar se aventure</h1>
                        <p class="fs-5" style="text-shadow: 0 2px 8px rgba(0,0,0,0.8);">Apoya el comercio local y vive momentos memorables.</p>
                    </div>
                </div>
            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselE1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselE1" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- LOCALES DE COMIDA -->
        <section class="py-5" id="Locales" style="background-color: #f8fafc;">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <span class="section-badge"><i class="bi bi-shop"></i> Gastronomía Local</span>
                    <h2 class="fw-bold" style="font-size: 2.4rem; color: #0f172a;">
                        <span style="color: #65a30d;">LOCALES</span> DE COMIDA
                    </h2>
                    <p class="text-muted" style="font-size: 1.05rem;">Descubre la comida más representativa y deliciosa de Gutiérrez Zamora</p>
                </div>
                
                <div class="row g-4">
                <?php
                $filasmax = 12;
                $pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
                if ($pagina < 1) $pagina = 1;
                $offset = ($pagina - 1) * $filasmax;

                $sqlusu = mysqli_query($conn, "SELECT loc.id_fp, loc.name, loc.location, loc.schedule, loc.bg FROM food_place loc ORDER BY loc.id_fp ASC LIMIT $offset, $filasmax");
                
                if ($sqlusu && mysqli_num_rows($sqlusu) > 0) {
                    while ($mostrar = mysqli_fetch_assoc($sqlusu)) {
                        $foto = !empty($mostrar['bg']) ? $mostrar['bg'] : 'restaurant.jpg';
                        echo "<div class='col-12 col-md-6 col-lg-4'>";
                        echo "  <div class='local-card'>";
                        echo "    <img src='./img/locales-z/".htmlspecialchars($foto)."' alt='".htmlspecialchars($mostrar['name'])."' onerror=\"this.src='./img/logo.png'\">";
                        echo "    <div class='local-card-body'>";
                        echo "        <h4 class='fw-bold mb-2' style='color: #0f172a; font-size: 1.3rem;'>".htmlspecialchars($mostrar['name'])."</h4>";
                        echo "        <p class='mb-2 small' style='color: #475569;'><i class='bi bi-geo-alt-fill' style='color: #65a30d; margin-right: 4px;'></i> ".htmlspecialchars($mostrar['location'])."</p>";
                        echo "        <p class='mb-0 small' style='color: #64748b;'><i class='bi bi-clock-fill' style='color: #94a3b8; margin-right: 4px;'></i> ".htmlspecialchars($mostrar['schedule'])."</p>";
                        echo "    </div>";
                        echo "  </div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='col-12 text-center text-muted py-5'>No hay locales registrados por el momento.</div>";
                }
                ?>
                </div>
            </div>
        </section>

        <!-- ACERCA DE NOSOTROS -->
        <section class="py-5" id="conocenos" style="background-color: #f1f5f9; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="about-box text-center">
                            <span class="section-badge"><i class="bi bi-info-circle-fill"></i> Nuestra Misión</span>
                            <h2 class="fw-bold mb-4" style="color: #0f172a; font-size: 2.2rem;">
                                ACERCA DE <span style="color: #65a30d;">NOSOTROS</span>
                            </h2>
                            <p style="text-align: justify; color: #334155; font-size: 1.05rem; line-height: 1.8;">
                                En <strong>CROCOMIDAT</strong>, somos un equipo apasionado de la Universidad Tecnológica de Gutiérrez Zamora dedicado a transformar la forma en que descubres la gastronomía local. Nuestra misión es poner en el mapa esos locales de comida que ofrecen experiencias culinarias únicas, llenas de tradición y sabor.
                            </p>
                            <p style="text-align: justify; color: #334155; font-size: 1.05rem; line-height: 1.8;">
                                Gutiérrez Zamora es conocido como un punto de paso para muchos, pero nosotros creemos que tiene mucho más que ofrecer. Revelamos los sabores auténticos y originales que enriquecen nuestra cultura y apoyamos directamente el comercio local.
                            </p>
                            <div class="mt-4">
                                <img src="img/logo.png" alt="Crocomidat Logo" width="85" style="filter: drop-shadow(0 4px 8px rgba(101,163,13,0.3));">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER ELEGANTE Y MODERNO -->
        <footer style="background-color: #0f172a; color: #94a3b8; padding: 28px 0; text-align: center;">
            <div class="container">
                <p class="m-0" style="font-size: 0.95rem;">
                    &copy; <?php echo date('Y'); ?> <strong style="color: #84cc16;">Crocomidat</strong>. Todos los derechos reservados.
                </p>
            </div>
        </footer>

        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
