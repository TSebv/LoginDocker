<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Style.css">
    <title>Login</title>
</head>
<body>
    <div class="contenedor">
        <h1><ins>Iniciar Sesion</ins></h1>
        <br>
        <form action="Login/LoginAuto.php" method="POST">
            <?php if(isset($_GET['error'])) {?>
                <p><?php echo $_GET['error']?></p>
            <?php } ?>
            <label for="">
                <img  width="25px" src="ICONS/User.svg" alt="">
                Usuario
            </label>
            <input type="text" placeholder="Ingrese Usuario" name="Usuario">
            <label for="">
                <img width="25px" src="ICONS/Key.svg" alt="">
                Clave
            </label>
            <input type="password" placeholder="Ingrese Clave" name="Clave">
            <button class="button">
                Ingrese
            </button>
            <a href="Registrarse.php" class="button">
                Registrarse
            </a>
        </form>
    </div>
</body>
</html>