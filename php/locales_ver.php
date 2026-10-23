<?php
include("conexion.php");
include("locales_tabla.php");
$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
$id = isset($_GET['id']) ? $_GET['id'] : '';

$stmt = mysqli_prepare($conn, "SELECT loc.id_fp, loc.name, loc.location, loc.schedule, loc.bg FROM food_place loc WHERE loc.id_fp = ?");
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
        <div class="contenedor_popup">
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="../img/locales-z/<?php echo htmlspecialchars($probg); ?>" alt="Foto local" style="width: 100%; height: 180px; object-fit: cover; border-radius: 14px; border: 2px solid var(--border-color); box-shadow: 0 4px 14px rgba(0,0,0,0.08);" onerror="this.src='../img/logo.png'">
            </div>
            <table>
                <tr><th colspan="2" style="font-size: 1.4rem; color: #0f172a; padding-bottom: 12px; text-align: center; border-bottom: 1px solid var(--border-color);"><?php echo htmlspecialchars($pronom); ?></th></tr>
                <tr>
                    <td style="width: 35%; color: var(--text-muted);"><i class="bi bi-hash"></i> ID:</td>
                    <td><strong style="color: var(--primary-green);">#<?php echo htmlspecialchars($proid);?></strong></td>
                </tr>
                <tr>
                    <td style="color: var(--text-muted);"><i class="bi bi-geo-alt-fill" style="color: var(--primary-green);"></i> Ubicación:</td>
                    <td><span style="color: #1e293b;"><?php echo htmlspecialchars($propre);?></span></td>
                </tr>
                <tr>
                    <td style="color: var(--text-muted);"><i class="bi bi-clock-fill" style="color: #64748b;"></i> Horario:</td>
                    <td><span style="color: #1e293b;"><?php echo htmlspecialchars($procat);?></span></td>
                </tr>
                <tr>
                    <td style="color: var(--text-muted);"><i class="bi bi-image" style="color: var(--accent-blue);"></i> Archivo Foto:</td>
                    <td><code style="background: #f1f5f9; padding: 3px 8px; border-radius: 6px; font-size: 0.85rem; color: #0f172a; border: 1px solid var(--border-color);"><?php echo htmlspecialchars($probg);?></code></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top: 24px;">
                        <div class="actions-row" style="justify-content: center;">
                            <?php echo "<a class='BotonesTeam' style='width: 100%; text-align: center;' href=\"locales_tabla.php?pag=$pagina\"><i class=\"bi bi-arrow-left\"></i> Regresar a la lista</a>";?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>