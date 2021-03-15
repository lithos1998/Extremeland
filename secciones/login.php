<?php
/*
  if(!defined("ACCESO")){
      header("Location:../index.php?seccion=login");
  }
*/
?>

<div class="container my-4">
    <div class="row">
        <div class="col-12 " align="center">
            <img src="img/logo-footer.png" class="img-fluid" />
        </div>
        <div class="col-12">
            <h1 class="titulos display-4 center-block">Login</h1>
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
        <strong>Error: </strong>
        <?= $mensaje ?>.
    </div>

    <?php
        unset($_SESSION["mensaje"]);
         }


          if(!empty($_GET["registro"]) && $_GET["registro"] == "ok"):
        ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <p>Te diste de alta correctamente, ya podés ingresar.</p>
    </div>

    <?php
          endif;

          ?>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 ">
            <form action="procesar_login.php" method="POST">
                <div class="control">
                    <div class="label">Email</div>
                    <input type="text" class="form-control" placeholder="ejemplo@mail.com" name="mail" />
                </div>

                <div class="control">
                    <div class="label">Contraseña</div>
                    <input type="password" class="form-control" placeholder="**********" name="contraseña" />
                </div>
                <br>
                <div align="center">
                    <button class="btn btn-success">Entrar</button>
                </div>
                <br>
            </form><br>
        </div><br>
    </div>
</div>
