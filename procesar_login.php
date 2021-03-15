<?php
    //includes
    require_once("funciones.php");
    include("pdo.php");
    session_start();
    //chequeo mail
    if(empty($_POST["mail"])){
        //falta mail
        $_SESSION["mensaje"]="debe cargar un mail";
        header("Location:index.php?seccion=login");
        die();
    }else{
        $mail = $_POST["mail"];
        //valida si es un mail (ej "@mail.com")
        if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
            $_SESSION["mensaje"]="no es un mail valido";
            header("Location:index.php?seccion=login");
            die();
        }
    }
    if(empty($_POST["contraseña"])){
        //falta contraseña
        $_SESSION["mensaje"]="debe cargar una contraseña";
        header("Location:index.php?seccion=login");
        die();
    }else{
        $contrasenia = $_POST["contraseña"];
    }
    //chequeo si existe la cuenta(mail)
    $query = "SELECT COUNT(1) AS RESUL
                FROM USUARIOS 
                WHERE MAIL = '$mail' AND ACTIVO = 1 ;";
    $query = $con->query($query);
    $res = $query->fetch(PDO::FETCH_OBJ);
    $res = $res->RESUL;
    if($res == 1){
        //si existe el mail
        $sql = "SELECT ID_USUARIO , USUARIO , MAIL , PASSWORD , ACTIVO , SALT , NOMBRE_PERFIL
		      FROM USUARIOS U 
              INNER JOIN PERFILES P
              ON U.ID_PERFIL = P.ID_PERFIL
              WHERE ACTIVO = 1 AND MAIL = '$mail';";
        $resultado = $con->prepare($sql); 
        $resultado->execute();
        $datos = $resultado->fetch(PDO::FETCH_OBJ);
        
        $id = $datos->ID_USUARIO;
        $user = $datos->USUARIO;
        $mail_usuario = $datos->MAIL;
        $password = $datos->PASSWORD;
        $activo = $datos->ACTIVO;
        $salt = $datos->SALT;
        $perf = $datos->NOMBRE_PERFIL;

        if(isset($id)){
            if(hasheo($contrasenia,$salt) == $password){
                $_SESSION["usuario"] = [
                    "id" => $id,
                    "mail" => $mail_usuario,
                    "usuario" => $user,
                    "perfil" => "$perf"
                ];	
    
                $_SESSION["ok"] = "Bienvenido $user";
                header("Location:index.php?seccion=home");
                die();
            }else{
                //contraseña incorrecta
                $_SESSION["mensaje"]="el mail o la contraseña son incorrectos";
                header("Location:index.php?seccion=login");
                die();
            }
        }
    }else{
        //mail incorrecto
        $_SESSION["mensaje"]="el mail o la contraseña son incorrectos";
        header("Location:index.php?seccion=login");
        die();
    }