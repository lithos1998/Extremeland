<?php
    //archivo de conexion a la base de datos
    //datos de conexion a la base de datos
    $hostname = "localhost";
    $database = "asdavinc_pw_acn3a_20191_equipo09";
    $port = 3306;
    $username = "asdavinc_pw_n009";
    $password = "nwqu9945772mplov";

    try {
        //conexion exitosa
        $con = new PDO("mysql:host=$hostname;dbname=$database;port=$port",$username,$password);
    }
    catch(PDOException $e){
        echo "error".$e->getMessage();
        echo "error para la base de datos";
        die();
    }

?>