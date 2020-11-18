<?php
    namespace DAO;

    use Models\Purchase as Purchase;

    class PurchaseDAO
    {
        public function Add($purchase){
         
            $sql = 'INSERT INTO purchases 
            (id_user, date, total, discount, subtotal) 
            VALUES 
            (:id_user, :date, :total, :discount, :subtotal)';            
            
            $parameters['id_user'] = $purchase->getAccount();
            $parameters['date'] = $purchase->getDate();
            $parameters['total'] = $purchase->getTotal();
            $parameters['discount'] = $purchase->getDiscount();
            $parameters['subtotal'] = $purchase->getSubtotal();
    
            try{
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($sql, $parameters);
            
            }
            catch(\PDOException $ex){
                throw $ex;
            }
        }

                
        public function getLastIdPurchase(){

            $sql = "select purchases.id_purchase as last_id from purchases order by purchases.id_purchase desc limit 1";
    
    
            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->execute($sql);
            }
            catch(\PDOException $ex){
                throw $ex;
            }

            if(!empty($result))
                return $result['0']['last_id'];
            else
                return 0;
            
        }

        
        public function read($id_purchase){

            $sql = "SELECT * FROM purchases WHERE id_purchase = :id_purchase";
    
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


        public function totalByCinema($id_cinema, $dateIn, $dateOut)
        {            
            $sql = 'call '.'sp_totalByCinema(:id_cinema,:dateIn,:dateOut)';
    
            $parameters['id_cinema'] = $id_cinema;
            $parameters['dateIn'] = $dateIn;
            $parameters['dateOut'] = $dateOut;

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

        
        public function totalByMovie($id_movie, $dateIn, $dateOut)
        {            
            $sql = 'call '.'sp_totalByMovie(:id_movie,:dateIn,:dateOut)';
    
            $parameters['id_movie'] = $id_movie;
            $parameters['dateIn'] = $dateIn;
            $parameters['dateOut'] = $dateOut;

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
        
                
        protected function map($value){

            $value = is_array($value) ? $value : [];

            $resp = array_map(function($p){
                return new Purchase($p['id_purchase'],$p['id_user'],$p['date'],$p['discount'], $p['subtotal'], $p['total']);
            }, $value);


            return count($resp) > 1 ? $resp : $resp['0'];
        }

    }

?>