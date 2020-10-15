<main class="d-flex align-items-center justify-content-center height-100" >
          <div class="content">
               <div class="container">
                    <div class="grid"> 
                         <div class="form_login">
                              
                              <div class="form">                 
                                   <form action="<?php echo FRONT_ROOT ?>User/login" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                                   <?php
                                        if(isset($error)){
                                            
                                            echo "<div class='error' >Usuario y/o contraseña incorrecto</div>  ";     
                                        }
                                         
                                   ?>
                                        <div class="form-group">
                                             <label for="">Email</label>
                                             <input type="text" name="email" class="form-control form-control-lg" >
                                        </div>
                                        <div class="form-group">
                                             <label for="">Password</label>
                                             <input type="password" name="password" class="form-control form-control-lg" >
                                        </div>
                                        <div class="btn_cont">
                                        <button class="btn btn-primary btn-block btn-lg" type="submit">Login</button>
                                        </div>
                                   </form>
                                   <a href="<?php echo FRONT_ROOT ?>User/ShowRegisterView" class="login-form bg-dark-alpha p-5 bg-light">
                                   <div class="btn_cont">
                                        <button class="btn btn-primary btn-block btn-lg" >Register</button>
                                   </div>
                                   </a>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </main>
