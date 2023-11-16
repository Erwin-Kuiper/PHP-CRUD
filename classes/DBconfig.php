<?php
    class DBconfig{
        protected $conn;

        public function connect(){
            try{
                $conn = new PDO("mysql:localhost=db;dbname=blog", 'root', '');
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn = $conn;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
    }
?>