<?php
    namespace Controllers;

    class ValidationController 
    {
        private static $instance; 

        public static function getInstance()
        {
            if(self::$instance == null)
                self::$instance = new ValidationController();

            return self::$instance;
        }


        public function validateAdmin()
        {
            
            if(!isset($_SESSION['loggedUser']))
            {
                header("location:".FRONT_ROOT."Home/Index");
                return; 
            }
            else
            { 
                $user = $_SESSION['loggedUser'];
                if ($user->getRol() != 1){
                    header("location:".FRONT_ROOT."Home/Index");
                    return;
                }
            }   
            return;  
        }

        public function validateUser()
        {
            if(!isset($_SESSION['loggedUser']))
            {
                header("location:../Home/Index");
                exit;  
            }
        }
    }

        ?>