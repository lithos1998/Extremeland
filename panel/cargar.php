<?php
    include("pdo.php");
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <ul class="my-1 container jumbotron navbar-nav">
                <div class="row">
                    <li class="menu-li nav-item col-3"><a href="panel.php?panel=cargar&ver=canciones" class="menu-art nav-link">Canciones</a></li>
                    <li class="menu-li nav-item col-3"><a href="panel.php?panel=cargar&ver=artistas" class="menu-art nav-link">Artistas</a></li>
                    <li class="menu-li nav-item col-2"><a href="panel.php?panel=cargar&ver=noticias" class="menu-art nav-link">Noticias</a></li>
                    <li class="menu-li nav-item col-2"><a href="panel.php?panel=cargar&ver=usuarios" class="menu-art nav-link">Usuarios</a></li>
                    <li class="menu-li nav-item col-2"><a href="panel.php?panel=cargar&ver=generos" class="menu-art nav-link">Generos</a></li>
                </div>    
            </ul>
        </div>
        <?php
            if(isset($_SESSION["error"])){
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
            $accion = "cargar";
            if($pagina == "canciones"){
                if(isset($_GET["edit"])){
                    $id_cancion = $_GET["edit"];
                    $sql="SELECT *
                            FROM CANCIONES C
                                INNER JOIN ARTISTAS A 
                                    ON C.ID_ARTISTA = A.ID_ARTISTA
                                INNER JOIN GENEROS G  
                                    ON G.ID_GENERO = C.ID_GENERO
                            WHERE ID_CANCION = $id_cancion ;";
                    $resultado = $con -> query($sql); 
                    $resultado = $resultado->fetch(PDO::FETCH_OBJ);
                    $editar = 1;
                    $accion = "editar";
                }
        ?>  
            <div class="row">
                <div class="col-12">
                    <?php
                        if(isset($_GET["edit"])){
                            echo '<h1 class="display-4 justify-content-center">Editar Cancion</h1>';
                        }else{
                            echo '<h1 class="display-4 justify-content-center">Cargar Cancion</h1>';
                        }
                    ?>
                </div>
            </div>
            <!-- INICIO DEL FORM DE CARGA de canciones -->
            <div class="row justify-content-center">
                <div class="col-6">
                    <form action="<?= $accion ?>_cancion.php" enctype="multipart/form-data" method="POST" class="bg-white p-3">
                        <!-- input del nombre -->
                        <div class="form-group">
                            <label for="nombre" class="text-dark">Nombre de la cancion</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre" value="<?=isset($_GET["edit"])?$resultado->NOMBRE_CANCION:'';?>">
                            <small id="help_nombre" class="text-muted">Nombre completo del track</small>
                        </div>
                        <!-- input del link -->
                        <div class="form-group">
                            <label for="duracion" class="text-dark">Duracion</label>
                            <input type="text" name="duracion" id="duracion" class="form-control" placeholder="Ingrese la duracion en formato '4:20'" value="<?=isset($_GET["edit"])?$resultado->DURACION:'';?>">
                            <small id="help_duracion" class="text-muted">Duracion de la cancion</small>
                        </div>
                        <!-- Generos -->
                        <p class="text-dark">Generos</p>
                        <select class="browser-default custom-select custom-select-lg mb-3" id="generos" name="generos" >
                        <?php
                            $query = "SELECT * FROM GENEROS;";
                            $resultado_gen = $con->query($query);
                            
                            foreach ($resultado_gen as $rows) {
                                if($rows["ID_GENERO"] == $resultado->ID_GENERO ){
                                    $selec = "selected";
                                }else{
                                    $selec = " ";
                                }
                        ?>
                            <option value="<?=$rows["ID_GENERO"] ?>" <?=isset($_GET["edit"])?$selec:'';?> ><?= $rows["NOMBRE_GENERO"]?></option>
                        <?php
                            }
                        ?>
                        </select>
                        <!-- Artistas -->
                        <p class="text-dark">Artistas</p>
                        <select class="browser-default custom-select custom-select-lg mb-3" id="artistas" name="artistas" >
                        <?php
                            $query = "SELECT * FROM ARTISTAS ORDER BY NOMBRE_ARTISTA;";
                            $resultado_art = $con->query($query);
                            
                            foreach ($resultado_art as $rows) {
                                if($rows["ID_ARTISTA"] == $resultado->ID_ARTISTA ){
                                    $selec = "selected";
                                }else{
                                    $selec = " ";
                                }
                        ?>
                            <option value="<?=$rows["ID_ARTISTA"] ?>" <?=isset($_GET["edit"])?$selec:'';?> ><?= $rows["NOMBRE_ARTISTA"]?></option>
                        <?php
                            }
                        ?>
                        </select>
                        <input name="id" type="hidden" value="<?=isset($_GET["edit"])?$id_cancion:'';?>">
                    
                        <br>
                        <!-- boton de envio -->
                        <button type="submit" class="btn btn-outline-success btn-lg btn-block"><?= $accion?></button>
                    </form>
                </div>
            </div>
        <?php
            }
            if($pagina == "artistas"){
                $accion = "cargar";
                if(isset($_GET["edit"])){
                    $id_artista = $_GET["edit"];
                    $sql="SELECT *
                            FROM ARTISTAS
                            WHERE ID_ARTISTA = $id_artista ;";
                    $resultado = $con -> query($sql); 
                    $resultado = $resultado->fetch(PDO::FETCH_OBJ);
                    $editar = 1;
                    $accion = "editar";
                    $imagen = file_exists("secciones/djs/img/$resultado->NOMBRE_ARTISTA.jpg") ? "secciones/djs/img/$resultado->NOMBRE_ARTISTA.jpg" : null;
                }
        ?>
            <div class="row">
                <div class="col-12">
                    <?php
                        if(isset($_GET["edit"])){
                            echo '<h1 class="display-4 justify-content-center">Editar Artista</h1>';
                        }else{
                            echo '<h1 class="display-4 justify-content-center">Cargar Artista</h1>';
                        }
                    ?>
                </div>
            </div>
            <!-- INICIO DEL FORM DE CARGA de artistas-->
            <div class="row justify-content-center">
                <div class="col-6">
                    <form action="<?= $accion ?>_artista.php" enctype="multipart/form-data" method="POST" class="bg-white p-3">
                        <!-- input del nombre -->
                        <div class="form-group">
                            <label for="nombre" class="text-dark">Nombre del artista</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre" value="<?=isset($_GET["edit"])?$resultado->NOMBRE_ARTISTA:'';?>">
                            <small id="help_nombre" class="text-muted">El nombre debe ser con el que se presenta artisticamente</small>
                        </div>
                        <!-- input del link -->
                        <div class="form-group">
                            <label for="link" class="text-dark">Link de soundcloud</label>
                            <input type="text" name="link" id="link" class="form-control" placeholder="Ingrese el link" value="<?=isset($_GET["edit"])?$resultado->LINK_ARTISTA:'';?>">
                            <small id="help_link" class="text-muted">El link debe ser de su pagina de soundcloud</small>
                        </div>
                        <!-- input de la descripcion -->
                        <div class="form-group">
                            <label for="descripcio" class="text-dark">Artista</label>
                            <textarea type="text" name="descripcion" id="descripcion" class="form-control"  aria-describedby="help_descripcion" ><?=isset($_GET["edit"])?$resultado->DESCRIPCION_ARTISTA:'';?></textarea>
                            <small id="help_descripcion" class="text-muted">Ingrese la descripcion del artista</small>
                        </div>
                        <!-- subida de imagen-->
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" accept="image/jpeg" class="form-control-file btn" name="imagen" id="imagen" placeholder="Subir imagen" aria-describedby="help_imagen">
                            <?php
                                if(isset($imagen)){
                            ?>
                                <img src="<?= $imagen; ?>" alt="" width="100">
                            <?php
                                }
                            ?>
                            <small id="help_imagen" class="form-text text-muted">La imágen del artista unicamen debe ser en formato jpg y pesar menos de 2mb</small>
                        </div>
                        <input name="id" type="hidden" value="<?=isset($id_artista)?"$id_artista":'';?>">
                        <!-- boton de envio -->
                        <button type="submit" class="btn btn-outline-success btn-lg btn-block"><?= $accion?></button>
                    </form>
                </div>
            </div>
            <?php
                }
                if($pagina == "noticias"){
                    $accion = "cargar";
                    if(isset($_GET["edit"])){
                        $id_noticia = $_GET["edit"];
                        $sql="SELECT *
                                FROM NOTICIAS
                                WHERE ID_NOTICIA = $id_noticia ;";
                        $resultado = $con -> query($sql); 
                        $resultado = $resultado->fetch(PDO::FETCH_OBJ);
                        $editar = 1;
                        $accion = "editar";
                        $imagen = file_exists("noticias/$resultado->TITULO_NOTICIA.jpg") ? "noticias/$resultado->TITULO_NOTICIA.jpg" : null;
                    }
            ?>
                <div class="row">
                    <div class="col-12">
                        <?php
                        if(isset($_GET["edit"])){
                            echo '<h1 class="display-4 justify-content-center">Editar Noticia</h1>';
                        }else{
                            echo '<h1 class="display-4 justify-content-center">Cargar Noticia</h1>';
                        }
                    ?>
                    </div>
                </div>
            <!-- INICIO DEL FORM DE CARGA de noticias-->
                <div class="row justify-content-center">
                    <div class="col-6">
                        <form action="<?= $accion ?>_noticia.php" enctype="multipart/form-data" method="POST" class="bg-white p-3">
                            <!-- input del nombre -->
                            <div class="form-group">
                                <label for="titulo" class="text-dark">Titulo de noticia</label>
                                <input type="text" name="titulo" id="titulo" class="form-control" value="<?=isset($_GET["edit"])?$resultado->TITULO_NOTICIA:'';?>">
                                <small id="help_titulo" class="text-muted">Se debe indicar un titulo para la noticia</small>
                            </div>
                            <!-- input del link -->
                            <div class="form-group">
                                <label for="noticia" class="text-dark">Noticia</label>
                                <textarea type="text" name="noticia" id="noticia" class="form-control"  aria-describedby="help_descripcion"><?=isset($_GET["edit"])?$resultado->NOTICIA:'';?></textarea>
                                <small id="help_descripcion" class="text-muted">Ingrese la noticia</small>
                            </div>
                            <!-- subida de imagen-->
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" accept="image/jpeg" class="form-control-file btn" name="imagen" id="imagen" placeholder="Subir imagen" aria-describedby="help_imagen">
                                <?php
                                    if(isset($imagen)){
                                ?>
                                    <img src="<?= $imagen; ?>" alt="" width="100">
                                <?php
                                    }
                                ?>
                                <small id="help_imagen" class="form-text text-muted">La imágen del artista unicamen debe ser en formato jpg y pesar menos de 2mb</small>
                            </div>

                            <input name="id" type="hidden" value="<?=isset($id_noticia)?"$id_noticia":'';?>">                            

                            <!-- boton de envio -->
                            <button type="submit" class="btn btn-outline-success btn-lg btn-block"><?= $accion?></button>
                        </form>
                    </div>
                </div>
            <?php
                }
                if($pagina == "usuarios"){
                    if(isset($_GET["edit"])){
                        $id_usuario = $_GET["edit"];
                        $sql="SELECT *
                                FROM USUARIOS
                                WHERE ID_USUARIO = $id_usuario ;";
                        $result = $con -> query($sql); 
                        $resultado = $result->fetch(PDO::FETCH_OBJ);
                        $editar = 1;
                        $accion = "editar";
                    }
            ?>
                <div class="row">
                    <div class="col-12">
                        <h1 class="display-4 justify-content-center"><?= $accion?> Usuario</h1>
                    </div>
                </div>
            <!-- INICIO DEL FORM DE CARGA de noticias-->
                <div class="row justify-content-center">
                    <div class="col-6">
                        <form action="<?= $accion ?>_usuario.php" enctype="multipart/form-data" method="POST" class="bg-white p-3">
                            <!-- input del usuario -->
                            <div class="form-group">
                                <label for="user" class="text-dark">Usuario</label>
                                <input type="text" name="user" id="user" class="form-control" value="<?=isset($_GET["edit"])?$resultado->USUARIO:'';?>">
                                <small id="help_user" class="text-muted">El nombre de usuario no debe contener mas de 25 caracteres</small>
                            </div>
                            <!-- input del mail -->
                            <div class="form-group">
                                <label for="mail" class="text-dark">Mail</label>
                                <input type="text" name="mail" id="mail" class="form-control" value="<?=isset($_GET["edit"])?$resultado->MAIL:'';?>">
                                <small id="help_mail" class="text-muted">example@mail.com</small>
                            </div>
                            <!-- input de la contraseña -->
                            <div class="form-group">
                                <label for="password" class="text-dark">password</label>
                                <input type="password" name="password" id="password" class="form-control" aria-describedby="help_password">
                                <small id="help_password" class="text-muted">La contraseña no debe ser menor a 6 caracteres</small>
                            </div>
                            
                            <input name="id" type="hidden" value="<?=isset($id_usuario)?"$id_usuario":'';?>">

                            <!-- boton de envio -->
                            <button type="submit" class="btn btn-outline-success btn-lg btn-block"><?= $accion?></button>
                        </form>
                    </div>
                </div>
            <?php
                }
                if($pagina == "generos"){
                    if(isset($_GET["edit"])){
                        $id_genero = $_GET["edit"];
                        $sql="SELECT *
                                FROM GENEROS
                                WHERE ID_GENERO = $id_genero ;";
                        $result = $con -> query($sql); 
                        $resultado = $result->fetch(PDO::FETCH_OBJ);
                        $editar = 1;
                        $accion = "editar";
                    }
            ?>
                <div class="row">
                    <div class="col-12">
                        <h1 class="display-4 justify-content-center"><?= $accion ?> Generos</h1>
                    </div>
                </div>
                <!-- INICIO DEL FORM DE CARGA de noticias-->
                <div class="row justify-content-center">
                    <div class="col-6">
                        <form action="<?= $accion ?>_generos.php" enctype="multipart/form-data" method="POST" class="bg-white p-3">
                            <!-- input del nombre -->
                            <div class="form-group">
                                <label for="nombre" class="text-dark">Nombre del genero</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="<?=isset($_GET["edit"])?$resultado->NOMBRE_GENERO:'';?>">
                                <small id="help_nombre" class="text-muted">Se debe indicar un titulo para la noticia</small>
                            </div>
                            <!-- Generos -->
                            <p class="text-dark">si el genero a ingresar es subgenero de alguno existente , marquelo</p>
                            <select class="browser-default custom-select custom-select-lg mb-3" id="generos" name="generos" >
                                <option value="0">genero padre</option>
                            <?php
                                $query = "SELECT * FROM GENEROS;";
                                $resul = $con->query($query);

                                foreach ($resul as $rows) {
                                    if($rows["ID_GENERO"] == $resultado->PADRE ){
                                        $selec = "selected";
                                    }else{
                                        $selec = " ";
                                    }
                            ?>
                                <option value="<?=$rows["ID_GENERO"] ?>" <?=isset($_GET["edit"])?$selec:'';?>><?= $rows["NOMBRE_GENERO"]?></option>
                            <?php
                                }
                            ?>
                            </select>
                            
                            <input name="id" type="hidden" value="<?=isset($id_genero)?"$id_genero":'';?>">
                            
                            <br>
                            <!-- boton de envio -->
                            <button type="submit" class="btn btn-outline-success btn-lg btn-block"><?= $accion ?></button>
                        </form>
                    </div>
                </div>
            <?php
                }
            ?>
        </div><!-- todo dentro de este div -->
    </div>
</div>
