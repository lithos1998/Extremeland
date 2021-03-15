<?php

    session_start();
    //si no llega nada
    if(empty($_POST)){
        $_SESSION["error"]="debe llenar los datos";
        header("Location:index.php?seccion=contacto");
        die();
    }
    //si no llega el nombre
    if(empty($_POST["nombre"])){
        $_SESSION["error"]="debe ingresar nombre";
        header("location:index.php?seccion=contacto");
        die();
    }
    //si no llega el apellido
    if(empty($_POST["apellido"])){
        $_SESSION["error"]="debe ingresar un apellido";
        header("location:index.php?seccion=contacto");
        die();
    }
    //si no llega el mail
    if(empty($_POST["mail"])){
        $_SESSION["error"]="debe ingresar un mail";
        header("location:index.php?seccion=contacto");
        die();
    }
    //si no llega la consulta
    if(empty($_POST["consulta"])){
        $_SESSION["error"]="debe ingresar algun tipo de consulta";
        header("location:index.php?seccion=contacto");
        die();
    }else{
        $opcion=end($_POST["consulta"]);
        //echo end($_POST["consulta"]);
        switch($opcion){
            case 1://opcion q corresponda
                break;
            case 2://opcion que corresponda
                break;
            case 3://opcion que corresponda
                break;
            case 4://opcion qu ecorresponda
                break;
        }
    }
    //termina y lo lleva a gracias.php
    header("location:index.php?seccion=gracias");
?>