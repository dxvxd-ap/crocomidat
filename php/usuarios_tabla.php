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
    <title>Usuarios Tabla - Crocomidat</title>
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


$sqlusu = mysqli_query($conn, "SELECT u.name, u.email, u.psswd, u.rol 
from users u where u.name like '".$buscar."%'");


}
else
{
$sqlusu = mysqli_query($conn, "SELECT u.name, u.email, u.psswd, u.rol 
from users u ORDER BY u.name ASC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
}
   $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_users FROM users");    
   $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_users'];
  
   ?>



<div class="ContenedorTabla">
   <form method="POST">
       <h1>Lista de usuarios</h1>
       <div class="ContBuscar">
           <div>
               <a href="usuarios_tabla.php" class="BotonesTeam"><i class="bi bi-arrow-clockwise"></i> Inicio</a>
               <input class="CajaTextoBuscar" type="text" name="txtbuscar" placeholder="Buscar por nombre o correo..." autocomplete="off">
               <button class="BotonesTeam" type="submit" name="btnbuscar"><i class="bi bi-search"></i> Buscar</button>
           </div>
           <div>
               <?php echo "<a class='BotonesTeam5' href=\"usuarios_registrar1.php?pag=$pagina\"><i class=\"bi bi-person-plus-fill\"></i> Agregar usuario</a>";?>
           </div>
       </div>
   </form>
   <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Contraseña</th>
                <th>Rol</th>
                <th style="text-align: center; width: 140px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($sqlusu && mysqli_num_rows($sqlusu) > 0) {
            while ($mostrar = mysqli_fetch_assoc($sqlusu))
            {
                $rolBadge = ($mostrar['rol'] == '1') 
                    ? "<span style='background: #ecfccb; color: #365314; padding: 4px 10px; border-radius: 6px; font-size: 0.85rem; font-weight: 700;'><i class='bi bi-shield-lock-fill'></i> Admin</span>"
                    : "<span style='background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 6px; font-size: 0.85rem; font-weight: 600;'><i class='bi bi-person'></i> Usuario</span>";

                echo "<tr>";
                echo "<td><strong style='color: #0f172a; font-weight: 600;'><i class='bi bi-person-circle' style='color: #64748b; margin-right: 8px;'></i>".htmlspecialchars($mostrar['name'])."</strong></td>";
                echo "<td><i class='bi bi-envelope' style='color: #65a30d; margin-right: 6px;'></i><span style='color: #334155;'>".htmlspecialchars($mostrar['email'])."</span></td>";
                echo "<td><span style='color: #94a3b8; font-family: monospace; letter-spacing: 2px;'>••••••••••••</span></td>";
                echo "<td>".$rolBadge."</td>";
                echo "<td style='text-align: center; white-space: nowrap;'>
                <a class='BotonesTeam1' title='Ver detalles' href=\"usuarios_ver.php?id=".urlencode($mostrar['email'])."&pag=$pagina\"><i class=\"bi bi-eye-fill\"></i></a>
                <a class='BotonesTeam2' title='Modificar' href=\"usuarios_modificar.php?id=".urlencode($mostrar['email'])."&pag=$pagina\"><i class=\"bi bi-pencil-fill\"></i></a>
                <a class='BotonesTeam3' title='Eliminar' href=\"usuarios_eliminar.php?id=".urlencode($mostrar['email'])."&pag=$pagina\" onClick=\"return confirm('¿Estás seguro de eliminar al usuario ".htmlspecialchars($mostrar['name'])."?')\"><i class=\"bi bi-trash-fill\"></i></a>
                </td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align: center; padding: 30px; color: var(--text-muted);'>No se encontraron usuarios registrados.</td></tr>";
        }
        ?>
        </tbody>
   </table>

   <div style='text-align:right; margin-top: 16px; color: var(--text-muted); font-size: 0.9rem;'>
       Total de usuarios: <strong style="color: var(--primary-lime);"><?php echo $maxusutabla;?></strong>
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
<a class="BotonesTeam4" href="usuarios_tabla.php?pag=<?php echo $_GET['pag'] - 1; ?>">Anterior</a>
<?php
}
else
{
?>
<a class="BotonesTeam4" href="#" style="pointer-events: none">Anterior</a>
<?php
}
?>
<?php
}
else
{
?>
<a class="BotonesTeam4" href="#" style="pointer-events: none">Anterior</a>
<?php
}
if (isset($_GET['pag'])) {
if ((($pagina) * $filasmax) < $maxusutabla) {
?>
<a class="BotonesTeam4" href="usuarios_tabla.php?pag=<?php echo $_GET['pag'] + 1; ?>">Siguiente</a>
<?php
} else {
?>
<a class="BotonesTeam4" href="#" style="pointer-events: none">Siguiente</a>
<?php
}
?>
<?php
} else {
?>
<a class="BotonesTeam4" href="usuarios_tabla.php?pag=2">Siguiente</a>
<?php
}
?>
</div>
</div>
</body>
</html>
