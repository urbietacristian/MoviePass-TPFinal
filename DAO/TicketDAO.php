<?php
    namespace DAO;

    use Models\Ticket as Ticket;

    class TicketDAO
    {
        public function Add($ticket){
         
            $sql = 'INSERT INTO tickets 
            (ticket_number, id_movieshow, id_purchase) 
            VALUES 
            (:ticket_number, :id_movieshow, :id_purchase)';

            
            $ticket_number = $ticket->getTicketNumber();
            $id_movieshow = $ticket->getMovieShow();
            $id_purchase = $ticket->getIdPurchase();
            
            
            $parameters['id_purchase'] = $id_purchase;
            $parameters['ticket_number'] = $ticket_number;
            $parameters['id_movieshow'] = $id_movieshow;
    
            try{
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($sql, $parameters);
            
            }
            catch(\PDOException $ex){
                throw $ex;
            }
        }

        public function read($id_ticket){

            $sql = "SELECT * FROM tickets WHERE id_ticket = :id_ticket";
    
            $parameters['id_ticket'] = $id_ticket;
    
            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->execute($sql,$parameters);
            }
            catch(\PDOException $ex){
                throw $ex;
            }
    
            if(!empty($result))
                return $this->map($result);
            else
                return false;
            
        }

        public function lastTicketNumber($id_movieshow)
        {            
            $sql = 'call sp_returnLastTicket(:id_movieshowE)';
    
            $parameters['id_movieshowE'] = $id_movieshow;

            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->execute($sql,$parameters);
            }
            catch(\PDOException $ex){
                throw $ex;
            }

            if(!empty($result))
                return $result['0'];
            else
                return null;
        }


        
        public function soldTicketsByMovie($id_movie)
        {            
            $sql = 'call sp_SoldTicketsByMovie(:id_movie)';
    
            $parameters['id_movie'] = $id_movie;

            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->execute($sql,$parameters);
            }
            catch(\PDOException $ex){
                throw $ex;
            }


            if(!empty($result))
            {
                $result = is_array($result) ? $result : [];
                
                return count($result) > 0 ? $result : $result['0'];
            }
    
            else
                return false;
        }

        public function soldTicketsByCinema($id_cinema)
        {            
            $sql = 'call sp_SoldTicketsByCinema(:id_cinema)';
    
            $parameters['id_cinema'] = $id_cinema;

            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->execute($sql,$parameters);
            }
            catch(\PDOException $ex){
                throw $ex;
            }



            if(!empty($result))
            {
                $result = is_array($result) ? $result : [];
                
                return count($result) > 0 ? $result : $result['0'];
            }
            else
                return null;
        }

        public function userTicketsByMovieshowDate($id_user)
        {            
            $sql = 'call sp_userTicketsByMovieshowDate(:id_user)';
    
            $parameters['id_user'] = $id_user;

            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->execute($sql,$parameters);
            }
            catch(\PDOException $ex){
                throw $ex;
            }

            if(!empty($result))
            {
                $result = is_array($result) ? $result : [];
                
                return count($result) > 0 ? $result : $result['0'];
            }
            else
                return null;
        }

        public function userTicketsByMovie($id_user)
        {            
            $sql = 'call sp_userTicketsByMovie(:id_user)';
    
            $parameters['id_user'] = $id_user;

            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->execute($sql,$parameters);
            }
            catch(\PDOException $ex){
                throw $ex;
            }

            if(!empty($result))
            {
                $result = is_array($result) ? $result : [];
                
                return count($result) > 0 ? $result : $result['0'];
            }
            else
                return null;
        }

        
        public function getByIdPurchase($id_purchase){

            $sql = "SELECT * FROM tickets WHERE id_purchase = :id_purchase";
    
            $parameters['id_purchase'] = $id_purchase;
    
            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->execute($sql,$parameters);
            }
            catch(\PDOException $ex){
                throw $ex;
            }
    
            if(!empty($result))
                return $this->map($result);
            else
                return false;
            
        }

        protected function map($value){

            $value = is_array($value) ? $value : [];

            $resp = array_map(function($p){
                return new Ticket($p['id_ticket'],$p['ticket_number'],$p['id_movieshow'],$p['id_purchase']);
            }, $value);


            return count($resp) > 1 ? $resp : $resp['0'];
        }

    }
?>