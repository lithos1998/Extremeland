<?php
    include("pdo.php");
    require_once("funciones.php");

    session_start();

    $id = $_POST["id"];
    //chequeos
    //si los campos estan vacios
    if(empty($_POST["user"])){
        $sql = "SELECT USUARIO
                    FROM USUARIOSS
                    WHERE ID_USUARIO = $id;";
        $count = $con -> query($sql);
        $resultado = $count->fetch(PDO::FETCH_OBJ);
        $user = $resultado->USUARIO;
    }else{
        $user = nombre_limpio($_POST["user"]);
    }

    if(empty($_POST["mail"])){
        $sql = "SELECT MAIL
                    FROM USUARIOS
                    WHERE ID_USUARIO = $id;";
        $count = $con -> query($sql);
        $resultado = $count->fetch(PDO::FETCH_OBJ);
        $mail = $resultado->MAIL;
    }else{
        $mail = $_POST["mail"];
    }
    //contraseña
    if(empty($_POST["password"])){
        $sql = "UPDATE USUARIOS SET USUARIO = '$user',
                                    MAIL = '$mail'
                    WHERE ID_USUARIO = $id;";
        $count = $con -> exec($sql);
    }else{
        $sql = "SELECT SALT
                    FROM USUARIOS
                    WHERE ID_USUARIO = $id;";
        $count = $con -> query($sql);
        $resultado = $count->fetch(PDO::FETCH_OBJ);
        $salt = $resultado->SALT;
        $password = $_POST["password"];
        $pass = hasheo($password,$salt);
        //update
        $sql = "UPDATE USUARIOS SET USUARIO = '$user',
                                    MAIL = '$mail',
                                    PASSWORD = '$pass'
                    WHERE ID_USUARIO = $id;";
        $count = $con -> exec($sql);
    }

    if($_SESSION["usuario"]["perfil"] == "admin"){
        $_SESSION["exito"]="se edito al usuario correctamente";
        header("Location:panel.php?panel=mostrar&ver=usuarios");
    }else{
        header("Location:index.php?seccion=datos");
    }

    
    