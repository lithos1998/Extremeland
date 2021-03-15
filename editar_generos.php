<?php
    include("pdo.php");
    require_once("funciones.php");

    session_start();

    $nombre = $_POST["nombre"];                                                                                                                                                                                   
    $padre = $_POST["generos"];                                                                                                                                                                              
    $id = $_POST["id"];                                                                                                                                                                                       
        
    $sql = "UPDATE GENEROS SET NOMBRE_GENERO = '$nombre',
                                    PADRE = '$padre'
                    WHERE ID_GENERO = $id;";
    $count = $con -> exec($sql);
        
    $_SESSION["exito"]="se edito el genero correctamente";
    header("Location:panel.php?panel=mostrar&ver=generos");
        