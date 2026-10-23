<?php
include("conexion.php");
include("usuarios_tabla.php");
$pagina = isset($_GET['pag']) ? $_GET['pag'] : 1;
?>
<html>
    <body>
        <div class="caja_popup2">
            <form class="contenedor_popup" method="POST">
                <table>
                    <tr><th colspan="2"><i class="bi bi-person-plus-fill" style="color: var(--primary-lime);"></i> Agregar Nuevo Usuario</th></tr>
                    <tr>
                        <td style="width: 30%;"><b>Nombre:</b></td>
                        <td><input type="text" name="txtnom" placeholder="Nombre completo" autocomplete="off" class="CajaTexto" required></td>
                    </tr>
                    <tr>
                        <td><b>Correo:</b></td>
                        <td><input type="email" name="txtpre" placeholder="correo@ejemplo.com" autocomplete="off" class="CajaTexto" required></td>
                    </tr>
                    <tr>
                        <td><b>Contraseña:</b></td>
                        <td><input type="password" name="txtcat" placeholder="Contraseña segura" autocomplete="off" class="CajaTexto" required></td>
                    </tr>
                    <tr>
                        <td><b>Rol:</b></td>
                        <td>
                            <select name="txtrol" class="SelectModerno">
                                <option value="0">Usuario Normal</option>
                                <option value="1">Administrador</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="actions-row">
                                <?php echo "<a class='btn-cancelar' href=\"usuarios_tabla.php?pag=$pagina\">Cancelar</a>";?>
                                <button type="submit" class="BotonesTeam" name="btnregistrar">
                                    <i class="bi bi-check-circle-fill"></i> Registrar Usuario
                                </button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>

<?php
if(isset($_POST['btnregistrar'])){
    $pronom = isset($_POST['txtnom']) ? trim($_POST['txtnom']) : '';
    $propre = isset($_POST['txtpre']) ? trim($_POST['txtpre']) : '';
    $procat = isset($_POST['txtcat']) ? $_POST['txtcat'] : '';
    $prorol = isset($_POST['txtrol']) ? trim($_POST['txtrol']) : '';

    $pass_hash = password_hash($procat, PASSWORD_BCRYPT);

    $stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, psswd, rol) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $pronom, $propre, $pass_hash, $prorol);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo "<script>window.location= 'usuarios_tabla.php'</script>";
}
?>

