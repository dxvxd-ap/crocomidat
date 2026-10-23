<?php
include("conexion.php");
include("comentarios_tabla.php");

$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
$id = isset($_GET['id']) ? $_GET['id'] : '';

$stmt = mysqli_prepare($conn, "SELECT id_comment, creationdatecm, textcomment FROM comments WHERE id_comment = ?");
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$querybuscar = mysqli_stmt_get_result($stmt);

$proid = '';
$pronom = '';
$propre = '';

if ($mostrar = mysqli_fetch_array($querybuscar)) {  
    $proid  = $mostrar['id_comment'];
    $pronom = $mostrar['creationdatecm'];
    $propre = $mostrar['textcomment'];
}
mysqli_stmt_close($stmt);
?>
<html>
<body>
<div class="caja_popup2">
<form class="contenedor_popup" method="POST">
<table>
<tr><th colspan="2"><i class="bi bi-pencil-square" style="color: var(--primary-lime);"></i> Modificar Comentario</th></tr>   
<tr>
<td style="width: 30%;"><b>ID: </b></td>
<td><input class="CajaTexto" type="text" name="txtid" value="<?php echo htmlspecialchars($proid);?>" readonly style="opacity: 0.6; cursor: not-allowed;"></td>
</tr>
<tr>
<td><b>Fecha: </b></td>
<td><input class="CajaTexto" type="date" name="txtnom" value="<?php echo htmlspecialchars($pronom);?>" required></td>
</tr>
<tr>
<td><b>Comentario: </b></td>
<td><textarea class="CajaTexto" name="txtpre" rows="4" required style="resize: vertical;"><?php echo htmlspecialchars($propre);?></textarea></td>
</tr>
<tr>
<td colspan="2">
    <div class="actions-row">
        <?php echo "<a class='btn-cancelar' href=\"comentarios_tabla.php?pag=$pagina\">Cancelar</a>";?>
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
if(isset($_POST['btnregistrar'])) {   
    $proid1  = $_POST['txtid'];
    $pronom1 = $_POST['txtnom'];
    $propre1 = $_POST['txtpre'];
    
    $stmt_up = mysqli_prepare($conn, "UPDATE comments SET creationdatecm = ?, textcomment = ? WHERE id_comment = ?");
    mysqli_stmt_bind_param($stmt_up, "sss", $pronom1, $propre1, $proid1);
    mysqli_stmt_execute($stmt_up);
    mysqli_stmt_close($stmt_up);

    echo "<script>window.location= 'comentarios_tabla.php?pag=$pagina';</script>";
    exit();
}
?>
