<div class="container">
    <h1 class="display-4">Usuarios</h1>
    <?php
        if(isset($_SESSION["mensaje"])){
            $msj = $_SESSION["mensaje"];
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>OK : </strong>
        <?= $msj ?>.
    </div>
    <?php
            unset($_SESSION["mensaje"]);
        }
    ?>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Mail</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        $carpeta = opendir("usuarios");
                        while($carpetas = readdir($carpeta)):
                            if($carpetas != "." && $carpetas != ".."):
                                $mail ="usuarios/$carpetas/mail.txt";
                                $usuario ="usuarios/$carpetas/usuario.txt";
                                $perfil ="usuarios/$carpetas/perfil.txt";
                    ?>
                        <td>
                            <?= ucfirst(limpiar_guion(link_pagina($usuario))) ?>
                        </td>
                        <td>
                            <p>
                                <?= link_pagina($mail) ?>
                            </p>
                        </td>
                        <td>
                            <p>
                                <?= link_pagina($perfil) ?>
                            </p>
                        </td>
                        <td>
                            <div class="row">
                                <form action="editar_permiso.php" method="post">
                                    <input type="hidden" name="id" value="<?= $carpetas ?>">
                                    <button type="submit" class="btn btn-success">
                                        cambiar permisos
                                    </button>
                                </form>
                            </div>
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
