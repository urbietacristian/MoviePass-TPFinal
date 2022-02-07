<?php
require_once(VIEWS_PATH . "navGuest.php");
?>

<main>
<div class="login">
    <h5>Bienvenido</h5>

    <form action="<?php echo FRONT_ROOT ?>User/register" method="POST">

        <table>
            <thead>
                <td colspan="2">Ingrese los datos requeridos para registrarse.</td>
            </thead>
            <!-- <tbody> -->
            <tr>
                <td><label for="">Nombre</label></td>
                <td><input type="text" name="first_name" class="form-control form-control-lg" required></td>
            </tr>
            <tr>
                <td><label for="">Apellido</label></td>
                <td><input type="text" name="last_name" class="form-control form-control-lg" required></td>
            </tr>
            <tr>
                <td><label for="">DNI</label></td>
                <td><input type="number" name="dni" class="form-control form-control-lg" required></td>
            </tr>
            <tr>
                <td> <label for="">Email</label></td>
                <td> <input type="email" name="email" class="form-control form-control-lg" min-length="6" required></td>
            </tr>
            <tr>
                <td> <label for="">Contraseña</label></td>
                <td> <input type="password" name="password" class="form-control form-control-lg" required></td>
            </tr>            
            <!-- </tbody>                     -->
        </table>

        <button class="btn btn-primary btn-block btn-lg" type="submit">Registrarse</button>

    </form>
    <br><br>

<label for="">¿Ya estás registrado?</label>
<div class="btn_cont">
    <a href="<?php echo FRONT_ROOT ?>User/ShowLoginView" class="login-form bg-dark-alpha p-5 bg-light">
        <button class="btn btn-primary btn-block btn-lg">Ingresar</button>
    </a>
</div>
</div>
</main>