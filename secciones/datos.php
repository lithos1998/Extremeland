<div class="container my-5">
    <div class="row  justify-content-center">
        <div class="card" style="width: 40rem;color:black;">
            <img class="card-img-top img-fluid"  src="img/home/logo.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title" style="font-size:40px;">! Hola <?= $_SESSION["usuario"]["usuario"]  ?> ¡</h5>
                <p class="card-text" style="font-size:30px;">Bienvenido a EXTREMELAND.</p>
            </div>
            <ul class="list-group list-group-flush" style="font-size:35px;">
                <li class="list-group-item">mail : <?= $_SESSION["usuario"]["mail"]  ?> </li>
                <li class="list-group-item">usuario : <?= $_SESSION["usuario"]["usuario"]  ?> </li>
            </ul>
            <!--
            <div class="container">
                <form action="editar_usuario" method="post">
                    <input type="hidden" name="id" value="<?= $_SESSION["usuario"]["id"] ?>">
                    <button type="submit" class="btn btn-info">
                        editar datos
                    </button>
                </form>
            </div>
            -->
            <br>
        </div><br>
    </div><br>
</div><br>
