<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Style.css">
    <title>Registrarse</title>
</head>
<body>
    <div class="contenedor">
        <h1><ins>Registrarse</ins></h1>
        <br>
        <form action="Login/Registrarse.php" method="POST">

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']?></p>
            <?php } ?>
            <br>
            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']?></p>
            <?php } ?>
            <br>
            <label for="">
                <img  width="25px" src="ICONS/User.svg" alt="">
                Usuario
            </label>
            <input type="text" placeholder="Ingrese Usuario" name="Usuario">
            <label for="">
                <img  width="25px" src="ICONS/User.svg" alt="">
                Nombre Completo
            </label>
            <input type="text" placeholder="Ingrese Nombre Completo" name="NombreCompleto">
            <label for="">
                <img width="25px" src="ICONS/Key.svg" alt="">
                Clave
            </label>
            <input type="password" placeholder="Ingrese Clave" name="Clave">
            <label for="">
                <img width="25px" src="ICONS/Key.svg" alt="">
                Repetir Clave
            </label>
            <input type="password" placeholder="Repita Clave" name="RClave">
            <input type="submit" class="button" value="Registrarse">
            <a href="Index.php" class="Buton_Ingresar">
                Ingresar
            </a>
        </form>
    </div>
</body>
</html>