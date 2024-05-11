<?php

    session_start();

    include_once("../config/Conexion.php");
    if (isset($_POST['Usuario']) && isset($_POST['NombreCompleto']) && isset($_POST['Clave']) && isset($_POST['RClave'])) {
        function validar ($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

        $usuario = validar($_POST['Usuario']);
        $nombreCompleto = validar($_POST['NombreCompleto']);
        $clave = validar($_POST['Clave']);
        $Rclave = validar($_POST['RClave']);

        $datoUsuario = 'Usuario=' . $usuario . '&NombreCompleto=' . $nombreCompleto;
        
        if (empty($usuario)){
            header("location: ../Registrarse.php?error=El Usuario Es Requerido&$datoUsuario");
            exit();
        }elseif(empty($nombreCompleto)){
            header("location: ../Registrarse.php?error=El Nombre Completo Es Requerido&$datoUsuario");
            exit();
        }elseif(empty($clave)){
            header("location: ../Registrarse.php?error=La Clave Es Requerida&$datoUsuario");
            exit();
        }elseif(empty($Rclave)){
            header("location: ../Registrarse.php?error=Repetir Clave Es Requerido&$datoUsuario");
            exit();
        }elseif($clave !== $Rclave){
            header("location: ../Registrarse.php?error=La Clave No Coinciden&$datoUsuario");
            exit();
        }else {
            $clave = password_hash($clave, PASSWORD_DEFAULT);

            $sql = "SELECT * FROM usuarios WHERE NombreUsuario = '$usuario'";
            $query = $conexion->query($sql);

            if (mysqli_num_rows($query) > 0) {
                header("location: ../Registrarse.php?error=El Usuario Ya Existe");
                exit();
            }else {
                $sql2 = "INSERT INTO usuarios(NombreCompleto, NombreUsuario, Clave) VALUES ('$nombreCompleto', '$usuario', '$clave')";
                $query2 = $conexion->query($sql2);

                if ($query2) {
                    header("location: ../Registrarse.php?success=Usuario Creado Con Exito");
                    exit();
                }else {
                    header("location: ../Registrarse.php?success=Ocurrio Un Error");
                    exit();
                }
            }
        }
    }else {
        header('location: ../Registrarse.php');
            exit();
    }