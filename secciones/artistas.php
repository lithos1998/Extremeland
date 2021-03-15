<?php
    require_once("arrays.php");
    require_once("funciones.php");
    require_once("configuracion.php");

    //controla las variables que maneja la url
    //url por defecto que llega a artista
    //index.php?seccion=artistas&djs=destacados&filtro=destacadas&genero=todos
    $filtros = $_GET["filtro"];
    $generos = $_GET["genero"];
    if(isset($_GET["id"])){
        $id_artis = "&id=".$_GET["id"]."";
    }else{
        $id_artis = "";
    }
?>
<div class="caja">
    <h2 class="container">Artistas</h2>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-3 ">
            <div>
               <!-- menu de filtros -->
                <ul class="my-1 container jumbotron menu-orden">
                    <li class="menu-li"><a href="index.php?seccion=artistas&djs=destacados&filtro=destacadas&genero=<?=$generos?><?=$id_artis?>" class="menu-art">destacadas</a></li>
                    <li class="menu-li"><a href="index.php?seccion=artistas&djs=destacados&filtro=menor_mayor&genero=<?=$generos?><?=$id_artis?>" class="menu-art">mayor a menor</a></li>
                    <li class="menu-li"><a href="index.php?seccion=artistas&djs=destacados&filtro=<mayor_meno></mayor_meno>r&genero=<?=$generos?><?=$id_artis?>" class="menu-art">menor a mayor</a></li>
                    <li class="menu-li"><a href="index.php?seccion=artistas&djs=destacados&filtro=a_z&genero=<?=$generos?><?=$id_artis?>" class="menu-art">a -> z </a></li>
                    <li class="menu-li"><a href="index.php?seccion=artistas&djs=destacados&filtro=z_a&genero=<?=$generos?><?=$id_artis?>" class="menu-art">z -> a</a></li>
                </ul>
            </div>
            <div>
            <!-- menu de generos -->
            <?php
                $sql = "SELECT * 
                          FROM GENEROS
                          WHERE PADRE = 0 AND GENERO_ACTIVO = 'TRUE' ";

                $categorias = $con->query($sql);
            ?>
                <ul class="my-1 container jumbotron menu-orden">
                    <li class="menu-li"><a href="index.php?seccion=artistas&djs=destacados&filtro=<?=$filtros?>&genero=todos<?=$id_artis?>" class="menu-art">Todos</a></li>
                <?php foreach($categorias as $cat){?>
                    <li class="menu-li"><a href="index.php?seccion=artistas&djs=destacados&filtro=<?=$filtros?>&genero=<?= $cat['ID_GENERO'] ?><?=$id_artis?>" class="menu-art"><?= mostrar_nombre($cat['NOMBRE_GENERO']); ?></a>
                    <?php
                        $sql2 = 'SELECT  *  
                                   FROM  GENEROS
                                   WHERE PADRE ='.$cat["ID_GENERO"] .' AND GENERO_ACTIVO ="TRUE" ';
                        $resultado2 = $con->query($sql2);
                        if($resultado2->rowCount() > 0){ 
                    ?>
                        <ul>
                        <?php foreach($resultado2 as $subcat){?>
                            <li class="menu-li"><a href="index.php?seccion=artistas&djs=destacados&filtro=<?=$filtros?>&genero=<?= $subcat['ID_GENERO'] ?><?=$id_artis?>" class="menu-art"><?= mostrar_nombre($subcat['NOMBRE_GENERO']); ?></a>
                            <?php 
                                
                                $sql3 = 'SELECT * 
                                           FROM  GENEROS
                                           WHERE PADRE ='.$subcat["ID_GENERO"].'';
								$resultado3 = $con->query($sql3);
								if($resultado3->rowCount() > 0){ 
                            ?>
                                <ul>
                                <?php foreach($resultado3 as $subsubcat){?>
                                    <li class="menu-li"><a href="index.php?seccion=artistas&djs=<?=$filtros?>&genero=<?= $subsubcat['ID_GENERO'] ?><?=$id_artis?>" class="menu-art"><?= mostrar_nombre($subsubcat['ID_GENERO']); ?></a></li>
                                <?php }?>
                                </ul>
                                <?php }?>
                            </li>
                            <?php }?>
                        </ul>
                        <?php }?>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <div>
               <!-- menu artistas -->
                <ul class="my-1 container jumbotron menu-cuadro">
                    <li class="menu-li"><a href="index.php?seccion=artistas&djs=destacados&filtro=<?=$filtros?>&genero=<?=$generos?>" class="menu-art">Volver</a></li>
                    <?php
                
                    $query = "SELECT * 
                                FROM ARTISTAS 
                                WHERE ARTISTA_ACTIVO = 'TRUE'
                                ORDER BY NOMBRE_ARTISTA ASC;";
                    $resultado = $con->query($query);
                    
                    foreach ($resultado as $rows){ 
                ?>
                    <li class="menu-li"><a href="index.php?seccion=artistas&djs=destacados&filtro=<?=$filtros?>&genero=<?=$generos?>&id=<?=$rows["ID_ARTISTA"];?>" class="menu-art">
                            <?= ucwords(limpiar_guion($rows["NOMBRE_ARTISTA"])) ?></a></li>
                    <?php
                    }
                ?>
                </ul>
            </div>
        </div>
        <div class="col-9">
            <?php
            
            //levanta paginas
            if(!empty($_GET["djs"])){
                $seccion = $_GET["djs"];//guardamos la seccion
                if(empty($_GET["djs"])){//si esta vacia vamos a error.php
                    require_once("error.php");
                }
                if(file_exists("secciones/djs/$seccion.php")){//lo llevamos a la seccion(por ahora solo 0)
                    require_once("secciones/djs/$seccion.php");
                }else{
                    require_once("error.php");
                }
            }else{//si no encuentra nada lo mandamos directo a artitas 
                require_once("secciones/artistas.php");
            } 
        
        ?>
        </div>

    </div>
    <br>
</div>
