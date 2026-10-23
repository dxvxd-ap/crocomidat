<?php
include("conexion.php");
include("usuarios_tabla.php");


$pagina = isset($_GET['pag']) ? $_GET['pag'] : 1;
$id = isset($_GET['id']) ? $_GET['id'] : '';

$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$querybuscar = mysqli_stmt_get_result($stmt);

$proid  = '';
$pronom = '';
$propre = '';
$procat = '';

if ($mostrar = mysqli_fetch_array($querybuscar))
{  
   $proid  = $mostrar['email'];
   $pronom = $mostrar['name'];
   $propre = $mostrar['psswd'];
   $procat = $mostrar['rol'];
}
mysqli_stmt_close($stmt);
?>
<html>
<body>
<div class="caja_popup2">
<form class="contenedor_popup" method="POST">
<table>
<tr><th colspan="2"><i class="bi bi-person-gear" style="color: var(--primary-lime);"></i> Modificar Usuario</th></tr>   
<tr>
<td style="width: 30%;"><b>Email:</b></td>
<td><input class="CajaTexto" type="text" name="txtid" value="<?php echo htmlspecialchars($proid);?>" readonly style="opacity: 0.6; cursor: not-allowed;"></td>
</tr>
<tr>
<td><b>Nombre:</b></td>
<td><input class="CajaTexto" type="text" name="txtnom" value="<?php echo htmlspecialchars($pronom);?>" required></td>
</tr>
<tr>
<td><b>Contraseña:</b></td>
<td><input class="CajaTexto" type="password" name="txtpre" placeholder="Nueva contraseña (dejar vacía para no cambiar)"></td>
</tr>
<tr>
<td><b>Rol:</b></td>
<td>
    <select name="txtcat" class="SelectModerno">
        <option value="0" <?php echo ($procat == '0' || $procat === null) ? 'selected' : ''; ?>>Usuario Normal</option>
        <option value="1" <?php echo ($procat == '1') ? 'selected' : ''; ?>>Administrador</option>
    </select>
</td>
</tr>
<tr>
<td colspan="2" >
    <div class="actions-row">
        <?php echo "<a class='btn-cancelar' href=\"usuarios_tabla.php?pag=$pagina\">Cancelar</a>";?>
        <button class='BotonesTeam' type="submit" name="btnregistrar">
            <i class="bi bi-save2-fill"></i> Guardar Cambios
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
  
if(isset($_POST['btnregistrar']))
{   
    $proid1  = isset($_POST['txtid']) ? trim($_POST['txtid']) : '';
    $pronom1 = isset($_POST['txtnom']) ? trim($_POST['txtnom']) : '';
    $propre1 = isset($_POST['txtpre']) ? $_POST['txtpre'] : '';
    $procat1 = isset($_POST['txtcat']) ? trim($_POST['txtcat']) : '';

    if (!empty($propre1)) {
        $pass_hash = password_hash($propre1, PASSWORD_BCRYPT);
        $stmt_update = mysqli_prepare($conn, "UPDATE users SET name = ?, psswd = ?, rol = ? WHERE email = ?");
        mysqli_stmt_bind_param($stmt_update, "ssss", $pronom1, $pass_hash, $procat1, $proid1);
    } else {
        $stmt_update = mysqli_prepare($conn, "UPDATE users SET name = ?, rol = ? WHERE email = ?");
        mysqli_stmt_bind_param($stmt_update, "sss", $pronom1, $procat1, $proid1);
    }
    mysqli_stmt_execute($stmt_update);
    mysqli_stmt_close($stmt_update);

    echo "<script>window.location= 'usuarios_tabla.php?pag=$pagina' </script>";
}
?>
