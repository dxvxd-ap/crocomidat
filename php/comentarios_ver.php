<?php
include("conexion.php");
include("comentarios_tabla.php");
$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
$id = isset($_GET['id']) ? $_GET['id'] : '';

$stmt = mysqli_prepare($conn, "SELECT c.id_comment, c.creationdatecm, c.textcomment FROM comments c WHERE c.id_comment = ?");
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$querybuscar = mysqli_stmt_get_result($stmt);

$proid = '';
$pronom = '';
$propre = '';

if ($mostrar = mysqli_fetch_array($querybuscar)) {
    $proid = $mostrar['id_comment'];
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
                <tr><th colspan="2"><i class="bi bi-chat-left-quote-fill" style="color: var(--primary-lime);"></i> Detalles del Comentario</th></tr>
                <tr>
                    <td style="width: 30%;"><b>ID:</b></td>
                    <td><strong style="color: var(--primary-green);">#<?php echo htmlspecialchars($proid);?></strong></td>
                </tr>
                <tr>
                    <td><b>Fecha:</b></td>
                    <td><span style="color: #64748b;"><i class="bi bi-calendar3"></i> <?php echo htmlspecialchars($pronom);?></span></td>
                </tr>
                <tr>
                    <td><b>Comentario:</b></td>
                    <td><div style="background: #f8fafc; padding: 12px; border-radius: 10px; border: 1px solid var(--border-color); color: #1e293b;"><?php echo nl2br(htmlspecialchars($propre));?></div></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top: 20px;">
                        <div class="actions-row" style="justify-content: center;">
                            <?php echo "<a class='BotonesTeam' style='width: 100%; text-align: center;' href=\"comentarios_tabla.php?pag=$pagina\"><i class=\"bi bi-arrow-left\"></i> Volver a la lista</a>";?>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>