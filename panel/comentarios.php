<div class="container">
<?php
    include("pdo.php");
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $query = "SELECT * 
                    FROM COMENTARIOS
                    WHERE ID_ARTISTA = $id;";
        $resultado = $con->query($query);
        $tabla = "COMENTARIOS";
?>
        <table class="table">
            <tr style="font-size:25px;">
                <td>Id</td>
                <td>Comentario</td>
                <td>Estrellas</td>
                <td>Usuario</td>
                <td>Fecha</td>
                <td>Activo</td>
                <td>Acciones</td>
            </tr>
            <?php
                foreach ($resultado as $rows) {
                    //boton
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
                        <td><?= $rows['ID_COMENTARIO'] ?></td>
                        <td><?= mostrar_nombre($rows["COMENTARIO"]) ?></td>
                        <td><?= $rows["ESTRELLAS"] ?> ★</td>
                        <td><?= $rows["ID_USUARIO"] ?></td>
                        <td><?= $rows["FECHA"] ?></td>
                        <td><?= $rows["ACTIVO"] ?></td>
                        <td><a href="activar.php?table=<?= $tabla ?>&id=<?=$rows['ID_COMENTARIO']?>&estado=<?= $estado ?>&art=<?= $id ?>"><button type="button" class="my-2 btn btn-<?= $color ?>" title="activar/desactivar"><?= $boton ?></button></a>
                        </td>
                    </tr>
            <?php      
                }
            ?>
                </table>
<?php
    }else{
        header("Location:panel.php?panel=mostrar&ver=artistas");
        die();
    }
?>
</div>