<?php
require_once(VIEWS_PATH . "navGuest.php");
?>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<main>
    <div class="login">
        <h5>Bienvenido</h5>

        <form action="<?php echo FRONT_ROOT ?>User/login" method="POST">

            <table>
                <thead>
                    <td colspan="2">Ingrese los datos solicitados para acceder.</td>
                </thead>
                <tr>
                    <td><label for="">Email</label></td>
                    <td><input type="email" name="email" class="form-control form-control-lg" required></td>
                </tr>
                <tr>
                    <td><label for="">Contraseña</label></td>
                    <td><input type="password" name="password" class="form-control form-control-lg" required></td>
                </tr>
            </table>

            <button  type="submit">Ingresar</button>
            <!--
                    Ingresar con Facebook dejó de funcionar
                <div><a class="btn btn-primary btn-block btn-lg" style="background-color:dodgerblue; border-color:dodgerblue" href="<?php echo $loginUrl ?>">Ingresar Con Facebook</a></div>
                -->
        </form>
        <br><br>
        <label for="">¿Aún no estás registrado?</label>
        <div class="btn_cont">
            <a href="<?php echo FRONT_ROOT ?>User/ShowRegisterView" class="login-form bg-dark-alpha p-5 bg-light">
                <button class="btn btn-primary btn-block btn-lg">Crear una cuenta</button>
            </a>
        </div>
    </div>
</main>
