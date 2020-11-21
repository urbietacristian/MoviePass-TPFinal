<?php
    require_once(VIEWS_PATH."navGuest.php");
?>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<main class="d-flex align-items-center justify-content-center height-100" >
     <div class="content">
          <div class="container">
               <div class="grid"> 
                    <div class="form_login">
                         <div align = 'center' class="form">                 
                              <form action="<?php echo FRONT_ROOT ?>User/login" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                                   <h5>Bienvenido</h5>
                                   <t1>Ingrese los datos requeridos para acceder.</t1><br><br>
                                   
                                   <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control form-control-lg" >
                                   </div>
                                   <div class="form-group">
                                        <label for="">Contraseña</label>
                                        <input type="password" name="password" class="form-control form-control-lg" >
                                        <br>
                                   </div>
                                   <div class="btn_cont">
                                   <button class="btn btn-primary btn-block btn-lg" type="submit">Ingresar</button>
                                   </div>
                                   <br>
                                   <div><a class="btn btn-primary btn-block btn-lg" style="background-color:dodgerblue; border-color:dodgerblue" href="<?php echo $loginUrl?>">Ingresar Con Facebook</a></div>
                                   
                                   
                              </form>
                              <br><br>
                              <label for="">¿Aún no estás registrado?</label>
                              <div class="btn_cont">
                                   <a href="<?php echo FRONT_ROOT ?>User/ShowRegisterView" class="login-form bg-dark-alpha p-5 bg-light">
                                        <button class="btn btn-primary btn-block btn-lg" >Crear una cuenta</button>
                                   </a>
                              </div>                                   
                         </div>
                    </div>
               </div>
          </div>
     </div>
</main>
