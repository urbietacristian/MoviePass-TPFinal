<?php
    namespace Controllers;

    use Controllers\BillboardController;
    use DAO\UserDAO as UserDAO;
    Use Models\User as User;


    

    class UserController
    {
        private $userDAO;
        
        public function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function ShowMenuView($message)
        {
            $billboard = new BillboardController();
            $billboard->ShowMovies();
        }
        public function ShowMainView($message)
        {
            require_once(VIEWS_PATH."home.php");
            echo '<script language="javascript">alert("'.$message.'");</script>';
        }
        public function ShowRegisterView()
        {
            require_once(VIEWS_PATH."register.php");
        }

        public function ShowAdminMenuView($message)
        {  
            
            require_once(ADMIN_PATH."homeAdmin.php");
        }
      
        public function ShowAdminRegisterView()
        {
            require_once(VIEWS_PATH."registerAdmin.php");
        }


        public function login()
        {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $userList = $this->userDAO->GetAll();
           
            $count = 0;
            $error = NULL;

            foreach($userList as $user){
                if(($user -> getEmail() == $email) && ($user -> getPassword() == $password)){

                    $count = 1;
                    
                    $loggedUser = new User();
                    $loggedUser->setEmail($email);
                    $loggedUser->setPassword($password);
                    $loggedUser->setRol($user->getRol());

                    $_SESSION["loggedUser"] = $loggedUser;
                    
                    $message = "Login Successfully";
                    if($user->getRol() == 'user')
                    {
                        $this->ShowMenuView($message);
                    }
                    else if ($user->getRol() == 'admin')
                    {
                        $this->ShowAdminMenuView($message);
                    }
                    
                }
            }
            if ($count === 0){
                $error = 1;
                require_once(VIEWS_PATH."home.php");
            }
           
        }  
        
        public function register(){
            
            $userName = $_POST['email'];
            $password = $_POST['password'];
            $rol = 'user';
            
            

            

            
            $newUser = new User();
        
            $newUser->setEmail($userName);
            $newUser->setPassword($password);
            $newUser->setRol($rol);
            //$newUser ->setClient($newClient);

        
            $newUserRepository = new UserDAO();
            $valid = $newUserRepository->Add($newUser);
        
            if ($valid === 0){
                $error = "invalid";
                require_once(VIEWS_PATH."register.php");
            }else{
                //usar require ya que permite el pasaje de la variable para mensajes, si uso la funcion show no puedo pasar vars.
                $error = "03";
                require_once(VIEWS_PATH."main.php");
            }
        
        }
        /*
        public function registerAdmin(){
            
            $userName = $_POST['email'];
            $password = $_POST['password'];
            $rol = 'admin';
            
            $newUser = new User();
        
            $newUser->setEmail($userName);
            $newUser->setPassword($password);
            $newUser->setRol($rol);

        
            $newUserRepository = new UserDAO();
            $valid = $newUserRepository->Add($newUser);
        
            if ($valid === 0){
                $error = "invalid";
                require_once(VIEWS_PATH.ADMIN_PATH."registerAdmin.php");
            }else{
                //usar require ya que permite el pasaje de la variable para mensajes, si uso la funcion show no puedo pasar vars.
                $error = "03";
                require_once(VIEWS_PATH."main.php");
            }
        
        }
        */

        public function logout()
        {
            session_destroy();

            $message = "Logout Successfully";

            $this->ShowMainView($message);
        }
        
    }
?>