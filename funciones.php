<?php
    require_once("pdo.php");
    //muestra un contador de dias faltantes
    function faltan($hoy){
        $ahora = date("d/m/Y",$hoy);//seteamos la hora
        
        $evento = mktime(0,0,0,11,25,2019); //dia del evento
        $dia_evento = date("d/m/Y",$evento);
            
        $fecha_evento=explode("/",$dia_evento);//sacamos las barras
        $fecha=explode("/",$ahora);
        //calculamos los dias    
        $anios=($fecha[2]-$fecha_evento[2]);
        $mes=($fecha[1]-$fecha_evento[1]);
        $dias=($fecha[0]-$fecha_evento[0]);
            
        $dias= -(($anios*365)+($mes*30.5)+($dias));
        //se muestra con intval que redondea    
        echo intval($dias);
    }
    //saca el guion bajo del nombre de las fotos
    function limpiar_guion($str){
        $texto=str_replace("_"," ",$str);
        return $texto;
    }
    //agarra  y levanta los txt con los links
    function link_pagina($ruta){
        if(file_exists($ruta)){
            $url = file_get_contents($ruta);
        }else{
            $url = "no se encuentra el link";
        }
        return $url;
    }
    //limpia textos
    function limpiar_texto($texto){
        $texto = nl2br(htmlentities(trim($texto)));
        return $texto;
    }
    //imprime la ruta de las fotos de artista
    function imprimir_ruta($nombre){
        if(is_file("secciones/djs/img/$nombre.jpg")){
            $url_imagen = "secciones/djs/img/$nombre.jpg";//ruta de la foto
        }else{
            $url_imagen = "img/opcional.jpg";//ruta de una foto opcional
        }
        return $url_imagen;
    }
    //imprime la ruta de las fotos de las noticias
    function imprimir_ruta_noticias($nombres){
        if(is_file("noticias/$nombres/$nombres.jpg")){
            $url_imagen = "noticias/".$nombres."/".$nombres.".jpg";//ruta de la foto
        }else{
            $url_imagen = "img/opcional.jpg";//ruta de una foto opcional
        }
        return $url_imagen;
    }
    //para limapiar el string
    function nombre_limpio($carpeta){
        $nombre = trim($carpeta);//espacios en blanco
        $nombre = strtolower($nombre);//minusculas
        $nombre = str_replace(" ","_",$nombre);//remplaza guion bajo por un espacio
        return $nombre;
    }
    //levanta las paginas del panel
    function levantar_paginas($pagina,$array_secciones){
        if(!empty($pagina)){     
            $seccion = $pagina;      
            if(empty($pagina)){      
                require_once("secciones/error.php"); 
            }
            if(array_key_exists($seccion,$array_secciones)){
                require_once("panel/$seccion.php");
            }else{
                require_once("secciones/error.php");
            }
        }else{
            header("Location:panel.php?panel=home_panel");
            die();
        }   
    }

    function mostrar_nombre($texto){
        $texto = str_replace("_"," ",$texto);
        $texto = ucwords($texto);
        return $texto;
    }
    
    function hasheo($pass , $salt){
        $pass .= $salt;
        return hash('md5',$pass);
    }

        




?>
