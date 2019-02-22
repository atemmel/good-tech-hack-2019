<?php
   
    class DBconnect{
        protected $connect;

        function __construct(){

        }

        public function connect(){
            try{
                include('GOD.php');
                $this->connect = new PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
                $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                return $this->connect;
            }catch(PDOException $e){
                echo 'Database Error: ' . $e->getMessage();
                
            }
        }
    }
?>