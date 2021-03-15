<?php
     session_start();
    //guardamos el id dela noticia
    $noticias = $_POST["id"];
    //preguntamos si esta vacio y si existe la carpeta
    if(empty($_POST["id"]) || !is_dir("noticias/$noticias")){
        $_SESSION["mensaje"]="no existe";
        header("Location: panel.php?panel=subir_noticias");
        die();
    }
    //guardamos la ruta
    $carpeta = "noticias/$noticias";
    //entramos en la carpeta
    $directorio = opendir($carpeta);
    //recorremos el contenido
    while($contenido = readdir($directorio)):
        if($contenido != "." && $contenido != ".."){
            //borraamos los archivos q estan en cada carpeta
            unlink("$carpeta/$contenido"); 
        }
    endwhile;
    //sale de la carpeta
    rmdir($carpeta);//borramos la carpeta
    //volvemos a control.php
    
    $_SESSION["ok"]="se borro la noticia";
    header("Location:panel.php?panel=subir_noticias");
    die();

