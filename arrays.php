<?php
//XXXXXXXXXXXXXXXXXXXXXXXXXXXX SECCIONES DEL SITIO WEB          
        $secciones=[];
        
        $secciones = [
            "home" => "index.php?seccion=home",
            "artistas" => "index.php?seccion=artistas",
            "contacto" => "index.php?seccion=contacto",
            "gracias"=>"index.php?seccion=gracias",
            "panel" => "panel.php",
            "registro" => "index.php?seccion=registro",
            "login" => "index.php?seccion=login",
            "datos" => "index.php?seccion=datos",
            "dar_baja" => "index.php?seccion=dar_baja"
        ];
//XXXXXXXXXXXXXXXXXXXXXXXXXX NAV lo que muestra el nav
        $links=[
            "Home"=>"index.php?seccion=home",
            "Artistas"=>"index.php?seccion=artistas&djs=destacados&filtro=destacadas&genero=todos",
            "Contacto"=>"index.php?seccion=contacto"
            //"Panel"=>"panel.php?panel=control"
        ];
//XXXXXXXXXXXXXXXXXXXXXXXX SECCIONES DE ARTISTAS
        $djs=[];

                $djs = [
                    "destacados" => "index.php?seccion=artistas&djs=destacados",
                    "artista" => "index.php?seccion=artistas&djs=artista"
                ];
//XXXXXXXXXXXXXXXXXXXXXXlink de registro 
        $linksreg=[
            "registrate"=>"index.php?seccion=registro",
            "login"=>"index.php?seccion=login"
        ];
        
//XXXXXXXXXXXXXXXXXXXXXXsecciones del panel
        $paneles=[];

        $paneles = [
            //"panel" => "panel.php?panel=.....",
            "home_panel" => "panel.php?panel=home_panel",
            "cargar" => "panel.php?panel=cargar",
            "mostrar" => "panel.php?panel=cargar",
            "subir_noticias" => "panel.php?panel=subir_noticia",
            "usuarios" => "panel.php?panel=usuarios",
            "comentarios" => "panel.php?panel=comentarios"
        ];
//XXXXXXXXXXXXXXXXXXXXXXXX SECCIONES PANEL lo que muestra el nav del panel
        $linkPanel = [
            //"Panel" => "panel.php?panel=.......",
            "Home" => "panel.php?panel=home_panel",
            "Cargar" => "panel.php?panel=cargar&ver=canciones",
            "Mostrar" => "panel.php?panel=mostrar&ver=canciones",
            "Volver" => "index.php?seccion=home"
        ];
//XXXXXXXXXXXXXXXXXXXXXXXXX SLIDES      
        $slides=[];

        $slides[]=["img"=>"img/home/slide1.jpg","clase"=>"active"];
        $slides[]=["img"=>"img/home/slide2.jpg"];
//XXXXXXXXXXXXXXXXXXXXXXXXX REDES FOOTER
        $redes=[];

        $redes[]=[
            "img"=>"img/fofb.jpg",
            "url"=>"https://www.facebook.com"
        ];
        $redes[]=[
            "img"=>"img/fotw.jpg",
            "url"=>"https://twitter.com/"
        ];
        $redes[]=[
            "img"=>"img/foyt.jpg",
            "url"=>"https://www.youtube.com/"
        ];
        $redes[]=[
            "img"=>"img/foig.png",
            "url"=>"https://www.instagram.com/"
        ];
//XXXXXXXXXXXXXXXXXXXXXXXXX INFORMACION HOME
        $informacion=[];

        $informacion[]=[
            "img"=>"img/home/festival.jpg",
            "head"=>"Extremeland",
            "descripcion"=>"Por Primera vez en Argentina en el Hipodromo de San Isidro el 25 de noviembre mas de 25 dj , 4 excenarios a puro bass music , estallado line up con un cierre b2b entre los exponentes VIRTUAL RIOT,BARELY ALIVE y DUBLOADZ . Grandes artistas influyentes en la escena mundial se reunen para dar a los amantes del dubstep , drum and bass y todos sus subgeneros en un dia asegurado a puro HEADBANGING."
        ];
        $informacion[]=[
            "img"=>"img/home/gente.jpg",
            "head"=>"Festival",
            "descripcion"=>"Creemos...<br>
            En crear una realidad ,un sueño relacionado positivamente con nuestro entorno , con los unos y los otros 'hagamos algo bueno hoy y lo agradeceremos mañana'.",
            "clase"=>"order-2"
        ];
        $informacion[]=[
            "img"=>"img/home/mapa.jpg",
            "head"=>"Mapa",
            "descripcion"=>"El festival cuenta con playas de estacionamientos , 4 accesos numerosos puntos de recarga de agua , baños estrategicamente ubicados , contamos con muy buena seguridad y puntos de primeros auxilios para ser atendido , tambien contamos con planes de evacuacion , un patio de comidas con la mayor variedad gastronomica y un puesto de merchandising oficial de Extremeland"
        ];
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX registro
       
        //CHECKBOX
        $opciones=[];

        $opciones[]=[
            "opcion"=>"1",
            "contenido"=>"informacion"
        ];
        $opciones[]=[
            "opcion"=>"2",
            "contenido"=>"devolucion"
        ];
        $opciones[]=[
            "opcion"=>"3",
            "contenido"=>"preguntas frecuentes"
        ];
        $opciones[]=[
            "opcion"=>"4",
            "contenido"=>"otro"
        ];
        //FORMULARIO
        $formulario=[];

        $formulario[]=[
            "dato"=>"nombre",
        ];
        $formulario[]=[
            "dato"=>"apellido"
        ];
        $formulario[]=[
            "dato"=>"mail",
            "placeholder"=>"ejemplo@mail.com",
            "small"=>' id="helpId" class="col-sm-3 text-muted">debe ser un correo valido'
        ];
        $formulario[]=[
            "dato"=>"telefono"
        ];

          
 
?>