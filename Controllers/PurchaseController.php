<?php
    namespace Controllers;

//use chillerlan\QRCode\QRCode;
use DAO\CinemaDAO as CinemaDAO;
    use DAO\MovieDAO as MovieDAO;
    use Models\Purchase as Purchase;
    use DAO\MovieShowDAO;
    use DAO\PurchaseDAO as PurchaseDAO;
    use DAO\RoomDAO as RoomDAO;
    use DAO\TicketDAO;
    use DateTime;
    use Models\Ticket as Ticket;
    use PDOException;
    use Exception;
    use PHPMailer\PHPMailer;
    use PHPMailer\SMPT;
    use Models\QrCode as QrCode;
//use QrCode as GlobalQrCode;

class PurchaseController
    {
        private $purchaseDAO;
        private $movieShowDAO;
        private $movieDAO;
        private $cinemaDAO;
        private $roomDAO;
        private $ticketDAO;
        private $movieshowController;
        private $qrCode;

        public function __construct()
        {
            $this->movieShowDAO = new MovieShowDAO();
            $this->movieDAO = new MovieDAO();
            $this->cinemaDAO = new CinemaDAO;
            $this->roomDAO = new RoomDAO();            
            $this->ticketDAO = new TicketDAO();            
            $this->purchaseDAO = new PurchaseDAO();  
            $this->movieshowController = new MovieShowController();    
            $this->qrCode = new QrCode();      
        }

        public function ShowSalesView()
        {
            ValidationController::getInstance()->validateAdmin();
            $cinemaList = $this->cinemaDAO->GetAll();
            $movieList = $this->movieDAO->getAllMovies();
            require_once(ADMIN_PATH."show_sales.php");
        }

        public function ShowTicketsSoldView()
        {
            ValidationController::getInstance()->validateAdmin();
            $cinemaList = $this->cinemaDAO->GetAll();
            $movieList = $this->movieDAO->getAllMovies();
            require_once(ADMIN_PATH."show_tickets_sold.php");
        }

        public function ShowSoldTicketsByCinemaView()
        {
            ValidationController::getInstance()->validateAdmin();
            if(isset($_GET))
            {
                $id_cinema = $_GET['id_cinema'];
                
                $ticketList = $this->ticketDAO->soldTicketsByCinema($id_cinema);
                $total_sold =0;
                $total_capacity=0;
                foreach($ticketList as $ticket)
                {
                    $total_sold += $ticket['sold'];
                    $total_capacity += $ticket['capacity'];
                }
                if($ticketList)
                {
                    $_SESSION['totals'] = $this->cinemaDAO->getCinemaByID($id_cinema)['0']->getName();
                
                    $cinemaList = $this->cinemaDAO->GetAll();
                    $movieList = $this->movieDAO->getAllMovies();
                    require_once(ADMIN_PATH."show_tickets_sold.php");
                }
                else
                {
                $_SESSION['msg'] = "No hubo ventas de esta pelicula entre esas fechas";
                $this->ShowTicketsSoldView();
                }
            }
        }

        public function ShowSoldTicketsByMovieView()
        {
            ValidationController::getInstance()->validateAdmin();
            if(isset($_GET))
            {
                $id_movie = $_GET['id_movie'];
                
                $ticketList = $this->ticketDAO->soldTicketsByMovie($id_movie);
                $total_sold =0;
                $total_capacity=0;
                foreach($ticketList as $ticket)
                {
                    $total_sold += $ticket['sold'];
                    $total_capacity += $ticket['capacity'];
                }
                if($ticketList)
                {
                    $_SESSION['totals'] = $this->movieDAO->read($id_movie)['0']->getName();
                    $cinemaList = $this->cinemaDAO->GetAll();
                    $movieList = $this->movieDAO->getAllMovies();
                    require_once(ADMIN_PATH."show_tickets_sold.php");
                }
                else
                {
                $_SESSION['msg'] = "No hubo ventas de esta pelicula entre esas fechas";
                $this->ShowTicketsSoldView();
                }
            }
        }

        public function ShowSalesByMovieView()
        {
            ValidationController::getInstance()->validateAdmin();
            if(isset($_GET))
            {
                $id_movie = $_GET['id_movie'];
                $dateIn = $_GET['dateIn'];
                $dateOut = $_GET['dateOut'];

                $totales_vendidos = $this->purchaseDAO->totalByMovie($id_movie, $dateIn, $dateOut)['0'];
                if($totales_vendidos)
                {
                    $_SESSION['totals'] = $this->movieDAO->read($id_movie)['0']->getName();
                    $cinemaList = $this->cinemaDAO->GetAll();
                    $movieList = $this->movieDAO->getAllMovies();
                    require_once(ADMIN_PATH."show_sales.php");
                }
                else
                {
                $_SESSION['msg'] = "No hubo ventas de esta pelicula entre esas fechas";
                $this->ShowSalesView();
                }
            }
        }

        public function ShowSalesByCinemaView()
        {
            ValidationController::getInstance()->validateAdmin();
            if(isset($_GET))
            {
                $id_cinema = $_GET['id_cinema'];
                $dateIn = $_GET['dateIn'];
                $dateOut = $_GET['dateOut'];

                $totales_vendidos = $this->purchaseDAO->totalByCinema($id_cinema, $dateIn, $dateOut)['0'];
                if($totales_vendidos)
                {
                    $cinemaList = $this->cinemaDAO->GetAll();
                    $movieList = $this->movieDAO->getAllMovies();
                    $_SESSION['totals'] = $this->cinemaDAO->getCinemaByID($id_cinema)['0']->getName();
                    require_once(ADMIN_PATH."show_sales.php");
                }
                else
                {
                $_SESSION['msg'] = "No hubo ventas de esta pelicula entre esas fechas";
                $this->ShowSalesView();
                }
            }
        }

        public function ShowPurchaseView($title, $cinema, $price, $id_movieshow)
        {
            ValidationController::getInstance()->validateUser();
            
            require_once(USER_PATH."buy_ticket.php");
        }

        public function ShowCreditCardView()
        {
            if(isset($_POST))
            {
            
                $ticket_count = $_POST['ticket_count'];
                $id_movieshow = $_POST['id_movieshow'];
                $movieshow = $this->movieShowDAO->getMovieShowById($id_movieshow)['0'];
                $room = $this->roomDAO->returnRoomById($movieshow->getidRoom());
                $cinema = $this->cinemaDAO->returnCinemaById($room->getIdCinema());
                $movie = $this->movieDAO->read($movieshow->getIdMovie())['0'];
                $movieshowDate = date_create($movieshow->getDate());
                $weekDay = date_format($movieshowDate, "w");
                $date = date_format($movieshowDate, "d");
                $month = date_format($movieshowDate, "n");
                $time = new DateTime($movieshow->getSchedule());
                $time = date_format($time, "G:i");
                $movieshow_datetime = $this->movieshowController->dateTimeToString($movieshow);

                
                $subtotal = $this->roomDAO->returnRoomById($movieshow->getIdRoom())->getPrice()  *  $ticket_count;
                date_default_timezone_set('America/Argentina/Buenos_Aires');

                $movieshowDate = date_create($movieshow->getDate());
                $date = date_format($movieshowDate, "w");

                if($ticket_count>=2 && ($date =="2" || $date=="3"))
                {
                    $discount = 1;
                    $total= $subtotal*0.75;
                }
                else
                {
                    $discount = 0;
                    $total=$subtotal;
                }
            }
            
            require_once(USER_PATH.'credit_card.php');
        }




        public function newPurchase(){
            try
            {
                $id_movieshow = $_POST['id_movieshow'];
                if(isset($_POST))
                {
                    $ticket_count = $_POST['ticket_count'];
                    $id_movieshow = $_POST['id_movieshow'];
                    $discount = $_POST['discount'];
                    $subtotal = $_POST['subtotal'];
                    $total = $_POST['total'];
                    
                    if(isset($_SESSION['loggedUser']))
                    {
                        //tomo el obj funcion de la sesion !PROVISORIO!
                        
                        $user = $_SESSION['loggedUser'];                       
                        $movieshow = $this->movieShowDAO->getMovieShowById($id_movieshow)['0'];
                        $room = $this->roomDAO->returnRoomById($movieshow->getidRoom());
                        $cinema = $this->cinemaDAO->getCinemaByID($room->getIdCinema())['0'];
                        $movieshowDate = $this->movieshowController->dateTimeToString($movieshow);
                        $movie = $this->movieDAO->read($movieshow->getIdMovie())['0'];
                        //purchase
                        
                        $qrsToSend=array();
                        $today_date = date('Y-m-d');


                        $last_ticket = $this->ticketDAO->lastTicketNumber($id_movieshow)['ticket_number']; // valor de la ultima ticket en bd
                

                        if($last_ticket== null) //busco la ultima ticket vendida y retorno, si es null(todavia no hay tickets para esa funcion) es 0
                        {
                            $last_ticket=0;
                        }
                        $capacity = intval($this->roomDAO->returnRoomById($movieshow->getIdRoom())->getCapacity());


                        if( ($last_ticket+$ticket_count) > $capacity ) //entra si no hay mas capacidad
                        {
                            $_SESSION['msg']="No hay suficientes entradas disponibles para esta funcion !";
                            header("location: ".FRONT_ROOT."MovieShow/ShowFunctionsByMovie/".$movieshow->getIdMovie()."");
                        }
                        else//entra si hay capacidad disponible
                        {
                            

                            
                            $purchase= new Purchase($user->getId(),$today_date,$discount, $subtotal, $total);
                            
                            $purchase =$this->purchaseDAO->Add($purchase);
                            $id_purchase = $this->purchaseDAO->getLastIdPurchase();
                            
                            //ticket
                            //echo ($last_ticket+$ticket_count);
                            $ticket_number=$last_ticket+1; //agrego +1 al la ultima ticket guardada     
                            $cant = 0;      
                            for ($i = 0; $i < $ticket_count; $i++) //genero la cantidad de tickets pasadas por parametro
                            {                
            
                                $ticket= new Ticket(null,$ticket_number,$id_movieshow,$id_purchase); 
                                $ticket =$this->ticketDAO->Add($ticket);
                                $ticket_number++;
                                $cant++;
                                
                                // //ob_start();
                                // QRCode::png($info);
                                // //$png = ob_end_clean()
                                
                                // array_push($qrsToSend,$id_qr);     
                            }//end for

                            $info = 
                            "Pelicula: ".$movie->getName()."<br>".
                            "Cine:  ".$cinema->getName()."<br>".
                            "Sala:  ".$room->getName()."<br>".
                            "Fecha y hora:  ".$movieshowDate."<br>".
                            "Cantidad de Tickets: ".$cant;
                        
            
                            $mail = new PHPMailer\PHPMailer(true);

                            try {
                                //Server settings
                                $mail->SMTPDebug = 0;                      // Enable verbose debug output
                                $mail->isSMTP();                                            // Send using SMTP
                                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                $mail->Username   = 'lucio.chapaman@gmail.com';                     // SMTP username
                                $mail->Password   = 'lmlquapjyvwhwvcs';                               // SMTP password
                                $mail->SMTPSecure = PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                                //Recipients
                                $mail->setFrom('lucio.chapaman@gmail.com', 'MoviePass');
                                $mail->addAddress($user->getEmail(), 'Joe User');     // Add a recipient
                                // foreach($qrsToSend as $qr)
                                // {
                                //     $mail->addEmbeddedImage()
                                // }
                                
                                // Attachments
                            
                                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments

                                // Content
                                $mail->isHTML(true);                                  // Set email format to HTML
                                $mail->Subject = 'Compra exitosa';
                                $mail->Body    = $info;

                                $mail->send();
                                echo 'Message has been sent';
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }            

                            $_SESSION['msg']="Compra Exitosa!";
                            header("location: ".FRONT_ROOT."Movie/ShowActiveMovies");
            
                        }//end else
                    
                    }//end if
                    else
                    {
                        
                        //si no hay session le pido iniciar session FALTA HACER
                        $_SESSION['msg']="Antes de comprar ingresar!";
                        header("location: ".FRONT_ROOT."User/ShowRegisterView");
                        
                    }
                }
                else
                {

                }
            }
            catch(PDOException $ex)
            {
                $_SESSION['Error']="Error al crear una nueva purchase)";
            }              
            
            
        
        }//new purchase
        
    }