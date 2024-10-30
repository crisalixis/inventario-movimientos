<?php

    $host = 'localhost';
    $user = 'root'; 
    $pass = '';
    $db = 'inventario';

    $conexion = @mysqli_connect($host, $user, $pass, $db);
    
    if(!$conexion){
        echo "Error de conexion";
    }

?>