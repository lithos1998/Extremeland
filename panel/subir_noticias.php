<?php
    require_once("configuracion.php");
    require_once("funciones.php");
    require_once("arrays.php");

   
?>

<div class="container my-2 justify-content-center">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 justify-content-center">Cargar noticias</h1>
        </div>
    </div>
</div>
<div class="container">
    <?php
        // verificamos el tipo de error que viene desde la pagina de carga , atravez de la url por GET
        
        if(isset($_SESSION["mensaje"])){
            $mensaje = $_SESSION["mensaje"];
    
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Error: </strong>
        <?= $mensaje ?>.
    </div>
    <?php
            unset($_SESSION["mensaje"]);
        }
        if(isset($_SESSION["ok"])){
            $ok = $_SESSION["ok"];
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>OK : </strong>
        <?= $ok ?>.
    </div>
    <?php
            unset($_SESSION["ok"]);
        }
    ?>
    
</div>
<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
<div class="container my-2">
    <h1 class="display-4">Noticias</h1>
    <!-- chequeo del estado de borrado -->
    <div class="container">
    <?php
        if(isset($_SESSION["mensaje"])){
            $mensaje = $_SESSION["mensaje"];
    ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                   </button>
                   <strong>Error: </strong> <?= $mensaje ?>.
                </div>
    <?php   
            unset($_SESSION["mensaje"]);
            //si esta todo ok
        }else if(isset($_SESSION["ok"])){
            $mensaje = $_SESSION["ok"];
    ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Éxito: </strong> <?= $mensaje ?>.
                </div>
    <?php   
            unset($_SESSION["ok"]);
            }
    ?>
    
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>titulo</th>
                        <th>noticia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        $carpeta = opendir("noticias");
                        while($carpetas = readdir($carpeta)):
                            if($carpetas != "." && $carpetas != ".."):
                            $noticia ="noticias/$carpetas/noticia.txt";
                        
                    ?>
                       
                        <td>
                            <img style="width:70px; height:70px;" src="<?= imprimir_ruta_noticias($carpetas) ?>" alt="<?= $carpetas ?>" class="img-fluid">
                        </td>
                        <td>
                            <?= ucfirst(limpiar_guion($carpetas)) ?>
                        </td>
                        <td>
                            <p><?= link_pagina($noticia) ?></p>
                        </td>
                        <td>
                            <form action="borrar_noticia.php" method="post">
                                <input type="hidden" name="id" value="<?= $carpetas ?>">
                                <button type="submit" class="btn btn-danger">
                                    Borrar
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                                endif;
                        endwhile;
                        closedir($carpeta);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


