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
    <title>Locales Tabla - Crocomidat</title>
    <link rel="stylesheet" href="estilo.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>
<?php include("barra_lateral.php"); ?>
<div class="ContenedorPrincipal">  
<?php
$filasmax = 7;
if (isset($_GET['pag']))
{
    $pagina = $_GET['pag'];
} else
{
    $pagina = 1;
}

if(isset($_POST['btnbuscar']))
{
    $buscar = $_POST['txtbuscar'];
    $stmt = mysqli_prepare($conn, "SELECT loc.id_fp, loc.name, loc.location, loc.schedule, loc.bg FROM food_place loc WHERE loc.name LIKE ?");
    $param_buscar = $buscar . "%";
    mysqli_stmt_bind_param($stmt, "s", $param_buscar);
    mysqli_stmt_execute($stmt);
    $sqlusu = mysqli_stmt_get_result($stmt);
}
else
{
    $offset = ($pagina - 1) * $filasmax;
    $stmt = mysqli_prepare($conn, "SELECT loc.id_fp, loc.name, loc.location, loc.schedule, loc.bg FROM food_place loc ORDER BY loc.id_fp ASC LIMIT ?, ?");
    mysqli_stmt_bind_param($stmt, "ii", $offset, $filasmax);
    mysqli_stmt_execute($stmt);
    $sqlusu = mysqli_stmt_get_result($stmt);
}

$resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_food_places FROM food_place");    
$maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_food_places'];
?>

<div class="ContenedorTabla">
   <form method="POST">
       <h1>Lista de locales de comida</h1>
       <div class="ContBuscar">
           <div>
               <a href="locales_tabla.php" class="BotonesTeam"><i class="bi bi-arrow-clockwise"></i> Inicio</a>
               <input class="CajaTextoBuscar" type="text" name="txtbuscar" placeholder="Buscar por nombre..." autocomplete="off">
               <button class="BotonesTeam" type="submit" name="btnbuscar"><i class="bi bi-search"></i> Buscar</button>
           </div>
           <div>
               <?php echo "<a class='BotonesTeam5' href=\"locales_registrar.php?pag=$pagina\"><i class=\"bi bi-plus-circle-fill\"></i> Agregar local</a>";?>
           </div>
       </div>
   </form>
   <table>
        <thead>
            <tr>
                <th style="width: 60px;">Id</th>
                <th style="width: 80px;">Foto</th>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Horario</th>
                <th style="text-align: center; width: 140px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($sqlusu && mysqli_num_rows($sqlusu) > 0) {
            while ($mostrar = mysqli_fetch_assoc($sqlusu))
            {
                $foto = (!empty($mostrar['bg'])) ? $mostrar['bg'] : 'restaurant.jpg';
                echo "<tr>";
                echo "<td><span style='font-weight: 700; color: #65a30d;'>#".htmlspecialchars($mostrar['id_fp'])."</span></td>";
                echo "<td><img class='thumbnail-local' src='../img/locales-z/".htmlspecialchars($foto)."' alt='Local' style='width: 52px; height: 52px; min-width: 52px; min-height: 52px; object-fit: cover; border-radius: 10px; display: block;' onerror=\"this.src='../img/logo.png'\"></td>";
                echo "<td><strong style='color: #0f172a; font-weight: 600; font-size: 0.98rem;'>".htmlspecialchars($mostrar['name'])."</strong></td>";
                echo "<td><i class='bi bi-geo-alt-fill' style='color: #65a30d; margin-right: 5px;'></i><span style='color: #334155;'>".htmlspecialchars($mostrar['location'])."</span></td>";
                echo "<td><i class='bi bi-clock-fill' style='color: #64748b; margin-right: 5px;'></i><span style='color: #475569;'>".htmlspecialchars($mostrar['schedule'])."</span></td>";
                echo "<td style='text-align: center; white-space: nowrap;'>
                <a class='BotonesTeam1' title='Ver detalles' href=\"locales_ver.php?id=".$mostrar['id_fp']."&pag=$pagina\"><i class=\"bi bi-eye-fill\"></i></a>
                <a class='BotonesTeam2' title='Modificar' href=\"locales_modificar.php?id=".$mostrar['id_fp']."&pag=$pagina\"><i class=\"bi bi-pencil-fill\"></i></a>
                <a class='BotonesTeam3' title='Eliminar' href=\"locales_eliminar.php?id=".$mostrar['id_fp']."&pag=$pagina\" onClick=\"return confirm('¿Estás seguro de eliminar el local ".htmlspecialchars($mostrar['name'])."?')\"><i class=\"bi bi-trash-fill\"></i></a>
                </td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' style='text-align: center; padding: 30px; color: var(--text-muted);'>No se encontraron locales de comida registrados.</td></tr>";
        }
        ?>
        </tbody>
   </table>

   <div style='text-align:right; margin-top: 16px; color: var(--text-muted); font-size: 0.9rem;'>
       Total de locales: <strong style="color: var(--primary-lime);"><?php echo $maxusutabla;?></strong>
   </div>
</div>

<div style='text-align:right'>
   <br>
</div>

<div style="text-align:center">
<?php
if (isset($_GET['pag'])) {
    if ($_GET['pag'] > 1) {
    ?>
    <a class="BotonesTeam4" href="locales_tabla.php?pag=<?php echo $_GET['pag'] - 1; ?>">Anterior</a>
    <?php
    } else {
    ?>
    <a class="BotonesTeam4" href="#" style="pointer-events: none">Anterior</a>
    <?php
    }
} else {
?>
    <a class="BotonesTeam4" href="#" style="pointer-events: none">Anterior</a>
<?php
}

if (isset($_GET['pag'])) {
    if ((($pagina) * $filasmax) < $maxusutabla) {
    ?>
    <a class="BotonesTeam4" href="locales_tabla.php?pag=<?php echo $_GET['pag'] + 1; ?>">Siguiente</a>
    <?php
    } else {
    ?>
    <a class="BotonesTeam4" href="#" style="pointer-events: none">Siguiente</a>
    <?php
    }
} else {
    if ($maxusutabla > $filasmax) {
    ?>
    <a class="BotonesTeam4" href="locales_tabla.php?pag=2">Siguiente</a>
    <?php
    } else {
    ?>
    <a class="BotonesTeam4" href="#" style="pointer-events: none">Siguiente</a>
    <?php
    }
}
?>
</div>
</div>
</body>
</html>
