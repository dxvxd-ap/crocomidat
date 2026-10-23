<?php
include("conexion.php");
include("usuarios_tabla.php");
$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
$id = isset($_GET['id']) ? $_GET['id'] : '';

$stmt = mysqli_prepare($conn, "SELECT u.name, u.email, u.rol FROM users u WHERE u.email = ?");
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$querybuscar = mysqli_stmt_get_result($stmt);

$proid = '';
$pronom = '';
$procat = '';

if ($mostrar = mysqli_fetch_array($querybuscar)) {
    $proid = $mostrar['name'];
    $pronom = $mostrar['email'];
    $procat = ($mostrar['rol'] == '1') ? 'Administrador' : 'Usuario Normal';
}
mysqli_stmt_close($stmt);
?>

<html>
<body>
    <div class="caja_popup2">
        <form class="contenedor_popup" method="POST">
            <table>
                <tr><th colspan="2"><i class="bi bi-person-badge" style="color: var(--primary-lime);"></i> Detalles del Usuario</th></tr>
                <tr>
                    <td style="width: 35%;"><b>Nombre:</b></td>
                    <td><?php echo htmlspecialchars($proid);?></td>
                </tr>
                <tr>
                    <td><b>Correo:</b></td>
                    <td><?php echo htmlspecialchars($pronom);?></td>
                </tr>
                <tr>
                    <td><b>Rol:</b></td>
                    <td><span style="background: #ecfccb; color: #365314; padding: 4px 10px; border-radius: 6px; font-weight: 600; font-size: 0.88rem;"><?php echo htmlspecialchars($procat);?></span></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top: 20px;">
                        <div class="actions-row" style="justify-content: center;">
                            <?php echo "<a class='BotonesTeam' style='width: 100%; text-align: center;' href=\"usuarios_tabla.php?pag=$pagina\"><i class=\"bi bi-arrow-left\"></i> Volver a la lista</a>";?>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>