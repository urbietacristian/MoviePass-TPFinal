<?php
    namespace Controllers;
    use Controllers\ValidationController as ValidationController;


    class HomeController
    {
        public function Index($message = "")
        {
            if(!isset($_SESSION['loggedUser']))
            {
                $_SESSION['home'] = FRONT_ROOT.'Home/Index';
                header("location:".FRONT_ROOT."Movie/ShowActiveMovies");
            }
            else if($_SESSION['loggedUser'])
            { 
                $user = $_SESSION['loggedUser'];
                if ($user->getRol() != 1){
                    header("location:".FRONT_ROOT."Movie/ShowActiveMovies");
                    return;
                }
            }   
            return;  
                require_once(VIEWS_PATH."login.php");
                
        }        
    }    
?>