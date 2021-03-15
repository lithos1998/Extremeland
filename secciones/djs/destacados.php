<?php
    //aca se define q variable llega y como se ordenan las canciones(por defecto salen destacadas)
    switch($_GET["filtro"]){
        case "destacadas":
            if(isset($_GET["id"])){
                $orden = " ORDER BY RANKING";
            }else{
                $orden = " AND DESTACADOS = 1 ORDER BY RANKING";//se ordenan por ranqueo de mejor cancion;
                      // AND RANKING <= 25
            }
            break;
        case "menor_mayor":
            $orden = " ORDER BY RANKING";//MAYOR MENOR
            break;
        case "mayor_menor":
            $orden = " ORDER BY RANKING DESC";// MENOR MAYOR
            break;
        case "a_z":
            $orden = " ORDER BY NOMBRE_CANCION ASC";//orden alfabetico
            break;
        case "z_a":
            $orden = " ORDER BY NOMBRE_CANCION DESC";//orden alfabetico invertido
            break;
        default:
            $orden = " ORDER BY RANKING";//se ordenan por ranqueo de mejor cancion;
            break;
    }

   //que genero llega por la url
    if($_GET["genero"] != "todos"){
        $id_gen = $_GET["genero"];
        //$where_gen = "AND C.ID_GENERO = $id_gen ";
        $where_gen = "AND (C.ID_GENERO = $id_gen OR PADRE = $id_gen)";
    }else{
        $where_gen = " ";
    }
?>
<div class="col-12">
    <div class="row">
        <?php
        //chequea si llega id de artista , y le muestra el artista
            if(isset($_GET["id"])){
                if(empty($_GET["id"])){
                    $_GET["id"] = 100;
                }
                //id del artista
                    $nombre = $_GET["id"];

                    $query = "SELECT * FROM ARTISTAS WHERE ID_ARTISTA = $nombre AND ARTISTA_ACTIVO = 'TRUE';";
                    $resultado = $con->query($query);
                    
                    $query2 = "SELECT SUM(ESTRELLAS) AS SUMA , COUNT(ESTRELLAS) AS CANTIDAD
                                 FROM COMENTARIOS 
                                 WHERE ID_ARTISTA = $nombre  AND ACTIVO = 'TRUE';";
                    $result = $con->query($query2);
                    
                    $resultado2 = $result->fetch(PDO::FETCH_OBJ);
                
                    $suma = $resultado2->SUMA;
                    $cant = $resultado2->CANTIDAD;
                    $promedio = $suma / $cant;
                    
        ?>
                <div class="col-12">
                    <div class="row">
                       <?php 
                            foreach($resultado as $res){
                        ?>
                        <div class="col-6">
                            <img src="<?=imprimir_ruta($res["NOMBRE_ARTISTA"]) ?>">
                            <h2 class="display-3">   <?= round($promedio *100)/100; ?>★</h2>
                        </div>
                        <div class="col-6">
                            <h1 class="display-1">
                                <a href="<?= $res["LINK_ARTISTA"] ?>" class="nav-link"><?=  ucwords(limpiar_guion($res["NOMBRE_ARTISTA"])) ?></a>
                            </h1>
                            <p><?= $res["DESCRIPCION_ARTISTA"];?></p>
                        <?php
                        }
                        ?>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                <?php
                   
                    $query="SELECT RANKING , NOMBRE_CANCION , DURACION , NOMBRE_ARTISTA , NOMBRE_GENERO , C.ACTIVO 
                                FROM CANCIONES C
                                    INNER JOIN ARTISTAS A 
                                        ON C.ID_ARTISTA = A.ID_ARTISTA
                                    INNER JOIN GENEROS G  
                                        ON G.ID_GENERO = C.ID_GENERO 
                                WHERE C.ACTIVO = 'TRUE' AND A.ARTISTA_ACTIVO = 'TRUE' AND G.GENERO_ACTIVO ='TRUE' AND A.ID_ARTISTA = $nombre $where_gen 
                                        $orden;";

                    //(C.ID_ARTISTA = A.ID_ARTISTA AND A.ACTIVO = TRUE)      
                    $resultado = $con -> query($query);
            
            }else{
                
            //por aca muestra todas las canciones
        ?>        
        <div class="col-12">
                <?php

                    $query="SELECT RANKING , NOMBRE_CANCION , DURACION , NOMBRE_ARTISTA , NOMBRE_GENERO , C.ACTIVO 
                                FROM CANCIONES C
                                    INNER JOIN ARTISTAS A 
                                        ON C.ID_ARTISTA = A.ID_ARTISTA
                                    INNER JOIN GENEROS G  
                                        ON G.ID_GENERO = C.ID_GENERO
                                WHERE C.ACTIVO ='TRUE' AND G.GENERO_ACTIVO ='TRUE' AND ARTISTA_ACTIVO = 'TRUE' $where_gen
                                $orden;";

                    //(C.ID_ARTISTA = A.ID_ARTISTA AND A.ACTIVO = TRUE)      
                    $resultado = $con -> query($query);
 
            }//TERMINA EL ELSE QUE PREGUNTA SI HAY ID_ARTISTA
        ?>
        <h1 class="display-3 text-center">Lista de Canciones</h1>

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
            <?php
                if(isset($_GET["id"]) && isset($_SESSION["usuario"]["perfil"])){
                    $id = $_GET["id"];
                    if(isset($_SESSION["exito"])){
                        $mensaje = $_SESSION["exito"];
            ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Éxito: </strong> <?= $mensaje ?>.
                        </div>
            <?php                
                        unset($_SESSION["exito"]);
                    }else if(isset($_SESSION["error"])){
                        $mensaje = $_SESSION["error"];
            ?>
                         <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Error: </strong> <?= $mensaje ?>.
                        </div>
            <?php
                        unset($_SESSION["error"]);
                    }
            ?>
            <form action="cargar_comentarios.php" method="POST">
                <div class="form-group">
                    <label for="comment">Comentarios:</label>
                      <textarea class="form-control" rows="5" id="comment" name="comentarios" placeholder="comentarios"></textarea>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 col-sm-12">
                        <button type="submit" class="btn btn-dark btn-lg">Enviar</button>
                    </div>
                </div>
                <div class="valoracion">
                    <input id="radio1" type="radio" name="estrellas" value="5">
                    <label for="radio1">★</label>
                    <input id="radio2" type="radio" name="estrellas" value="4">
                    <label for="radio2">★</label>
                    <input id="radio3" type="radio" name="estrellas" value="3">
                    <label for="radio3">★</label>
                    <input id="radio4" type="radio" name="estrellas" value="2">
                    <label for="radio4">★</label>
                    <input id="radio5" type="radio" name="estrellas" value="1">
                    <label for="radio5">★</label>
                </div>
            
                <input name="id_artista" type="hidden" value="<?= $id ?>">    
            </form>
            <?php
                $id = $_GET["id"];
                $query = "SELECT * 
                            FROM COMENTARIOS C
                            INNER JOIN USUARIOS U
                            ON C.ID_USUARIO = U.ID_USUARIO
                            WHERE ID_ARTISTA = $id  AND C.ACTIVO = 'TRUE'
                            ORDER BY ID_COMENTARIO;";
                $resultado = $con->query($query);
            ?>
                <table class="table">
                    <tr style="font-size:25px;">
                        <td>ComentarioS</td>
                        <td>★</td>
                    </tr>
                <?php
                    foreach ($resultado as $rows) {
                ?>
                        <tr>
                            <td><?= $rows["USUARIO"] . " : " . mostrar_nombre($rows["COMENTARIO"]) ?></td>
                            <td><?= $rows["ESTRELLAS"] ?> ★</td>
                        </tr>
                <?php      
                    }
                ?>
                </table>
            <?php
                }
            ?>
        </div>
    </div>
</div>