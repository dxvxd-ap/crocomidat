<?php
include('conexion.php');
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Soporte y Comentarios - Crocomidat</title>
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
        <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
        <link rel="icon" href="../img/logo.png" type="image/x-icon">
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
            .btn-logout-nav {
                background: #fee2e2;
                color: #dc2626 !important;
                font-weight: 600;
                border-radius: 10px;
                padding: 8px 18px;
                transition: all 0.2s ease;
                border: 1px solid rgba(220, 38, 38, 0.2);
            }
            .btn-logout-nav:hover {
                background: #dc2626;
                color: #ffffff !important;
                transform: translateY(-1px);
            }
            .soporte-card {
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 20px;
                padding: 36px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
                margin-top: 100px;
                margin-bottom: 50px;
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom">
                <div class="container">
                    <a href="index2.php" class="navbar-brand fw-bold fs-4" style="color: #0f172a;">
                        <img src="../img/logo.png" alt="Crocomidat Logo" width="38" height="38" class="d-inline-block align-text-top me-2" style="filter: drop-shadow(0 2px 4px rgba(101,163,13,0.3));">
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
                                <a href="index2.php" class="nav-link">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a href="index2.php#Locales" class="nav-link">Locales</a>
                            </li>
                            <li class="nav-item">
                                <a href="index2.php#conocenos" class="nav-link">Conócenos</a>
                            </li>
                            <li class="nav-item">
                                <a href="soporte.php" class="nav-link active" style="color: #65a30d !important; font-weight: 700;"><i class="bi bi-headset"></i> Soporte</a>
                            </li>
                            <li class="nav-item ms-lg-2">
                                <a href="cerrar_sesion.php" class="btn btn-logout-nav">
                                    <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="soporte-card">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4 pb-3 border-bottom">
                            <div>
                                <h1 class="fw-bold mb-1" style="font-size: 1.8rem; color: #0f172a;">
                                    <i class="bi bi-chat-heart" style="color: #65a30d;"></i> Comentarios y Soporte
                                </h1>
                                <p class="text-muted small m-0">Comparte tu opinión, sugerencia o experiencia sobre los locales</p>
                            </div>
                            <div>
                                <a href="comentarios_registrar.php" class="BotonesTeam5">
                                    <i class="bi bi-plus-circle-fill"></i> Agregar comentario
                                </a>
                            </div>
                        </div>

                        <?php
                        $filasmax = 7;
                        $pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
                        if ($pagina < 1) $pagina = 1;
                        $offset = ($pagina - 1) * $filasmax;

                        $sqlusu = mysqli_query($conn, "SELECT c.id_comment, c.creationdatecm, c.textcomment FROM comments c ORDER BY c.id_comment DESC LIMIT $offset, $filasmax");
                        $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_comments FROM comments");    
                        $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_comments'];
                        ?>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">Id</th>
                                        <th style="width: 150px;">Fecha</th>
                                        <th>Comentario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($sqlusu && mysqli_num_rows($sqlusu) > 0) {
                                    while ($mostrar = mysqli_fetch_assoc($sqlusu)) {
                                        echo "<tr>";
                                        echo "<td><strong style='color: #65a30d;'>#".htmlspecialchars($mostrar['id_comment'])."</strong></td>";
                                        echo "<td><i class='bi bi-calendar3' style='color: #64748b; margin-right: 6px;'></i><span style='color: #475569; font-size: 0.9rem;'>".htmlspecialchars($mostrar['creationdatecm'])."</span></td>";
                                        echo "<td><span style='color: #1e293b;'>".htmlspecialchars($mostrar['textcomment'])."</span></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3' class='text-center py-4 text-muted'>No hay comentarios registrados todavía. ¡Sé el primero en comentar!</td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <span class="text-muted small">Total de comentarios: <strong style="color: #65a30d;"><?php echo $maxusutabla; ?></strong></span>
                            <div>
                                <?php
                                if ($pagina > 1) {
                                    echo "<a class='BotonesTeam4' href='soporte.php?pag=".($pagina - 1)."'>Anterior</a> ";
                                } else {
                                    echo "<a class='BotonesTeam4' href='#' style='pointer-events: none; opacity: 0.5;'>Anterior</a> ";
                                }

                                if (($pagina * $filasmax) < $maxusutabla) {
                                    echo "<a class='BotonesTeam4' href='soporte.php?pag=".($pagina + 1)."'>Siguiente</a>";
                                } else {
                                    echo "<a class='BotonesTeam4' href='#' style='pointer-events: none; opacity: 0.5;'>Siguiente</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer style="background-color: #0f172a; color: #94a3b8; padding: 24px 0; text-align: center;">
            <div class="container">
                <p class="m-0" style="font-size: 0.95rem;">
                    &copy; <?php echo date('Y'); ?> <strong style="color: #84cc16;">Crocomidat</strong>. Todos los derechos reservados.
                </p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>