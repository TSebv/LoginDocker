<?php
    $server = 'db';
    $username = 'root';
    $password = '';
    $database  = 'logindb';

    try{
        $conexion = new  PDO("mysql:host=$server;dbname=$database;", $username, $password);

    }catch(PDOException $e){
        die('Conexion fallida: ' .$e->getMessage());
    }
?>