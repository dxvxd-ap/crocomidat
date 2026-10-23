<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('./conexion.php');

$correo = isset($_POST["email"]) ? trim($_POST["email"]) : '';
$pass = isset($_POST["contraseña"]) ? $_POST["contraseña"] : '';

$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $correo);
mysqli_stmt_execute($stmt);
$buscandousu = mysqli_stmt_get_result($stmt);

$mostrar = mysqli_fetch_array($buscandousu);

if ($mostrar && password_verify($pass, $mostrar['psswd'])) {
    $_SESSION['usuario'] = $mostrar['email'];
    $_SESSION['name'] = $mostrar['name'];
    $_SESSION['rol'] = $mostrar['rol'];

    //VALIDAR
    if ($mostrar['rol'] == 1) {
        //administrador
        header("location:./locales_tabla.php");
        exit();
    } else {
        //Usuario Normal
        header("location: ./index2.php");
        exit();
    }
} else {
    echo "<script> alert('Usuario o contraseña incorrectos');window.location= '../index.php'</script>";
}
mysqli_stmt_close($stmt);
?>
