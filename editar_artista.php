<?php
    session_start();
    require_once("funciones.php");
    include("pdo.php");
    
    $id = $_POST["id"];

    $sql = "SELECT NOMBRE_ARTISTA
                 FROM ARTISTAS
                 WHERE ID_ARTISTA = $id;";
    $query = $con->query($sql); 
    $query = $query->fetch(PDO::FETCH_OBJ);
        
    $nombre_viejo = $query->NOMBRE_ARTISTA;
    $nombre = $_POST["nombre"];
    $link = $_POST["link"];
    $desc = $_POST["descripcion"];
    
    if(empty($_POST["nombre"]) || empty($_POST["link"] || empty($_POST["descripcion"]))){
        $_SESSION["error"]="debe llenar todos los campos";
        header("Location:panel.php?panel=cargar&ver=artistas&edit=$id");
        die();
    }

    //cambiamos nombre imagen
    rename("secciones/djs/img/$nombre_viejo.jpg", "secciones/djs/img/$nombre.jpg");

    
    /*
    if(!empty($_FILES) && ($_FILES["imagen"]["size"] == 0)){
        //si no llega imagen se remplaza el nombre
        rename("secciones/djs/img/$nombre_viejo.jpg" , "secciones/djs/img/$nombre");
    }else{
        //si llega hay q borrar la anterior y subir esta
        
        
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
    }
*/
    $sql = "UPDATE ARTISTAS SET NOMBRE_ARTISTA = '$nombre',
                                DESCRIPCION_ARTISTA = '$desc',
                                LINK_ARTISTA  = '$link',
                                ARTISTA_ACTIVO = 'TRUE'
                WHERE ID_ARTISTA = $id;";
    $count = $con -> exec($sql);

    //lo mandamos al panel de control
    $_SESSION["exito"]=" $nombre se edito correctamente";
    header("Location:panel.php?panel=mostrar&ver=artistas");
    die();
?>




