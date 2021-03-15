<?php
    include("pdo.php");
    require_once("funciones.php");

    session_start();

    //chequeos
    //si los campos estan vacios
    if(empty($_POST["nombre"]) || empty($_POST["duracion"])){
        $_SESSION["error"]="debe completar todos los campos";
        header("Location:panel.php?panel=cargar&ver=canciones");
        die();
    }
    //si el genro esta vacio
    if(empty($_POST["generos"])){
        $_SESSION["error"]="debe seleccionar un genero";
        header("Location:panel.php?panel=cargar&ver=canciones");
        die();
    }
    //si artista esta vacio
    if(empty($_POST["artistas"])){
        $_SESSION["error"]="debe seleccionar un artista";
        header("Location:panel.php?panel=cargar&ver=canciones");
        die();
    }

    $nombre = nombre_limpio($_POST["nombre"]);
    $duracion = $_POST["duracion"];
    $genero = $_POST["generos"];
    $artista = $_POST["artistas"];
    
    $sql = "INSERT INTO CANCIONES(NOMBRE_CANCION,DURACION,ACTIVO,ID_GENERO,ID_ARTISTA,DESTACADOS)
                VALUES('$nombre' , '$duracion', 'TRUE' , $genero , $artista , 0);";
    $count = $con -> exec($sql);

    //lo mandamos al panel de control
    $_SESSION["exito"]=" $nombre se cargo correctamente";
    header("Location:panel.php?panel=mostrar&ver=canciones");
    die();
?>
