<?php
    session_start();
    //guardamos el id de la cuenta
    
    $cuenta = $_SESSION["usuario"]["mail"];
    //preguntamos si esta vacio y si existe la carpeta
    
    if(empty($_SESSION["usuario"]["usuario"]) || !is_dir("usuarios/$cuenta")){
        $SESSION["error"]="ups , a ocurrido un error intentelo de nuevo mas tarde";
        header("Location: index.php?seccion=dar_baja");
        die();
    }
    
    //guardamos la ruta
    $carpeta = "usuarios/$cuenta";
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
    session_destroy();

    session_start();
    $_SESSION["ok"] = "Se a borrado correctamente su cuenta $cuenta";
    header("Location:index.php?seccion=home");
    
    die();


