
<?php
  /*
    if(!defined("ACCESO")){
        header("Location:../index.php?seccion=registro");
    }
    */
?>

<div class="container my-4">
    <div class="row">
        <div class="col-12 " align="center">
            <img src="img/logo-footer.png" class="img-fluid"/>
        </div>
        <div class="col-12">
            <h1 class="titulos display-4 center-block">Registro</h1>
        </div>
    </div>
</div>
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
        }
        //endif;

    ?>
 </div>

 <div class="container">
    <div class="row justify-content-center" >
        <div class="col-6">
            <form method="POST" action="cargar_usuario.php">
                <div class="control">
                    <div class="label">Usuario</div>
                    <input type="text" class="form-control" placeholder="usuario" require name="user"/>
                </div>

                <div class="control">
                    <div class="label">E-mail</div>
                    <input type="text" class="form-control" placeholder="ejemplo@email.com" require name="mail"/>
                </div>

                <div class="control">
                    <div class="label">Contraseña</div>
                    <input type="password" class="form-control" placeholder="**********" require name="password"/>
                </div>
                <br>
                <div align="center">
                    <button class="btn btn-success">Registrar</button>
                </div><br>
                <div align="center">
                    <a href="index.php?seccion=login">¿Ya estas registrado?</a>
                </div>
                <br>
            </form>
            <br>
        </div>
        <br>



    </div>
</div>