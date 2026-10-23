<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}
include('conexion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios Tabla - Crocomidat</title>
    <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>
<?php include("barra_lateral.php"); ?>
<div class="ContenedorPrincipal">  
<?php
$filasmax = 7;
$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
if ($pagina < 1) $pagina = 1;

if (isset($_POST['btnbuscar'])) {
    $buscar = $_POST['txtbuscar'];
    $stmt = mysqli_prepare($conn, "SELECT c.id_comment, c.creationdatecm, c.textcomment FROM comments c WHERE c.id_comment LIKE ? OR c.textcomment LIKE ?");
    $param_buscar = "%" . $buscar . "%";
    mysqli_stmt_bind_param($stmt, "ss", $param_buscar, $param_buscar);
    mysqli_stmt_execute($stmt);
    $sqlusu = mysqli_stmt_get_result($stmt);
} else {
    $offset = ($pagina - 1) * $filasmax;
    $stmt = mysqli_prepare($conn, "SELECT c.id_comment, c.creationdatecm, c.textcomment FROM comments c ORDER BY c.id_comment ASC LIMIT ?, ?");
    mysqli_stmt_bind_param($stmt, "ii", $offset, $filasmax);
    mysqli_stmt_execute($stmt);
    $sqlusu = mysqli_stmt_get_result($stmt);
}

$resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_comments FROM comments");    
$maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_comments'];
?>

<div class="ContenedorTabla">
   <form method="POST">
       <h1>Lista de comentarios</h1>
       <div class="ContBuscar">
           <div>
               <a href="comentarios_tabla.php" class="BotonesTeam"><i class="bi bi-arrow-clockwise"></i> Inicio</a>
               <input class="CajaTextoBuscar" type="text" name="txtbuscar" placeholder="Buscar por ID o texto..." autocomplete="off">
               <button class="BotonesTeam" type="submit" name="btnbuscar"><i class="bi bi-search"></i> Buscar</button>
           </div>
           <div>
               <?php echo "<a class='BotonesTeam5' href=\"comentarios_registrar.php?pag=$pagina\"><i class=\"bi bi-chat-left-text-fill\"></i> Agregar comentario</a>";?>
           </div>
       </div>
   </form>
   <table>
        <thead>
            <tr>
                <th style="width: 70px;">Id</th>
                <th style="width: 150px;">Fecha</th>
                <th>Comentario</th>
                <th style="text-align: center; width: 140px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($sqlusu && mysqli_num_rows($sqlusu) > 0) {
            while ($mostrar = mysqli_fetch_assoc($sqlusu))
            {
                echo "<tr>";
                echo "<td><strong style='color: #65a30d;'>#".htmlspecialchars($mostrar['id_comment'])."</strong></td>";
                echo "<td><i class='bi bi-calendar3' style='color: #64748b; margin-right: 6px;'></i><span style='color: #475569; font-size: 0.9rem;'>".htmlspecialchars($mostrar['creationdatecm'])."</span></td>";
                echo "<td><span style='color: #1e293b;'>".htmlspecialchars($mostrar['textcomment'])."</span></td>";
                echo "<td style='text-align: center; white-space: nowrap;'>
                <a class='BotonesTeam1' title='Ver comentario' href=\"comentarios_ver.php?id=".$mostrar['id_comment']."&pag=$pagina\"><i class=\"bi bi-eye-fill\"></i></a>
                <a class='BotonesTeam2' title='Modificar' href=\"comentarios_modificar.php?id=".$mostrar['id_comment']."&pag=$pagina\"><i class=\"bi bi-pencil-fill\"></i></a>
                <a class='BotonesTeam3' title='Eliminar' href=\"comentarios_eliminar.php?id=".$mostrar['id_comment']."&pag=$pagina\" onClick=\"return confirm('¿Estás seguro de eliminar el comentario #".htmlspecialchars($mostrar['id_comment'])."?')\"><i class=\"bi bi-trash-fill\"></i></a>
                </td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' style='text-align: center; padding: 30px; color: var(--text-muted);'>No se encontraron comentarios registrados.</td></tr>";
        }
        ?>
        </tbody>
   </table>

   <div style='text-align:right; margin-top: 16px; color: var(--text-muted); font-size: 0.9rem;'>
       Total de comentarios: <strong style="color: var(--primary-lime);"><?php echo $maxusutabla;?></strong>
   </div>
</div>

<div style="text-align:center; margin-top: 24px;">
<?php
if ($pagina > 1) {
    echo "<a class='BotonesTeam4' href='comentarios_tabla.php?pag=".($pagina - 1)."'>Anterior</a> ";
} else {
    echo "<a class='BotonesTeam4' href='#' style='pointer-events: none; opacity: 0.5;'>Anterior</a> ";
}

if (($pagina * $filasmax) < $maxusutabla) {
    echo "<a class='BotonesTeam4' href='comentarios_tabla.php?pag=".($pagina + 1)."'>Siguiente</a>";
} else {
    echo "<a class='BotonesTeam4' href='#' style='pointer-events: none; opacity: 0.5;'>Siguiente</a>";
}
?>
</div>
</div>
</body>
</html>
