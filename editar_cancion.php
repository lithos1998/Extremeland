<?php
    include("pdo.php");
    require_once("funciones.php");

    session_start();

    $id = $_POST["id"];
    //chequeos
    //si los campos estan vacios
    if(empty($_POST["nombre"])){
        $sql = "SELECT NOMBRE_CANCION
                    FROM CANCIONES
                    WHERE ID_CANCION = $id;";
        $count = $con -> query($sql);
        $resultado = $count->fetch(PDO::FETCH_OBJ);
        $nombre = $resultado->NOMBRE_CANCION;
    }else{
        $nombre = nombre_limpio($_POST["nombre"]);
    }

    if(empty($_POST["duracion"])){
        $sql = "SELECT DURACION
                    FROM CANCIONES
                    WHERE ID_CANCION = $id;";
        $count = $con -> query($sql);
        $resultado = $count->fetch(PDO::FETCH_OBJ);
        $duracion = $resultado->DURACION;
    }else{
        $duracion = $_POST["duracion"];
    }

    //si el genro esta vacio
    if(empty($_POST["generos"])){
        $_SESSION["error"]="debe seleccionar un genero";
        header("Location:panel.php?panel=cargar&ver=canciones&edit=$id");
        die();
    }
    //si artista esta vacio
    if(empty($_POST["artistas"])){
        $_SESSION["error"]="debe seleccionar un artista";
        header("Location:panel.php?panel=cargar&ver=canciones&edit=$id");
        die();
    }
    
    
    $genero = $_POST["generos"];
    $artista = $_POST["artistas"];
    
    $sql = "UPDATE CANCIONES SET NOMBRE_CANCION = '$nombre' ,
                                 DURACION = '$duracion' ,
                                 ACTIVO = 'TRUE',
                                 ID_GENERO = $genero ,
                                 ID_ARTISTA = $artista,
                                 DESTACADOS = 0
                WHERE ID_CANCION = $id;";
    $count = $con -> exec($sql);

    //lo mandamos al panel de control
    $_SESSION["exito"]=" $nombre se edito correctamente";
    header("Location:panel.php?panel=mostrar&ver=canciones");
    die();
?>
