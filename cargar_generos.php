<?php
    session_start();
    
    require_once("funciones.php");
    //chequeos
    //si los campos estan vacios
    if(empty($_POST["nombre"])){
        $_SESSION["error"]="debe llenar todos los campos";
        header("Location:panel.php?panel=cargar&ver=artistas");
        die();
    }

    $nombre = nombre_limpio($_POST["nombre"]);
    $padre = $_POST["generos"] ;
    

    $sql = "INSERT INTO GENEROS(NOMBRE_GENERO,PADRE,GENERO_ACTIVO)
                VALUES('$nombre' ,$padre, 'TRUE');";
    $count = $con -> exec($sql);
    
    $_SESSION["exito"]="  $nombre_final se cargo correctamente";
    header("Location:panel.php?panel=mostrar&ver=generos");
    die();
?>