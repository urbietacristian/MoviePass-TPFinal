<?php
    require_once(VIEWS_PATH."navGuest.php");
?>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<main >     
    <div class="login"> 
            <h5>Bienvenido</h5>
            <t1>Ingrese los datos requeridos para acceder.</t1><br><br>                          
            <form action="<?php echo FRONT_ROOT ?>User/login" method="POST">
            <table>
                <tr>                
                <td><label for="">Email</label></td>
                <td><input type="email" name="email" class="form-control form-control-lg" ></td>
                </tr>
                <tr>
                <td><label for="">Contraseña</label></td>
                <td><input type="password" name="password" class="form-control form-control-lg" ></td>
                </tr>
                </table>                
                
                <button class="btn btn-primary btn-block btn-lg" type="submit">Ingresar</button>                                                          
                <!--
                    Ingresar con Facebook dejó de funcionar
                <div><a class="btn btn-primary btn-block btn-lg" style="background-color:dodgerblue; border-color:dodgerblue" href="<?php echo $loginUrl?>">Ingresar Con Facebook</a></div>
                -->                
            </form>
        <br><br>
        <label for="">¿Aún no estás registrado?</label>
        <div class="btn_cont">
            <a href="<?php echo FRONT_ROOT ?>User/ShowRegisterView" class="login-form bg-dark-alpha p-5 bg-light">
                <button class="btn btn-primary btn-block btn-lg" >Crear una cuenta</button>
            </a>
        </div>                                   
    </div>
</main>
