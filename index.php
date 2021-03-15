<?php
    require_once("configuracion.php");
    require_once("funciones.php");
    require_once("arrays.php");
    //include("pdo.php");
    require_once("pdo.php");
    
    
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Extremeland</title>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo/style.css">
    <meta name="author" content="Carlos Riveros">
</head>

<body class="letra home">
    <header>
        <nav>
            <div>
                <ul class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <?php
                                    foreach($links as $link => $pags):
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
                        </div>
                        <div class="col-3">
                            <?php
                                if(isset($_SESSION["usuario"])){//si no esta seteado no muestra
                                    if($_SESSION["usuario"]["perfil"] == "admin"){
                            ?>
                                    <li class="col-12 nav-item">
                                        <a class="nav-link" href="panel.php">Panel</a>
                                    </li>
                            <?php  
                                    }
                                }//termina if
                            ?>
                            <!-- aca va el panel -->
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <?php
                                    if(!isset($_SESSION["usuario"])){//si no esta seteado mostras lo comun
                                        foreach($linksreg as $linkreg => $pagsreg):
                                ?>
                                        <li class="col-6">
                                            <a class="navbar-text" style="font-size:25px;text-allign:center;" href="<?= $pagsreg ?>">
                                                <?= $linkreg; ?>
                                            </a>
                                        </li>
                                <?php
                                        endforeach;
                                    }else{//si esta seteado muestra deslogeo
                                ?>   
                                        <li class="col-4">
                                            <a class="navbar-text" href="index.php?seccion=datos" style="font-size:25px;"><?= $_SESSION["usuario"]["usuario"] ?></a>
                                        </li> 
                                        <li class="col-8">
                                            <a class="navbar-text" href="cerrar_sesion.php" style="font-size:25px;">cerrar sesion</a>
                                        </li>    
                                <?php 
                                    }
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                    if(isset($_SESSION["ok"])){
                ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <?= $_SESSION["ok"]; ?>
                        </div>
                <?php
                    }

                    // borramos el indice del $_SESSION
                    unset($_SESSION["ok"]);
                ?>
            </div>
        </div>
    </div>
    <?php
            //levanta paginas
            if(!empty($_GET["seccion"])){
                $seccion = $_GET["seccion"];//guardamos la seccion
                if(empty($_GET["seccion"])){//si esta vacia vamos a error.php
                    require_once("secciones/error.php");
                }
                if(array_key_exists($seccion,$secciones)){//lo llevamos a la seccion
                    require_once("secciones/$seccion.php");
                }else{
                    require_once("secciones/error.php");
                }
            }else{//si no encuentra nada lo mandamos directo a home
                header("Location:index.php?seccion=home");
                die();
            } 
        
        ?>
    <footer class="container-fluid">
        <div class="row">
            <div class="col-4 powered">
                <p>Powered by LITHOS.</p>
            </div>
            <div class="col-4">
                <img class="img-fluid logo-centrado" src="img/logo-footer.png" alt="">
            </div>
            <div class="col-4">
                <div class="row">
                    <?php 
                        foreach($redes as $red):   
                    ?>
                    <a class="col-3" href="<?= $red["url"] ?>" target="_blank" ><img src="<?= $red["img"] ?>" alt="" class="img-fluid redes-footer"></a>
                    <?php
                        endforeach;  
                    ?>
                </div>
            </div>
        </div>
    </footer>
    <!-- java script -->
    <script src="lib/jquery/jquery-3.3.1.min.js"></script>
    <script src="lib/popper/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
