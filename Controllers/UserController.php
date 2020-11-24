<?php
    namespace Controllers;

    use Controllers\MovieController;
    use DAO\UserDAO as UserDAO;
    Use Models\User as User;
    use Facebook;
    
        

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

        public function ShowLoginView()
        {

            $fb = new Facebook\Facebook(array(
                'app_id' => '813085052788956',
                'app_secret' => 'efd7113ea0a3119968ce477683bbb9ac',
                'default_graph_version' => 'v9.0',
            ));
             
            $helper = $fb->getRedirectLoginHelper();
            $permissions = ['email'];
            $loginUrl = $helper->getLoginUrl('https://localhost/MoviePass-TPFinal/User/facebookLogin',$permissions);
            require_once(VIEWS_PATH."login.php");
        }

        public function ShowAdminMenuView($message)
        {  
            $movie = new MovieController();
            $movie->ShowMovies();
        }
      
        public function ShowRegisterAdminView()
        {
            require_once(ADMIN_PATH."register_new_admin.php");
        }

        public function checkUser($email)
        {
            $user = $this->userDAO->read($email);

            if($user)
                return true;
            else
                false;            
        }


        public function facebookLogin()
        {
            $fb = new Facebook\Facebook([
                'app_id' => '813085052788956',
                'app_secret' => 'efd7113ea0a3119968ce477683bbb9ac',
                'default_graph_version' => 'v9.0',
                ]);
              

                $helper = $fb->getRedirectLoginHelper();
                try {
                  $accessToken = $helper->getAccessToken();
                } catch(Facebook\Exceptions\FacebookResponseException $e) {
                  // When Graph returns an error
                  echo 'Graph returned an error: ' . $e->getMessage();
                  exit;
                } catch(Facebook\Exceptions\FacebookSDKException $e) {
                  // When validation fails or other local issues
                  echo 'Facebook SDK returned an error: ' . $e->getMessage();
                  exit;
                }
                
                if (isset($accessToken)) {
                  // Logged in!
                  $_SESSION['facebook_access_token'] = (string) $accessToken;
                  try {
                    // Returns a `Facebook\Response` object
                    $response = $fb->get('/me?fields=id,email,first_name,last_name', $accessToken);
                    $userNode = $response->getGraphUser();
                    $graphNode = $response->getGraphNode();
                    
                    if($this->checkUser($userNode['email']))
                    {
                        $user = $this->userDAO->read($userNode['email']);
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
                    else
                    {
                        $password = $userNode->getId();
                        $newUser = new User(null, $userNode->getEmail(), $password, '2', $userNode->getFirstName(), $userNode->getLastName(), 12345678);

                        $newUserRepository = new UserDAO();
                        $newUserRepository->Add($newUser);
                        $user = $this->userDAO->read($userNode['email']);
                        $_SESSION["loggedUser"] = $user;
                        $_SESSION['msg'] = "Usuario creado y logueado exitosamente.";
                        $_SESSION['home'] = FRONT_ROOT.'Movie/showActiveMovies';
                        header("location: ".FRONT_ROOT."Movie/ShowActiveMovies");
                    }
                    } catch(Facebook\Exceptions\FacebookResponseException $e) {
                    echo 'Graph returned an error: ' . $e->getMessage();
                    exit;
                    } catch(Facebook\Exceptions\FacebookSDKException $e) {
                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                    exit;
                     }    
                }
                
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
                        $_SESSION['msg'] = "Los datos que has introducido son incorrectos.";
                        $_SESSION['home'] = FRONT_ROOT.'Home/Index';
                        header("location: ".FRONT_ROOT."User/ShowLoginView");
                    } 
                }
                else
                {
                    $_SESSION['msg'] = "El mail que has introducido no corresponde a una cuenta registrada.";
                    $_SESSION['home'] = FRONT_ROOT.'Home/Index';
                    header("location: ".FRONT_ROOT."User/ShowLoginView");
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
            $first_name = $_POST['first_name'];
            $last_name =$_POST['last_name'];
            $dni = $_POST['dni'];
            
            if(!$this->checkUser($userName))
            {
                $newUser = new User(null, $userName, $password, $rol, $first_name, $last_name, $dni);

                $newUserRepository = new UserDAO();
                $newUserRepository->Add($newUser);
                $_SESSION['msg'] = "Usuario creado exitosamente.";

                require_once(VIEWS_PATH."login.php");
            }
            else{
                $_SESSION['msg'] = "El email ingresado ya pertenece a una cuenta existente.";
                require_once(VIEWS_PATH."register.php");
            }        
        }

        

        public function registerAdmin()
        {            
            $userName = $_POST['email'];
            $password = $_POST['password'];
            $rol = '1';
            $first_name = $_POST['first_name'];
            $last_name =$_POST['last_name'];
            $dni = $_POST['dni'];
            
            if(!$this->checkUser($userName))
            {
                $newUser = new User(null, $userName, $password, $rol, $first_name, $last_name, $dni);

                $newUserRepository = new UserDAO();
                $newUserRepository->Add($newUser);
                $_SESSION['msg'] = "Administrador registrado exitosamente.";

                header("location: ".FRONT_ROOT."Movie/ShowMovies");
            }
            else{
                $_SESSION['msg'] = "El email ingresado ya pertenece a una cuenta existente.";
                require_once(ADMIN_PATH."register_new_admin.php");
            }        
        }

        public function logout()
        {
            session_destroy();

            session_start();

            $_SESSION['msg'] = "Has cerrado sesion";
            $_SESSION['home'] = FRONT_ROOT.'Home/Index';

            header("location: ".FRONT_ROOT."Home/Index");
        }
        
    }
?>