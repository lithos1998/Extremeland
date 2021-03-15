<?php
    //includes
    require_once("configuracion.php");
    include("pdo.php");
    //chequeos
    $id = $_POST["id"];
    if(!empty($_POST["titulo"])){//si no llega el titulo
        $tit = $_POST["titulo"];
    }else{
        $_SESSION["error"]="el titulo no puede estar vacio";
        header("Location:panel.php?panel=cargar&ver=noticias&edit=$id");
        die();
    }
    if(!empty($_POST["noticia"])){//si no llega la noticia
        $noticia = $_POST["noticia"];
    }else{
        $_SESSION["error"] = "la noticia no puede llegar vacia";
        header("Location:panel.php?panel=cargar&ver=noticias&edit=$id");
        die();
    }

    //cambiamos nombre imagen
    $query = "SELECT TITULO_NOTICIA
                FROM NOTICIAS
                WHERE ID_NOTICIA = $id;";
    $query = $con->query($query);
    $res = $query->fetch(PDO::FETCH_OBJ);
    $res = $res->TITULO_NOTICIA;

    rename("noticias/$res.jpg", "noticias/$tit.jpg");


    //FECHA DEL UPDATE
    $fecha = date("y/m/d",time());
    //update
    $update = "UPDATE NOTICIAS SET TITULO_NOTICIA = '$tit',
                                   NOTICIA = '$noticia'
                    WHERE ID_NOTICIA = $id;";
    $update = $con -> exec($update);

    //todo correcto
    $_SESSION["exito"]=" $tit se edito correctamente";
    header("Location:panel.php?panel=mostrar&ver=noticias");
    die();
    

?>