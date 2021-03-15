<?php
    session_start();
    //guardamos el id del artista
    $artistas = $_POST["id"];
    //preguntamos si esta vacio y si existe la carpeta
    if(empty($_POST["id"]) || !is_dir("artistas/$artistas")){
        $SESSION["error"]="ups , a ocurrido un error intentelo de nuevo mas tarde"
        header("Location: panel.php?panel=control");
        die();
    }
    //guardamos la ruta
    $carpeta = "artistas/$artistas";
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
    $SESSION["ok"]="Se a borrado correctamente a $artistas ";
    header("Location:panel.php?panel=control");
    die();

