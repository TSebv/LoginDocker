<?php 
    session_start();
    if (isset($_SESSION['Id']) && isset($_SESSION['NombreUsuario'])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <a href="Login/CerrarSesion.php">Cerrar Sesion</a>
    <h2>BIENVENIDO USUARIO</h2>
</body>
</html>

<?php }else {

    header('location: ../Index.php');
} ?>