<?php
    require_once("configuracion.php");
    require_once("funciones.php");
    require_once("arrays.php");
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
                            <li class="col-4 nav-item">
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
            levantar_paginas($_GET["panel"],$paneles);
        ?>
        <!-- java script -->
        <script src="lib/jquery/jquery-3.3.1.min.js"></script>
        <script src="lib/popper/popper.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>