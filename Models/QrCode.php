<?php
    namespace Models;

    class QrCode 
    {
        // URL DE GOOGLE CHART API 
        private $apiUrl = 'http://chart.apis.google.com/chart'; 
        // DATOS PARA CREAR CÓDIGO QR 
        private $data; 

        public function getApiUrl()
        {
                return $this->apiUrl;
        }

        /**
         * Set the value of apiUrl
         *
         * @return  self
         */ 
        public function setApiUrl($apiUrl)
        {
                $this->apiUrl = $apiUrl;

                return $this;
        }

        /**
         * Get the value of data
         */ 
        public function getData()
        {
                return $this->data;
        }

        /**
         * Set the value of data
         *
         * @return  self
         */ 
        public function setData($data)
        {
                $this->data = $data;

                return $this;
        }

        // Función que se utiliza para generar el tipo TEXTO de código QR. 
        public function text($text)
        {
            $this->data = $text; 
        }

        // Función que se utiliza para guardar el archivo de imagen qrcode. 
        public function Create ($size = 400, $filename = null){
            $ch = curl_init (); 
            curl_setopt ($ch, CURLOPT_URL, QR_API); 
            curl_setopt ($ch, CURLOPT_POST, true); 
            curl_setopt ($ch, CURLOPT_POSTFIELDS, "chs = {$size} x {$size} & cht = qr & chl =". urlencode ($this->data)); 
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt ($ch, CURLOPT_HEADER, false);
            curl_setopt ($ch, CURLOPT_TIMEOUT, 30); 
            $img = curl_exec ($ch); 
            curl_close ($ch); 
            
            if($img){
                if($filename){
                    if(!preg_match("# \. png $ # i", $filename)){
                        $filename = ".png";
                        $filename = IMG_PATH. $filename; 
                    }return file_put_contents($filename, $img); 
                }
                else{
                    var_dump($img); 
                    return true; 
                } 
            } return false; 
        }
    }

?>