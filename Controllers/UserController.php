<?php
    namespace Controllers;

    use Controllers\MovieController;
    use DAO\UserDAO as UserDAO;
    Use Models\User as User;


    

    class UserController
    {
        private $userDAO;
        private $validateSession;
        
        public function __construct(){
            $this->userDAO = new UserDAO();
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
            $movie = new MovieController();
            $movie->ShowMovies();
        }
      
        public function ShowAdminRegisterView()
        {
            require_once(VIEWS_PATH."registerAdmin.php");
        }

        public function checkUser($email)
        {
            $user = $this->userDAO->read($email);

            if($user)
                return true;
            else
                false;
            
        }


        public function login()
        {
            $email = $_POST["email"];
            $password = $_POST["password"];

            

            $count = 0;
            try{
                if($this->checkUser($email))
                {
                    $user = $this->userDAO->read($email);

                    if($user->getPassword() == $password){

                        $_SESSION["loggedUser"] = $user;
                        
                        $message = "Login Successfully";
                        if($user->getRol() == 2) //Cuando es user entra aca
                        {
                            $_SESSION['home'] = FRONT_ROOT.'Movie/showMovies';
                            header("location: ".FRONT_ROOT."Movie/ShowActiveMovies");
                        }
                        else if ($user->getRol() == 1) //Cuando es admin entra aca
                        {
                            $_SESSION['home'] = FRONT_ROOT.'Cinema/ShowAdminHomeView';
                            $this->ShowAdminMenuView($message);
                        }   
                    }
                    else{
                        $message = "Wrong Username or Password";
                        //require_once(VIEWS_PATH."home.php");

                    } 
                }
                else
                {
                    $message= "Wrong Username";
                    require_once(VIEWS_PATH."home.php");
                }
            }
            catch(\PDOException $ex){

            
            }
        }  
        
        public function register(){
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            try{
                if(! $this->checkUser($_POST['email']))
                {
                    $user = new User(null, $_POST['email'] , $_POST['password'] , 0);
                    $this->userDAO->Add($user);
                    $message = "Usuario registrado correctamente";
                }
                else
                    $message = "El usuario ya se encuentra registrado";
                
            }
            catch(\PDOException $ex){
                $message = "Exception";
                throw $ex;
            }
            finally{
                require_once(VIEWS_PATH."home.php");
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