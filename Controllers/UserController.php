<?php
    namespace Controllers;

    use Controllers\MovieController;
    use DAO\UserDAO as UserDAO;
    Use Models\User as User;


    

    class UserController
    {
        private $userDAO;
        
        public function __construct()
        {
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

                    if($user->getPassword() == $password)
                    {

                        $_SESSION["loggedUser"] = $user;

                        $message = "Login Successfully";
                        if($user->getRol() == 2) //Cuando es user entra aca
                        {
                            $_SESSION['home'] = FRONT_ROOT.'Movie/showActiveMovies';

                            header("location: ".FRONT_ROOT."Movie/ShowActiveMovies");
                        }
                        else if ($user->getRol() == 1) //Cuando es admin entra aca
                        {
                            $_SESSION['home'] = FRONT_ROOT.'Movie/showMovies';
                            $this->ShowAdminMenuView($message);
                        }
                    }
                    else{
                        $message = "Wrong Username or Password";
                        $_SESSION['home'] = FRONT_ROOT.'Home/Index';
                        require_once(VIEWS_PATH."home.php");
                    } 
                }
                else
                {
                    $message= "Wrong Username";
                    $_SESSION['home'] = FRONT_ROOT.'Home/Index';
                    require_once(VIEWS_PATH."home.php");
                }
            }
            catch(\PDOException $ex){

            }
        }
        /*
        public function registerAdmin(){
            
            $userName = $_POST['email'];
            $password = $_POST['password'];
            $rol = '1';
            
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
        
        }*/

        public function register()
        {            
            $userName = $_POST['email'];
            $password = $_POST['password'];
            $rol = '2';
            
            if(!$this->checkUser($userName))
            {
                $newUser = new User(null, $userName, $password, $rol);

                $newUserRepository = new UserDAO();
                $newUserRepository->Add($newUser);
                $_SESSION['msg'] = "Usuario creado exitosamente.";

                require_once(VIEWS_PATH."home.php");
            }
            else{
                $_SESSION['msg'] = "El email ingresado ya pertenece a una cuenta existente.";
                require_once(VIEWS_PATH."register.php");
            }        
        }        

        public function logout()
        {
            session_destroy();

            session_start();

            $_SESSION['msg'] = "Has cerrado sesion";

            header("location: ".FRONT_ROOT."Home/Index");
        }
        
    }
?>