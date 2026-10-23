<?php
session_start();
include('../php/conexion.php');
if(isset($_SESSION['usuario']))
{
    header('Location: ./index2.php');
    exit();
}
?>

<!doctype html>
<html lang="es">
    <head>
        <title>Iniciar Sesión / Registro - Crocomidat</title>
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
        <link rel="stylesheet" href="../estilos/login.css?v=<?php echo time(); ?>">
        <link rel="icon" href="../img/logo.png" type="image/x-icon">
        <style>
            body {
                background: #f8fafc;
                font-family: 'Poppins', sans-serif;
                margin: 0;
                padding: 0;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
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
            }
            .navbar-custom .nav-link:hover {
                color: #65a30d !important;
            }
            .login-container {
                flex-grow: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 100px 20px 40px 20px;
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom">
                <div class="container">
                    <a href="../index.php" class="navbar-brand fw-bold fs-4" style="color: #0f172a;">
                        <img src="../img/logo.png" alt="Crocomidat Logo" width="38" height="38" class="d-inline-block align-text-top me-2" style="filter: drop-shadow(0 2px 4px rgba(101,163,13,0.3));">
                        <span style="color: #65a30d;">Croco</span>midat
                    </a>
                    <div class="ms-auto">
                        <a href="../index.php" class="btn btn-outline-secondary btn-sm" style="border-radius: 8px; font-weight: 500;">
                            <i class="bi bi-arrow-left"></i> Volver al Inicio
                        </a>
                    </div>
                </div>
            </nav>
        </header>
        
        <div class="login-container">
            <div class="main">
                <input type="checkbox" aria-hidden="true" id="chk">
                
                <!-- REGISTRO -->
                <div class="signup">
                    <form action="usuario_registrar.php" method="POST" id="formulario1">
                        <label for="chk" aria-hidden="true">Registrarse</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" required autocomplete="off">
                        <input type="email" name="email" id="email" placeholder="Correo electrónico" required autocomplete="off">
                        <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña segura" required autocomplete="off">
                        <button type="submit" name="Registrarse">Crear Cuenta</button>
                    </form>
                </div>

                <!-- LOGIN -->
                <div class="login">
                    <form method="post" id="formulario" action="usuario_login.php">
                        <label for="chk" aria-hidden="true">Iniciar Sesión</label>
                        <input type="email" name="email" id="email_login" placeholder="Correo electrónico" required autocomplete="off">
                        <input type="password" name="contraseña" id="contraseña_login" placeholder="Contraseña" required autocomplete="off">
                        <button type="submit" name="IniciarSesion" id="btnEnviar">Entrar</button>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>
