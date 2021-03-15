<?php
    //includes
    include("pdo.php");
    include("funciones.php");
    require_once("configuracion.php");
    //chequeo de mail
    if(!empty($_POST["mail"])){
        //mail esta seteado
        $m = $_POST["mail"];
        //chequeo si es un formato de mail
        if(!filter_var($m,FILTER_VALIDATE_EMAIL)){
            $_SESSION["mensaje"]="el mail no es valido";
            header("Location:index.php?seccion=registro");//no es un mail
            die();
        }
        //query
        $sql = "SELECT COUNT(*) as resultado
                        FROM USUARIOS
                        WHERE MAIL = '$m';";
        $query = $con->query($sql);
        $res = $query->fetch(PDO::FETCH_OBJ);
        $res = $res->resultado;
        //chequeo si existe el mail
        if($res == 0){
            //no existe el mail , se guarda
            $mail = $_POST["mail"];
        }else{
            //si existe el mail , no se puede cargar
            $_SESSION["mensaje"]="Este mail ya esta en uso";
            header("Location:index.php?seccion=registro");
            die();
        }
    }else{
        //no se ingreso un mail
        $_SESSION["mensaje"]="Debe ingresar un mail";
        header("Location:index.php?seccion=registro");
        die();
    }
    //chequeo usuario
    if(empty($_POST["user"])){
        $_SESSION["mensaje"]="Debe ingresar un usaurio";
        header("Location:index.php?seccion=registro");
        die();
    }else{
        $user = $_POST["user"];
    }
    //chequeo password
    if(!empty($_POST["password"])){
        $pass = $_POST["password"];
        //se crea id unico
        $salt = uniqid();
        //se hashea (ver funciones.php)
        $pass_hash = hasheo($pass,$salt);
    }else{
        //no seteo la contraseña
        $_SESSION["mensaje"]="Debe ingresar una contraseña";
        header("Location:index.php?seccion=registro");
        die(); 
    }
    //insert de valores
    $sql = "INSERT INTO USUARIOS(USUARIO , MAIL , PASSWORD , SALT , ACTIVO , PERFIL , ID_PERFIL)
                    VALUES('$user', '$mail' , '$pass_hash','$salt' , 1 , 'usuario' , 1235);";
    $count = $con->exec($sql); 
    //todo es correcto
    //si la carga se hace desde el panel (por el admin) vuelve al panel a "mostrar"
    //si la carga la hace un usuario registrandose va directo al login a loguearse
    if($_SESSION["usuario"]["perfil"] == "admin"){
        $_SESSION["exito"]="se cargo al usuario correctamente";
        header("Location:panel.php?panel=mostrar&ver=usuarios");
    }else{
        header("Location:index.php?seccion=login");
    }
    
?>