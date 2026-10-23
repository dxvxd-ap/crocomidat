<?php
include("conexion.php");
include("locales_tabla.php");
$pagina = isset($_GET['pag']) ? $_GET['pag'] : 1;
?>
<html>
    <body>
        <div class="caja_popup2">
            <form class="contenedor_popup" method="POST" enctype="multipart/form-data">
                <table>
                    <tr><th colspan="2"><i class="bi bi-shop-window" style="color: var(--primary-lime);"></i> Agregar Nuevo Local</th></tr>
                    <tr>
                        <td style="width: 30%;"><b>Nombre:</b></td>
                        <td><input type="text" name="txtnom" placeholder="Ej. Tacos El Paisa" autocomplete="off" class="CajaTexto" required></td>
                    </tr>
                    <tr>
                        <td><b>Ubicación:</b></td>
                        <td><input type="text" name="txtloc" placeholder="Ej. Av. Hidalgo #104" autocomplete="off" class="CajaTexto" required></td>
                    </tr>
                    <tr>
                        <td><b>Horario:</b></td>
                        <td><input type="text" name="txthor" placeholder="Ej. 8:00 AM - 10:00 PM" autocomplete="off" class="CajaTexto" required></td>
                    </tr>
                    <tr>
                        <td><b>Subir Foto:</b></td>
                        <td>
                            <input type="file" name="foto_local" id="inputFoto" accept="image/png, image/jpeg, image/jpg, image/webp" class="CajaTexto" onchange="previewUpload(event)" required>
                            <div style="margin-top: 10px; text-align: center;">
                                <img id="previewImg" src="../img/locales-z/restaurant.jpg" style="width: 100%; height: 130px; object-fit: cover; border-radius: 12px; border: 2px solid var(--border-color); display: none;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="actions-row">
                                <?php echo "<a class='btn-cancelar' href=\"locales_tabla.php?pag=$pagina\">Cancelar</a>";?>
                                <button type="submit" class="BotonesTeam" name="btnregistrar">
                                    <i class="bi bi-cloud-arrow-up-fill"></i> Registrar Local
                                </button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <script>
            function previewUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    const preview = document.getElementById('previewImg');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                }
            }
        </script>
    </body>
</html>

<?php
if(isset($_POST['btnregistrar'])){
    $pronom = isset($_POST['txtnom']) ? trim($_POST['txtnom']) : '';
    $propre = isset($_POST['txtloc']) ? trim($_POST['txtloc']) : '';
    $procat = isset($_POST['txthor']) ? trim($_POST['txthor']) : '';
    $probg  = 'restaurant.jpg';

    // Subir foto propia seleccionada por el usuario
    if (isset($_FILES['foto_local']) && $_FILES['foto_local']['error'] === UPLOAD_ERR_OK) {
        $nombreTmp = $_FILES['foto_local']['tmp_name'];
        $ext = strtolower(pathinfo($_FILES['foto_local']['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array($ext, $permitidas)) {
            $nuevoNombre = 'local_' . time() . '_' . rand(100, 999) . '.' . $ext;
            $destino = '../img/locales-z/' . $nuevoNombre;
            if (move_uploaded_file($nombreTmp, $destino)) {
                $probg = $nuevoNombre;
            }
        }
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO food_place (name, location, schedule, bg) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $pronom, $propre, $procat, $probg);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo "<script>window.location= 'locales_tabla.php?pag=$pagina'</script>";
}
?>

