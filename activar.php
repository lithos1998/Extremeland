<?php 
    include("pdo.php");
    require_once("funciones.php");

    session_start();

    $tabla = $_GET["table"];
    $id = $_GET["id"];
    $estado = $_GET["estado"];
    
    if($tabla == "CANCIONES"){
        $activo = "ACTIVO";
        $set = $estado;
        $where = "ID_CANCION";
        $ver = "canciones";
    }else if($tabla == "ARTISTAS"){
        $activo = "ARTISTA_ACTIVO";
        $set = $estado;
        $where = "ID_ARTISTA";
        $ver = "artistas";
    }else if($tabla == "GENEROS"){
        $activo = "GENERO_ACTIVO";
        $set = $estado;
        $where = "ID_GENERO";
        $ver = "generos";
    }else if($tabla == "USUARIOS"){
        $activo = "ACTIVO";
        $set = $estado;
        $where = "ID_USUARIO";
        $ver = "usuarios";
    }else if($tabla == "NOTICIAS"){
        $activo = "ACTIVA";
        $set = $estado;
        $where = "ID_NOTICIA";
        $ver = "noticias";
    }else if($tabla == "COMENTARIOS"){
        $activo = "ACTIVO";
        $set = $estado;
        $where = "ID_COMENTARIO";
        $ver = "artistas";
        $id_art = $_GET["art"];
    }

    $sql = "UPDATE $tabla SET $activo = $set
                WHERE $where = $id;";
                  
    $count = $con -> exec($sql);
    if($tabla == "COMENTARIOS"){
        header("Location:panel.php?panel=comentarios&id=$id_art");
        die();
    }else{
        $_SESSION["exito"]="se activo/desactivo correctamente";
        header("Location:panel.php?panel=mostrar&ver=$ver");
        die();
    }
    

