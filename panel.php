<?php
    //includes
    require_once("configuracion.php");
    require_once("funciones.php");
    require_once("arrays.php");    
    //solo usuario con perfil de admin puede acceder al panel 
    //y todas sus funcionalidades
    if($_SESSION["usuario"]["perfil"] != "admin"){
        //si no es admin lo enviamos a home
        $_SESSION["permiso"] = "No tenés permisos para acceder a esa sección";
        header("Location:index.php?seccion=home");
        die();
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Panel</title>
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="estilo/style.css">
        <meta name="author" content="Carlos Riveros">
    </head>
    <body class="letra home">
        <header>
            <nav>
                <div class="container">
                    <ul class="container">
                        <div class="row">
                        <?php
                            foreach($linkPanel as $link => $pags):
                        ?>
                            <li class="col-2 nav-item">
                                <a class="nav-link" href="<?= $pags ?>">
                                    <?= $link; ?>
                                </a>
                            </li>
                        <?php
                            endforeach;
                        ?>
                        </div>
                    </ul>
                </div>
            </nav>
        </header>
        <?php
            //funcion para levantar paginas
            levantar_paginas($_GET["panel"],$paneles);
        ?>
        <!-- java script -->
        <script src="lib/jquery/jquery-3.3.1.min.js"></script>
        <script src="lib/popper/popper.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>