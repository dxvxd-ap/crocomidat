<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}
include('conexion.php');

$pagina = isset($_GET['pag']) ? $_GET['pag'] : 1;
$id = isset($_GET['id']) ? $_GET['id'] : '';

$stmt = mysqli_prepare($conn, "DELETE FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: usuarios_tabla.php?pag=" . urlencode($pagina));
exit();
?>