<?php
session_start();

include_once('../Config/Conexion.php');

if (isset($_POST['Usuario'], $_POST['Clave'])) {

    function Validar($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $usuario = Validar($_POST['Usuario']);
    $clave = Validar($_POST['Clave']);

    if (empty($usuario)) {
        header('location: ../Index.php?error=El Usuario Es Requerido');
        exit();
    } elseif (empty($clave)) {
        header('location: ../Index.php?error=La Clave Es Requerida');
        exit();
    } else {
        // Verificar credenciales en la base de datos
        $sql = "SELECT * FROM usuarios WHERE NombreUsuario = :usuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $Id = $result['Id'];
            $NombreUsuario = $result['NombreUsuario'];
            $ClaveHash = $result['Clave'];
            $NombreCompleto = $result['NombreCompleto'];

            if (password_verify($clave, $ClaveHash)) {
                // Credenciales correctas, iniciar sesión
                $_SESSION['Id'] = $Id;
                $_SESSION['NombreUsuario'] = $NombreUsuario;
                $_SESSION['NombreCompleto'] = $NombreCompleto;
                
                header('Location: ../Home.php');
                exit();
            } else {
                // Credenciales incorrectas
                header('Location: ../Index.php?error=Usuario o Clave Incorrecta');
                exit();
            }
        } else {
            // Usuario no encontrado en la base de datos
            header('Location: ../Index.php?error=Usuario o Clave Incorrecta');
            exit();
        }
    }
}
