<?php
    require_once(VIEWS_PATH."navAdmin.php");
?>

<main class="d-flex align-items-center justify-content-center height-100" >
     <div class="content">
          <div class="container">
               <div class="grid"> 
                    <div class="form_login">
                         <div class="form" align = 'center'>                 
                              <form action="<?php echo FRONT_ROOT ?>User/registerAdmin" method="POST" class="login-form bg-dark-alpha p-5 bg-light">                                   
                                   <h5>Nuevo Admin</h5>
                                   <t1>Ingrese los datos requeridos para registrar un nuevo administrador.</t1><br><br>     
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
                                        <button class="btn btn-primary btn-block btn-lg" type="submit">Registrar</button>
                                   </div>                                   
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</main>