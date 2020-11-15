<?php
    require_once(VIEWS_PATH."navGuest.php");
?>

<main class="d-flex align-items-center justify-content-center height-100" >
     <div class="content">
          <div class="container">
               <div class="grid"> 
                    <div class="form_login">
                         <div class="form" align = 'center'>                 
                              <form action="<?php echo FRONT_ROOT ?>User/register" method="POST" class="login-form bg-dark-alpha p-5 bg-light">                                   
                                   <h5>Bienvenido</h5>
                                   <t1>Ingrese los datos requeridos para registrarse.</t1><br><br>     
                                   <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control form-control-lg" min-length="6" required>
                                   </div>
                                   <div class="form-group">
                                        <label for="">Contraseña</label>
                                        <input type="password" name="password" class="form-control form-control-lg" required>
                                        <br>
                                   </div>
                                   <div class="btn_cont">
                                        <button class="btn btn-primary btn-block btn-lg" type="submit">Registrarse</button>
                                   </div>
                                   
                              </form>                                   
                              <br><br>
                              <label for="">¿Ya estás registrado?</label>
                              <div class="btn_cont">
                                   <a href="<?php echo FRONT_ROOT ?>User/ShowLoginView" class="login-form bg-dark-alpha p-5 bg-light">
                                        <button class="btn btn-primary btn-block btn-lg" >Ingresar</button>
                                   </a>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</main>