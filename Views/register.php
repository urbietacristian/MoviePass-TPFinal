<main class="d-flex align-items-center justify-content-center height-100" >
          <div class="content">
               <div class="container">
                    <div class="grid"> 
                         <div class="form_login">
                              <div align = 'center' class="form">                 
                                   <form action="<?php echo FRONT_ROOT ?>User/register" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                                   <?php
                                        if(isset($error)){
                                            
                                            echo "<div class='error' >Usuario existente</div>  ";     
                                        }
                                         
                                   ?>
                                   <t1>Registrase</t1>
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
                                        <button class="btn btn-primary btn-block btn-lg" type="submit">Register</button>
                                        </div>
                                        
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </main>