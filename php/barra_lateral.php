<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('conexion.php');
$archivo_actual = basename($_SERVER['PHP_SELF']);
?>
<div class="BarraLateral">
    <div class="logo-box">
        <a href="locales_tabla.php" style="text-decoration: none;">
            <img src="../img/logo.png" alt="Crocomidat Logo" style="width: 85px; height: auto; max-width: 100%; display: block; margin: 0 auto; filter: drop-shadow(0 4px 12px rgba(132, 204, 22, 0.4));">
            <p style="color: #0f172a; margin: 10px 0 0 0; font-size: 1.25rem; font-weight: 800;"><span style="color: #65a30d;">Croco</span>midat</p>
        </a>
    </div>
    <ul>
        <li class="<?php echo (strpos($archivo_actual, 'locales') !== false) ? 'active' : ''; ?>">
            <a href="locales_tabla.php"><i class="bi bi-shop"></i> Locales</a>
        </li>
        <li class="<?php echo (strpos($archivo_actual, 'comentarios') !== false) ? 'active' : ''; ?>">
            <a href="comentarios_tabla.php"><i class="bi bi-chat-quote"></i> Comentarios</a>
        </li>
        <li class="<?php echo (strpos($archivo_actual, 'usuarios') !== false) ? 'active' : ''; ?>">
            <a href="usuarios_tabla.php"><i class="bi bi-people"></i> Usuarios</a>
        </li>
        <li class="logout">
            <a href="cerrar_sesion.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
        </li>
    </ul>
</div>