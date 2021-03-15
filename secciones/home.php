    <?php
        if(isset($_SESSION["permiso"])){
            $error = $_SESSION["permiso"];
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Error: </strong>
        <?= $error ?>.
    </div>
    <?php
            unset($_SESSION["permiso"]);
        }
    ?>
    <div class="container">
        <div class="pie-pagina">
            <img src="img/home/logo.png" alt="logo" class="img-fluid">
            <h1 class="titulo">Music festival</h1>
            <p class="fecha">25.11.19</p>
            <p id="contador" >Faltan <?= faltan(time()); ?> dias</p>
            <p class="fecha">Hipodromo de San Isidro | BS AS</p>
        </div>
    </div>
                    <!-- XXXXXXXXXXXXXXXXXXXXXX slide XXXXXXXXXXXXXXXXXXXXXXXXXXXXXx -->
    <article>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <?php
                    foreach($slides as $slide):  
                ?>
                <div class="carousel-item <?=$slide["clase"]; ?>">
                    <img class="d-block w-100 img-fluid" src="<?=$slide["img"]; ?>" alt="primer slide">
                </div>
                <?php
                    endforeach;
                ?>         
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">anterior</span>
                  </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">siguiente</span>
                  </a>
        </div><br>
    </article>
    <article>
        <div class="container">
            <div class="row">
                <?php

                    $query="SELECT RANKING , NOMBRE_CANCION , DURACION , NOMBRE_ARTISTA , NOMBRE_GENERO  
                                FROM CANCIONES C
                                    INNER JOIN ARTISTAS A 
                                        ON C.ID_ARTISTA = A.ID_ARTISTA
                                    INNER JOIN GENEROS G  
                                        ON G.ID_GENERO = C.ID_GENERO
                                WHERE C.ACTIVO ='TRUE' AND DESTACADOS = 1
                                ORDER BY RAND() LIMIT 6;";

                    //(C.ID_ARTISTA = A.ID_ARTISTA AND A.ACTIVO = TRUE)      
                    $resultado = $con -> query($query);
                ?>
                <h1 class="display-3 text-center">Canciones Destacadas</h1>
                <table class="table">
                    <tr style="font-size:25px;">
                        <td>Ranking</td>
                        <td>Nombre Cancion</td>
                        <td>Productor</td>
                        <td>Genero</td>
                        <td>Duracion</td>
                    </tr>

                <?php
                    foreach ($resultado as $rows) {
                ?>
                    <tr>
                        <td><?= $rows["RANKING"] ?></td>
                        <td><?= mostrar_nombre($rows["NOMBRE_CANCION"]) ?></td>
                        <td><?= mostrar_nombre($rows["NOMBRE_ARTISTA"]) ?></td>
                        <td><?= mostrar_nombre($rows["NOMBRE_GENERO"]) ?></td>
                        <td><?= $rows["DURACION"]; ?></td>
                    </tr>
                <?php      
                    }
                ?>
                </table>
            </div>
        </div>
    </article>
    <article class="my-4">
        <div class="container">
            <div class="row">
            <?php
                foreach($informacion as $info):  
            ?>
                <div class="col-12">
                    <div class="row">
                        <div class="col-6 <?=$info["clase"];?>">
                            <img src="<?= $info["img"]; ?>" alt="" class="img-fluid">
                        </div>
                        <div class="col-6 desc-home">
                            <h2><?=$info["head"] ?></h2>
                            <p><?= $info["descripcion"]?></p>
                        </div>
                    </div><br>
                </div><br>
            <?php
                endforeach;
            ?>    
            </div>
        </div>
        <br>
    </article>
    <?php
        if(isset($_SESSION["usuario"]["perfil"])){
    ?>
    <article>
        <div style="width:100%;background-color:grey;height: 50px;">
            <h2 class="container">Noticias</h2>
        </div>
        <div class="container">
        <?php
            
            $query = "SELECT * FROM NOTICIAS ORDER BY FECHA DESC;";
            $resultado = $con->query($query);
            foreach($resultado as $rows){
                $titulo = $rows["TITULO_NOTICIA"];
         ?>
            <div class="col-12"><br>
                <div class="row">
                   <!-- foto -->
                    <div class="col-6">
                        <img src="noticias/<?= $titulo ?>.jpg" alt="<?=$rows["TITULO_NOTICIA"]?>" title="<?=$rows["TITULO_NOTICIA"]?>" class="img-fluid">
                    </div>
                    <!-- titulo/noticia -->
                    <div class="col-6">
                        <div class="col-12">
                            <h3  class="titulos" style="font-size:30px;">
                                <?= ucwords(limpiar_guion($rows["TITULO_NOTICIA"])) ?>
                            </h3>
                        </div>
                        <div class="col-12">
                            <p style="font-size:25px;"><?=$rows["NOTICIA"] ?></p><br>
                            <p><?= $rows["FECHA"] ?> </p>
                        </div>
                    </div>
                </div>
            </div><br>
    <?php
            }
        }
    ?>
    </div>
    </article>
    <br>
        