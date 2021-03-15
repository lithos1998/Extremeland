<?php
    //includes
    require_once("configuracion.php");
    include("pdo.php");

    $id_usuario = $_SESSION["usuario"]["id"];
    $id = $_POST["id_artista"];
    //query de existencia de comentario
    $consulta = "SELECT COUNT(1) AS RESULT
                    FROM COMENTARIOS 
                    WHERE FECHA = DATE_FORMAT(now() , '%y-%m-%d') AND ID_USUARIO = $id_usuario AND ID_ARTISTA = $id;";
    $consulta = $con->query($consulta);
    $res = $consulta->fetch(PDO::FETCH_OBJ);
    $ok =  $res->RESULT;
    //se debe poder cargar solo un comentario por artista al dia (rango de 24 hs)
    //si el resultado de la query da 1 ya existe un comentario ese dia
    //si da 0 no existe un comentario y se puede cargar
    if($ok >= 1){
        header("Location:index.php?seccion=artistas&djs=destacados&filtro=destacadas&genero=todos&id=$id");
        $_SESSION["error"]="Ya hiciste un comentario a este artista ,intentalo en 24 hs";
        die();
    }else{
        //chequea si llegua el comentario
        if(empty($_POST["comentarios"])){
            header("Location:index.php?seccion=artistas&djs=destacados&filtro=destacadas&genero=todos&id=$id");
            $_SESSION["error"]="debe completar dejar un comentario";
            die();
        }
        //chequea si carga estrellas
        if(empty($_POST["estrellas"])){
            header("Location:index.php?seccion=artistas&djs=destacados&filtro=destacadas&genero=todos&id=$id");
            $_SESSION["error"]="debe dar una calificacion";
            die();
        }
        
        $comentario = $_POST["comentarios"];
        $estrella = $_POST["estrellas"];
        $fecha = date("y/m/d",time());
        //insert de datos
        $sql = "INSERT INTO COMENTARIOS (COMENTARIO , ESTRELLAS , ID_USUARIO , ID_ARTISTA , FECHA , ACTIVO)
                            VALUES ('$comentario' , $estrella , $id_usuario , $id , '$fecha' , 'TRUE');";
        $count = $con->exec($sql);
        //volvemos con exito
        $_SESSION["exito"]="comentario enviado exitosamente ";
        header("Location:index.php?seccion=artistas&djs=destacados&filtro=destacadas&genero=todos&id=$id");
        die();
    }

?>