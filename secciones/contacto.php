<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 text-center">Contacto</h1>
        </div>
    </div>
     <?php
        if(isset($_SESSION["error"])){
            $error = $_SESSION["error"];
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
            unset($_SESSION["error"]);
        }
    ?>
    <div class="row justify-content-center">
        <div class="col-6">
            <form action="procesar.php" method="POST">
            
            <?php
                
                
               foreach($formulario as $form):
                    if($form["dato"]=="mail"){
                        echo "<div class='form-group'>
                                 <label class='col-sm-3 control-label'>".$form["dato"]."</label>
                                 <div class='col-12'>
                                     <input type='text' name='". $form["dato"] ."' class='form-control' placeholder='".$form['placeholder']."'>
                                 </div>
                                 <small id='helpId' class='col-sm-3 text-muted'>*INPORTANTE que el mail sea correcto</small>
                              </div>";
                    }else{
                        echo "<div class='form-group'>
                                <label class='col-sm-3 control-label'>". $form["dato"] ."</label>
                                <div class='col-12'>
                                    <input type='text' name='". $form["dato"] ."' class='form-control' placeholder='". $form["dato"] ."'>
                                </div>
                             </div> ";
                    }
                endforeach;
            ?>
                
        <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXX CHECKBOXXXXXXXXXXXXXXXXXXX  -->
                <div class="form-group">
                <?php
                    foreach($opciones as $opcion):
                ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <div class="col-12">
                                <input type="checkbox" class="form-check-input" name="consulta[]" id="" value="<?= $opcion["opcion"] ?>" >
                                <?=$opcion["contenido"] ?>
                            </div>
                        </label>
                    </div>
                <?php
                    endforeach;
                ?>
                </div>
                <div class="form-group">
                    <label for="comment">Comentarios:</label>
                      <textarea class="form-control" rows="5" id="comment" name="comentarios" placeholder="comentarios"></textarea>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 col-sm-12">
                        <button type="submit" class="btn btn-dark btn-lg">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
