<?php
    require_once("funciones.php");
    require_once("configuracion.php");
    session_start();
    //chequeos
    //si los campos estan vacios
    if(empty($_POST["titulo"]) || empty($_POST["noticia"])){
        $_SESSION["error"]="Debe ingresar todos los campos";
        header("Location:panel.php?panel=cargar&ver=noticias");
        die();
    }
    //fecha de carga
    $fecha_carga = date("y/m/d",time());
    
    $titulo = $_POST["titulo"];
    $noticia = $_POST["noticia"];
    
    // si la imagen llega vacia
    if(!empty($_FILES) && ($_FILES["imagen"]["size"] == 0)){
        $_SESSION["error"]="el formato de la imagen es erroneo";
        header("Location:panel.php?panel=cargar&ver=noticias");
        die();
    }        
    //guardamos el nombre de la imagen
    $imagen = $_FILES["imagen"];
    //chequeamos tipo de imagen
    if($imagen["type"] == "image/jpeg"){
        $formato_imagen = "jpg";
        $imagen_original = imagecreatefromjpeg($imagen["tmp_name"]);
    }else{
        $_SESSION["mensaje"]="el formato de la imagen es erroneo";
        header("Location: panel.php?panel=cargar&ver=noticias");
        die();
    }
    //el titulo que llega del form
    $titulo_cargado = $_POST["titulo"];
    //el nombre que llega del form , pero limpio
    $titulo_final = nombre_limpio($_POST["titulo"]);
    
    //la imagen
    //asignamos valores
    // valores originales de la imagen original
    $ancho_original = imagesx($imagen_original);
    $alto_original = imagesy($imagen_original);
    // valores nuevos
    $ancho_nuevo = 600;
    //calculamos el otro valor
    $alto_nuevo = ($ancho_nuevo * $alto_original) / $ancho_original;
    //round , redondea el valor de la imagen
    $alto_nuevo = round($alto_nuevo);
    // creaamos un lienzo nuevo
    $imagen_nueva = imagecreatetruecolor($ancho_nuevo,$alto_nuevo);
    //guardamos el destino de la foto
    $destino_imagen = "noticias/$titulo_final.$formato_imagen";
    //si el tipo coincide ,copiamos la imagen en el lienzo , creamos la foto 
    if($imagen["type"] == "image/jpeg"){
        // copiar la imagen original en el lienzo nuevo
        $nuevo_lienzo = imagecopyresampled($imagen_nueva,$imagen_original,0,0,0,0,$ancho_nuevo,$alto_nuevo,$ancho_original,$alto_original);
        //creamos la foto para nuestro servidor
        $imagen_actual = imagejpeg($imagen_nueva,$destino_imagen,75);
        // borramos la imagen q esta almazenada en la memoria
        imagedestroy($imagenCopia);
    }
    //movemos la foto al servidor
    move_uploaded_file($_FILES["imagen"]["tmp_name"],"noticias/$titulo_final.jpg");
    //mostramos el nombre al usuario
    $titulo_final = ucfirst(strtolower($titulo_final));

    $sql = "INSERT INTO NOTICIAS(NOMBRE_NOTICIA,NOTICIA,FECHA,ACTIVA)
                VALUES('$titulo_final' , '$noticia', '$fecha_carga' , 1);";
    $count = $con -> exec($sql);

    //lo mandamos al panel de control
    $_SESSION["exito"]="se cargo la noticia correctamente";
    header("Location:panel.php?panel=mostrar&ver=noticias");
?>
