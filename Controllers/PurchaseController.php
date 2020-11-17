<?php
    namespace Controllers;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\MovieDAO as MovieDAO;
    use Models\Purchase as Purchase;
    use DAO\MovieShowDAO;
    use DAO\PurchaseDAO as PurchaseDAO;
    use DAO\RoomDAO as RoomDAO;
    use DAO\TicketDAO;
    use Models\Ticket as Ticket;
    use PDOException;

class PurchaseController
    {
        private $purchaseDAO;
        private $movieShowDAO;
        private $movieDAO;
        private $cinemaDAO;
        private $roomDAO;
        private $ticketDAO;

        public function __construct()
        {
            $this->movieShowDAO = new MovieShowDAO();
            $this->movieDAO = new MovieDAO();
            $this->cinemaDAO = new CinemaDAO;
            $this->roomDAO = new RoomDAO();            
            $this->ticketDAO = new TicketDAO();            
            $this->purchaseDAO = new PurchaseDAO();            
        }

        public function ShowPurchaseView($title, $cinema, $price, $id_movieshow)
        {
            ValidationController::getInstance()->validateUser();
            
            require_once(USER_PATH."buy_ticket.php");
        }

        public function ShowCreditCardView()
        {
            require_once(USER_PATH.'credit_card.php');
        }




        public function newPurchase(){
            try
            {
                $id_movieshow = $_POST['id_movieshow'];
                if($_POST['ticket_count'])
                {
                    $ticket_count = $_POST['ticket_count'];
                    $id_movieshow = $_POST['id_movieshow'];
                    if(isset($_SESSION['loggedUser']))
                    {
                        //tomo el obj funcion de la sesion !PROVISORIO!
                        
                        $user = $_SESSION['loggedUser'];
                        $movieshow = $this->movieShowDAO->getMovieShowById($id_movieshow)['0'];
                        //purchase
                        
                        $subtotal = $this->roomDAO->returnRoomById($movieshow->getIdRoom())->getPrice()  *  $ticket_count;
                        date_default_timezone_set('America/Argentina/Buenos_Aires');

                        $today_date = date('Y-m-d');

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
                        
                        $qrsToSend=array();

                        $last_ticket = $this->ticketDAO->lastTicketNumber($movieshow->getId()); // valor de la ultima ticket en bd

                        if($last_ticket== null) //busco la ultima ticket vendida y retorno, si es null(todavia no hay tickets para esa funcion) es 0
                        {
                            $last_ticket='0';
                        }
                        $capacity = intval($this->roomDAO->returnRoomById($movieshow->getIdRoom())->getCapacity());

                        var_dump($last_ticket+$ticket_count);

                        if( ($last_ticket+$ticket_count) > $capacity ) //entra si no hay mas capacidad
                        {
                            $_SESSION['msg']="Error  disponibles!";
                            //header("location: ".FRONT_ROOT."Purchase/ShowPurchaseView");
                        }
                        else//entra si hay capacidad disponible
                        {
                            var_dump($capacity);

                            
                            $purchase= new Purchase($user->getId(),$today_date,$discount, $subtotal, $total);
                            
                            $purchase =$this->purchaseDAO->Add($purchase);
                            $id_purchase = $this->purchaseDAO->getLastIdPurchase();
                            
                            //ticket
                            //echo ($last_ticket+$ticket_count);
                            $ticket_number=$last_ticket+1; //agrego +1 al la ultima ticket guardada           
                            for ($i = 0; $i < $ticket_count; $i++) //genero la cantidad de tickets pasadas por parametro
                            {                
            
                                $ticket= new Ticket(null,$ticket_number,$id_movieshow,$id_purchase); 
                                $ticket =$this->ticketDAO->Add($ticket);
                                $ticket_number++;
                                // $qr=new QR();
                                // $qr->setTicket($ticket);
                                
                                // $id_qr=$this->DAOQR->add($qr);
                                
                                // array_push($qrsToSend,$id_qr);
                                
                                
                            }//end for
            
                            
            
                            //$this->mailsController->enviarMailPurchase($purchase,$qrsToSend);
                            //si no hay session lo llevo a home
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
                var_dump($capacity);
                $_SESSION['Error']="Error al crear una nueva purchase)";
            }
                    
            
            
        
        }//new purchase
        //
        //
        //
    }