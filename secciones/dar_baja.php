<?php
    require_once("configuracion.php");
    require_once("funciones.php");
    require_once("arrays.php");
?>
<?php
    if(!isset($_SESSION["usuario"])){
        $_Session["permiso"] = "no tienes permisos para ver esta seccion";
        header("Location:index.php?seccion=home"); 
        die();
    }
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
<div class="container my-4">
    <h1 class="display-4">Nos gustaria saber la razon por la cual te vas</h1>
    <br>
    <form action="borrar_cuenta.php" method="POST">
       <br>
        <div class="form-group" >
            <div class="form-check">
                <label class="form-check-label">
                    <div class="col-12">
                        <input  type="checkbox" class="form-check-input" name="nececidad" id="nececidad" value="" >Ya no nececito la cuenta

                    </div>
                </label>
            </div><br>
            <div class="form-check">
                <label class="form-check-label">
                    <div class="col-12">
                        <input type="checkbox" class="form-check-input" name="" id="" value="" >No era lo que buscaba

                    </div>
                </label>
            </div><br>
            <div class="form-check">
                <label class="form-check-label">
                    <div class="col-12">
                        <input type="checkbox" class="form-check-input" name="" id="" value="" >Otro.

                    </div>
                </label>
            </div>
            <br>
            <input type="hidden" name="id" value="<?= $_SESSION["usuario"]["usuario"] ?>">
            <button type="submit" class="btn btn-danger">
                Listo , dar de baja.
            </button>
        </div>
        <br>
    </form><br>
    <div style="margin-top:5%;">
        
    </div>
</div><br>

