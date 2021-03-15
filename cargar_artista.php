<?php
    session_start();
    include("pdo.php");
    require_once("funciones.php");
    //chequeos
    //si los campos estan vacios
    if(empty($_POST["nombre"]) || empty($_POST["link"] || empty($_POST["descripcion"]))){
        $_SESSION["error"]="debe llenar todos los campos";
        header("Location:panel.php?panel=cargar&ver=artistas");
        die();
    }

    $nombre_artista = nombre_limpio($_POST["nombre"]);
    $link = $_POST["link"];
    $descripcion = $_POST["descripcion"];
    
    

    // si la imagen llega vacia
    if(!empty($_FILES) && ($_FILES["imagen"]["size"] == 0)){
        $_SESSION["error"]="debe cargar una imagen";
        header("Location:panel.php?panel=cargar&ver=artistas");
        die();
    }        
    //guardamos el nombre de la imagen
    $imagen = $_FILES["imagen"];
    //chequeamos tipo de imagen
    if($imagen["type"] == "image/jpeg"){
        $formato_imagen = "jpg";
        $imagen_original = imagecreatefromjpeg($imagen["tmp_name"]);
    }else{
        $_SESSION["error"]="el tipo de imagen es incorrecto";
        header("Location: panel.php?panel=cargar");
        die();
    }
    //el nombre que llega del form
    $nombre_cargado = $_POST["nombre"];
    //el nombre que llega del form , pero limpio
    $nombre_final = nombre_limpio($_POST["nombre"]);
    
    //la imagen
    //asignamos valores
    // valores originales de la imagen original
    $ancho_original = imagesx($imagen_original);
    $alto_original = imagesy($imagen_original);
    // valores nuevos
    $ancho_nuevo = 300;
    //calculamos el otro valor
    $alto_nuevo = ($ancho_nuevo * $alto_original) / $ancho_original;
    //round , redondea el valor de la imagen
    $alto_nuevo = round($altoNuevo);
    // creaamos un lienzo nuevo
    $imagen_nueva = imagecreatetruecolor($ancho_nuevo,$alto_nuevo);
    //guardamos el destino de la foto
    $destino_imagen = "secciones/djs/img/$nombre_final.$formato_imagen";
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
    move_uploaded_file($_FILES["imagen"]["tmp_name"],"secciones/djs/img/$nombre_final.jpg");
    //mostramos el nombre al usuario
    $nombre_final = ucfirst(strtolower($nombre_final));
    //lo mandamos al panel de control

    $sql = "INSERT INTO ARTISTAS(NOMBRE_ARTISTA,DESCRIPCION_ARTISTA,LINK_ARTISTA,ARTISTA_ACTIVO)
                VALUES('$nombre_artista' , '$descripcion', '$link' , 'TRUE');";
    $count = $con -> exec($sql);
    
    $_SESSION["exito"]="  $nombre_final se cargo correctamente";
    header("Location:panel.php?panel=mostrar&ver=artistas");
    die();
?>
