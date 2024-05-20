<?php
session_start();

include_once("../config/Conexion.php");

if (isset($_POST['Usuario'], $_POST['NombreCompleto'], $_POST['Clave'], $_POST['RClave'])) {
    function validar($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $usuario = validar($_POST['Usuario']);
    $nombreCompleto = validar($_POST['NombreCompleto']);
    $clave = validar($_POST['Clave']);
    $Rclave = validar($_POST['RClave']);

    $datoUsuario = 'Usuario=' . $usuario . '&NombreCompleto=' . $nombreCompleto;

    if (empty($usuario) || empty($nombreCompleto) || empty($clave) || empty($Rclave)) {
        header("location: ../Registrarse.php?error=Todos los campos son requeridos&$datoUsuario");
        exit();
    } elseif ($clave !== $Rclave) {
        header("location: ../Registrarse.php?error=Las contraseñas no coinciden&$datoUsuario");
        exit();
    } elseif (strlen($clave) < 1) {
        header("location: ../Registrarse.php?error=La contraseña debe tener al menos 1 caracteres&$datoUsuario");
        exit();
    } else {
        // Hash de la contraseña
        $clave_hash = password_hash($clave, PASSWORD_DEFAULT);

        // Consulta preparada para verificar si el usuario ya existe
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE NombreUsuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            header("location: ../Registrarse.php?error=El Usuario ya existe&$datoUsuario");
            exit();
        } else {
            // Consulta preparada para insertar el nuevo usuario
            $stmt = $conexion->prepare("INSERT INTO usuarios(NombreCompleto, NombreUsuario, Clave) VALUES (:nombreCompleto, :usuario, :clave)");
            $stmt->bindParam(':nombreCompleto', $nombreCompleto);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':clave', $clave_hash);
            if ($stmt->execute()) {
                header("location: ../Registrarse.php?success=Usuario creado con éxito");
                exit();
            } else {
                header("location: ../Registrarse.php?error=Ocurrió un error al crear el usuario&$datoUsuario");
                exit();
            }
        }
    }
} else {
    header('location: ../Registrarse.php');
    exit();
}
?>
