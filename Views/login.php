<main class="d-flex align-items-center justify-content-center height-100" >
     <div class="content">
          <div class="container">
               <div class="grid"> 
                    <div class="form_login">
                         <div align = 'center' class="form">                 
                              <form action="<?php echo FRONT_ROOT ?>User/login" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                              <?php
                                   $_SESSION['home'] = FRONT_ROOT.'Cinema/ShowHomeView';
                                   
                                   if(isset($_SESSION['msg']))
                                   {
                                        echo '<script language="javascript">alert("'.$_SESSION['msg'].'");</script>';
                                        $_SESSION['msg'] = null;
                                   }
                                             
                              ?>
                                   <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control form-control-lg" >
                                   </div>
                                   <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control form-control-lg" >
                                        <br>
                                   </div>
                                   <div class="btn_cont">
                                   <button class="btn btn-primary btn-block btn-lg" type="submit">Login</button>
                                   </div>
                                   
                              </form>
                              <div class="btn_cont">
                                   <a href="<?php echo FRONT_ROOT ?>User/ShowRegisterView" class="login-form bg-dark-alpha p-5 bg-light">
                                        <br><button class="btn btn-primary btn-block btn-lg" >Register</button>
                                   </a>
                              </div>                                   
                         </div>
                    </div>
               </div>
          </div>
     </div>
</main>
