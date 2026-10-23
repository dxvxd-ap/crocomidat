<?php
include("conexion.php");
include("locales_tabla.php");

$pagina = isset($_GET['pag']) ? $_GET['pag'] : 1;
$id = isset($_GET['id']) ? $_GET['id'] : '';

$stmt = mysqli_prepare($conn, "SELECT id_fp, name, location, schedule, bg FROM food_place WHERE id_fp = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$querybuscar = mysqli_stmt_get_result($stmt);

$proid  = '';
$pronom = '';
$propre = '';
$procat = '';
$probg  = 'restaurant.jpg';

if ($mostrar = mysqli_fetch_array($querybuscar))
{  
   $proid  = $mostrar['id_fp'];
   $pronom = $mostrar['name'];
   $propre = $mostrar['location'];
   $procat = $mostrar['schedule'];
   $probg  = !empty($mostrar['bg']) ? $mostrar['bg'] : 'restaurant.jpg';
}
mysqli_stmt_close($stmt);
?>
<html>
<body>
<div class="caja_popup2">
<form class="contenedor_popup" method="POST" enctype="multipart/form-data">
<table>
<tr><th colspan="2"><i class="bi bi-pencil-square" style="color: var(--primary-lime);"></i> Modificar Local</th></tr>   
<tr>
<td style="width: 30%;"><b>ID:</b></td>
<td><input class="CajaTexto" type="number" name="txtid" value="<?php echo htmlspecialchars($proid);?>" readonly style="opacity: 0.6; cursor: not-allowed;"></td>
</tr>
<tr>
<td><b>Nombre:</b></td>
<td><input class="CajaTexto" type="text" name="txtnom" value="<?php echo htmlspecialchars($pronom);?>" required></td>
</tr>
<tr>
<td><b>Ubicación:</b></td>
<td><input class="CajaTexto" type="text" name="txtpre" value="<?php echo htmlspecialchars($propre);?>" required ></td>
</tr>
<tr>
<td><b>Horario:</b></td>
<td><input class="CajaTexto" type="text" name="txtcat" value="<?php echo htmlspecialchars($procat);?>" required ></td>
</tr>
<tr>
<td><b>Cambiar Foto:</b></td>
<td>
    <input type="file" name="foto_local" id="inputFotoMod" accept="image/png, image/jpeg, image/jpg, image/webp" class="CajaTexto" onchange="previewUploadMod(event)">
    <div style="margin-top: 10px; text-align: center;">
        <p style="font-size: 0.8rem; color: var(--text-muted); margin: 0 0 4px 0;">Foto actual / Nueva:</p>
        <img id="previewImgMod" src="../img/locales-z/<?php echo htmlspecialchars($probg); ?>" style="width: 100%; height: 130px; object-fit: cover; border-radius: 12px; border: 2px solid var(--border-color);" onerror="this.src='../img/logo.png'">
    </div>
</td>
</tr>
<tr>
<td colspan="2" >
    <div class="actions-row">
        <?php echo "<a class='btn-cancelar' href=\"locales_tabla.php?pag=$pagina\">Cancelar</a>";?>
        <button class='BotonesTeam' type="submit" name="btnregistrar">
            <i class="bi bi-save2-fill"></i> Guardar Cambios
        </button>
    </div>
</td>
</tr>
</table>
</form>
</div>
<script>
    function previewUploadMod(event) {
        const file = event.target.files[0];
        if (file) {
            const preview = document.getElementById('previewImgMod');
            preview.src = URL.createObjectURL(file);
        }
    }
</script>
</body>
</html>

<?php
if(isset($_POST['btnregistrar']))
{   
    $proid1  = isset($_POST['txtid']) ? $_POST['txtid'] : '';
    $pronom1 = isset($_POST['txtnom']) ? trim($_POST['txtnom']) : '';
    $propre1 = isset($_POST['txtpre']) ? trim($_POST['txtpre']) : '';
    $procat1 = isset($_POST['txtcat']) ? trim($_POST['txtcat']) : '';
    $probg1  = $probg; // Mantener foto actual por defecto

    // Subir nueva foto propia si se seleccionó un archivo
    if (isset($_FILES['foto_local']) && $_FILES['foto_local']['error'] === UPLOAD_ERR_OK) {
        $nombreTmp = $_FILES['foto_local']['tmp_name'];
        $ext = strtolower(pathinfo($_FILES['foto_local']['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array($ext, $permitidas)) {
            $nuevoNombre = 'local_' . time() . '_' . rand(100, 999) . '.' . $ext;
            $destino = '../img/locales-z/' . $nuevoNombre;
            if (move_uploaded_file($nombreTmp, $destino)) {
                $probg1 = $nuevoNombre;
            }
        }
    }

    $stmt_update = mysqli_prepare($conn, "UPDATE food_place SET name = ?, location = ?, schedule = ?, bg = ? WHERE id_fp = ?");
    mysqli_stmt_bind_param($stmt_update, "ssssi", $pronom1, $propre1, $procat1, $probg1, $proid1);
    mysqli_stmt_execute($stmt_update);
    mysqli_stmt_close($stmt_update);

    echo "<script>window.location= 'locales_tabla.php?pag=$pagina' </script>";
}
?>
