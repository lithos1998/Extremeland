<?php
    include("pdo.php");
    //include("funciones.php");
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <ul class="my-1 container jumbotron navbar-nav">
                <div class="row">
                    <li class="menu-li nav-item col-3"><a href="panel.php?panel=mostrar&ver=canciones" class="menu-art nav-link">Canciones</a></li>
                    <li class="menu-li nav-item col-3"><a href="panel.php?panel=mostrar&ver=artistas" class="menu-art nav-link">Artistas</a></li>
                    <li class="menu-li nav-item col-2"><a href="panel.php?panel=mostrar&ver=noticias" class="menu-art nav-link">Noticias</a></li>
                    <li class="menu-li nav-item col-2"><a href="panel.php?panel=mostrar&ver=usuarios" class="menu-art nav-link">Usuarios</a></li>
                    <li class="menu-li nav-item col-2"><a href="panel.php?panel=mostrar&ver=generos" class="menu-art nav-link">Generos</a></li>
                </div>    
            </ul>
        </div>
        <?php
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
            }
        ?>
        <div class="col-12">
        <?php
            switch($_GET["ver"]){
                case "canciones": $pagina = $_GET["ver"];
                    break;
                case "artistas": $pagina = $_GET["ver"];
                    break;
                case "noticias": $pagina = $_GET["ver"];
                    break;
                case "usuarios": $pagina = $_GET["ver"];
                    break;
                case "generos": $pagina = $_GET["ver"];
                    break;
                default : $pagina = "canciones";
                    break;
            }
        
            if($pagina == "canciones"){
                $tabla = "CANCIONES";
                $query="SELECT ID_CANCION , RANKING , NOMBRE_CANCION , DURACION , NOMBRE_ARTISTA , NOMBRE_GENERO , ACTIVO , DESTACADOS
                                FROM CANCIONES C
                                    INNER JOIN ARTISTAS A 
                                        ON C.ID_ARTISTA = A.ID_ARTISTA
                                    INNER JOIN GENEROS G  
                                        ON G.ID_GENERO = C.ID_GENERO;";

                    //(C.ID_ARTISTA = A.ID_ARTISTA AND A.ACTIVO = TRUE)      
                $resultado = $con -> query($query);
        ?>  
                <table class="table">
                    <tr style="font-size:25px;">
                        <td>ID</td>
                        <td>Ranking</td>
                        <td>Nombre</td>
                        <td>Productor</td>
                        <td>Genero</td>
                        <td>Duracion</td>
                        <td>Activo</td>
                        <td>Destacados</td>
                        <td>Acciones</td>
                    </tr>
                    <?php
                        foreach ($resultado as $rows) {
                            if($rows["ACTIVO"] == "TRUE"){
                                $boton = "Desactivar";
                                $color = "danger";
                                $estado = "'FALSE'";
                            }else{
                                $boton = "Activar";
                                $color = "success";
                                $estado = "'TRUE'";
                            }
                    ?>
                    <tr>
                        <td><?= $rows["ID_CANCION"] ?></td>
                        <td><?= $rows["RANKING"] ?></td>
                        <td><?= mostrar_nombre($rows["NOMBRE_CANCION"]) ?></td>
                        <td><?= mostrar_nombre($rows["NOMBRE_ARTISTA"]) ?></td>
                        <td><?= mostrar_nombre($rows["NOMBRE_GENERO"]) ?></td>
                        <td><?= $rows["DURACION"]; ?></td>
                        <td><?= $rows["ACTIVO"]; ?></td>
                        <td><?= $rows["DESTACADOS"]; ?></td>
                        <td>
                           <a href="panel.php?panel=cargar&ver=canciones&edit=<?=$rows['ID_CANCION']?>"><button type="button" class="btn btn-primary" title="modicar">Modificar</button></a>
                           <a href="activar.php?table=<?= $tabla ?>&id=<?=$rows['ID_CANCION']?>&estado=<?= $estado ?>" class="my-1"><button type="button" class="my-2 btn btn-<?= $color ?>" title="activar/desactivar"><?= $boton ?></button></a>
                        </td>
                    </tr>
                    <?php      
                        }
                    ?>
                </table>
        <?php
            }else if($pagina == "artistas"){
                $tabla = "ARTISTAS";
                $query = "SELECT * FROM ARTISTAS;";
                $resultado = $con->query($query);
        
        ?>
                <table class="table">
                    <tr style="font-size:25px;">
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Descripcion</td>
                        <td>Link</td>
                        <td>Activo</td>
                        <td>IMG</td>
                        <td>Acciones</td>
                    </tr>
                    <?php
                        foreach ($resultado as $rows) {
                            if($rows["ARTISTA_ACTIVO"] == "TRUE"){
                                $boton = "Desactivar";
                                $color = "danger";
                                $estado = "'FALSE'";
                            }else{
                                $boton = "Activar";
                                $color = "success";
                                $estado = "'TRUE'";
                            }
                    ?>
                    <tr>
                        <td><?= $rows["ID_ARTISTA"] ?></td>
                        <td><?= mostrar_nombre($rows["NOMBRE_ARTISTA"]) ?></td>
                        <td><?= mostrar_nombre($rows["DESCRIPCION_ARTISTA"]) ?></td>
                        <td><a href="<?= mostrar_nombre($rows["LINK_ARTISTA"]) ?>"><?= mostrar_nombre($rows["LINK_ARTISTA"]) ?></a></td>
                        <td><?= mostrar_nombre($rows["ARTISTA_ACTIVO"]) ?></td>
                        <td><img src="<?=imprimir_ruta($rows["NOMBRE_ARTISTA"]) ?>" width="50" height="50"></td>
                        <td>
                            <a href="panel.php?panel=cargar&ver=artistas&edit=<?=$rows['ID_ARTISTA']?>"><button type="button" class="btn btn-primary" title="modicar">Modificar</button></a>
                            <a href="activar.php?table=<?= $tabla ?>&id=<?=$rows['ID_ARTISTA']?>&estado=<?= $estado ?>"><button type="button" class="my-2 btn btn-<?= $color ?>" title="activar/desactivar"><?= $boton ?></button></a>
                            <a href="panel.php?panel=comentarios&id=<?=$rows['ID_ARTISTA']?>"><button type="button" class="btn btn-warning" title="modicar">Comentarios</button></a>
                        </td>
                    </tr>
                    <?php      
                        }
                    ?>
                </table>
        <?php
            }else if($pagina == "usuarios"){
                $tabla = "USUARIOS";
                $query = "SELECT * FROM USUARIOS;";
                $resultado = $con->query($query);
        
        ?>
                <table class="table">
                    <tr style="font-size:25px;">
                        <td>ID</td>
                        <td>Usuario</td>
                        <td>Mail</td>
                        <td>Password</td>
                        <td>salt</td>
                        <td>Activo</td>
                        <td>Perfil</td>
                        <td>Acciones</td>
                    </tr>
                    <?php
                        foreach ($resultado as $rows) {
                            if($rows["ACTIVO"] == 1){
                                $boton = "Desactivar";
                                $color = "danger";
                                $estado = 0;
                            }else{
                                $boton = "Activar";
                                $color = "success";    
                                $estado = 1;
                            }
                    ?>
                    <tr>
                        <td><?= $rows["ID_USUARIO"] ?></td>
                        <td><?= mostrar_nombre($rows["USUARIO"]) ?></td>
                        <td><?= mostrar_nombre($rows["MAIL"]) ?></td>
                        <td><?= mostrar_nombre($rows["PASSWORD"]) ?></td>
                        <td><?= mostrar_nombre($rows["SALT"]) ?></td>
                        <td><?= mostrar_nombre($rows["ACTIVO"]) ?></td>
                        <td><?= mostrar_nombre($rows["PERFIL"]) ?></td>
                        <td>
                            <a href="panel.php?panel=cargar&ver=usuarios&edit=<?=$rows['ID_USUARIO']?>"><button type="button" class="btn btn-primary" title="modicar">Modificar</button></a>
                            <a href="activar.php?table=<?= $tabla ?>&id=<?=$rows['ID_USUARIO']?>&estado=<?= $estado ?>"><button type="button" class="my-2 btn btn-<?= $color ?>" title="activar/desactivar"><?= $boton ?></button></a>
                        </td>
                    </tr>
                    <?php      
                        }
                    ?>
                </table>
        <?php        
            }else if($pagina == "noticias"){
                $tabla = "NOTICIAS";
                $query = "SELECT * FROM NOTICIAS;";
                $resultado = $con->query($query);
        ?>
                <table class="table">
                    <tr style="font-size:25px;">
                        <td>ID</td>
                        <td>Titulo</td>
                        <td>Noticia</td>
                        <td>Activa</td>
                        <td>IMG</td>
                        <td>Accones</td>
                    </tr>
                    <?php
                        foreach ($resultado as $rows) {
                            if($rows["ACTIVA"] == 1){
                                $boton = "Desactivar";
                                $color = "danger";
                                $estado = 0;
                            }else{
                                $boton = "Activar";
                                $color = "success"; 
                                $estado = 1;
                            }
                    ?>
                    <tr>
                        <td><?= $rows["ID_NOTICIA"] ?></td>
                        <td><?= mostrar_nombre($rows["TITULO_NOTICIA"]) ?></td>
                        <td><?= mostrar_nombre($rows["NOTICIA"]) ?></td>
                        <td><?= mostrar_nombre($rows["ACTIVA"]) ?></td>
                        <td><img src="noticias/<?=$rows["TITULO_NOTICIA"] ?>.jpg" width="50" height="50"></td>
                        <td>
                            <a href="panel.php?panel=cargar&ver=noticias&edit=<?=$rows['ID_NOTICIA']?>"><button type="button" class="btn btn-primary" title="modicar">Modificar</button></a>
                            <a href="activar.php?table=<?= $tabla ?>&id=<?=$rows['ID_NOTICIA']?>&estado=<?= $estado ?>"><button type="button" class="my-2 btn btn-<?= $color ?>" title="activar/desactivar"><?= $boton ?></button></a>
                        </td>
                    </tr>
                    <?php      
                        }
                    ?>
                </table>
        
        <?php        
            }else if($pagina == "generos"){
                $tabla = "GENEROS";
                $query = "SELECT * FROM GENEROS;";
                $resultado = $con->query($query);
        ?>
                <table class="table">
                    <tr style="font-size:25px;">
                        <td>Id</td>
                        <td>Nombre genero</td>
                        <td>Padre</td>
                        <td>Activo</td>
                        <td>Accones</td>
                    </tr>
                    <?php
                        foreach ($resultado as $rows) {
                            if($rows["GENERO_ACTIVO"] == "TRUE"){
                                $boton = "Desactivar";
                                $color = "danger";
                                $estado = "'FALSE'";
                            }else{
                                $boton = "Activar";
                                $color = "success";  
                                $estado = "'TRUE'";
                            }
                    ?>
                    <tr>
                        <td><?= $rows["ID_GENERO"] ?></td>
                        <td><?= mostrar_nombre($rows["NOMBRE_GENERO"]) ?></td>
                        <td><?= mostrar_nombre($rows["PADRE"]) ?></td>
                        <td><?= mostrar_nombre($rows["GENERO_ACTIVO"]) ?></td>
                        <td>
                            <a href="panel.php?panel=cargar&ver=generos&edit=<?=$rows['ID_GENERO']?>"><button type="button" class="btn btn-primary" title="modicar">Modificar</button></a>
                            <a href="activar.php?table=<?= $tabla ?>&id=<?=$rows['ID_GENERO']?>&estado=<?= $estado ?>"><button type="button" class="btn btn-<?= $color ?>" title="activar/desactivar"><?= $boton ?></button></a>
                        </td>
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