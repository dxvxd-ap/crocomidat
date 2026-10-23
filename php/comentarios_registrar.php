<?php
include("conexion.php");
include("comentarios_tabla.php");
$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
?>
<html>
    <body>
        <div class="caja_popup2">
            <form class="contenedor_popup" method="POST">
                <table>
                    <tr><th colspan="2"><i class="bi bi-chat-plus-fill" style="color: var(--primary-lime);"></i> Agregar Nuevo Comentario</th></tr>
                    <tr>
                        <td style="width: 30%;"><b>Fecha:</b></td>
                        <td><input type="date" name="txtnom" value="<?php echo date('Y-m-d'); ?>" required class="CajaTexto"></td>
                    </tr>
                    <tr>
                        <td><b>Comentario:</b></td>
                        <td><textarea name="txtloc" rows="4" placeholder="Escribe tu comentario aquí..." required class="CajaTexto" style="resize: vertical;"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="actions-row">
                                <?php echo "<a class='btn-cancelar' href=\"comentarios_tabla.php?pag=$pagina\">Cancelar</a>";?>
                                <button type="submit" class="BotonesTeam" name="btnregistrar">
                                    <i class="bi bi-send-fill"></i> Registrar Comentario
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
    $pronom = $_POST['txtnom'];
    $propre = $_POST['txtloc'];
    
    $stmt_ins = mysqli_prepare($conn, "INSERT INTO comments (creationdatecm, textcomment) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt_ins, "ss", $pronom, $propre);
    mysqli_stmt_execute($stmt_ins);
    mysqli_stmt_close($stmt_ins);

    echo "<script>window.location= 'comentarios_tabla.php?pag=$pagina';</script>";
    exit();
}
?>
