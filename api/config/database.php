<?php
 class Database {

    private $username="chungsql";
    private $password="chung";
    private $db_name="hospital_db";
    private $host="localhost";
    private $conx;
    private $cdn = "mysql:dbname=hospital_db;host=127.0.0.1";

    public function getConnection() {

        try {
        $this->conx=new PDO($this->cdn,$this->username,$this->password);
        
        }catch(PDOException $e) {
            echo "Connection error" . $e->getMessage();

        }
        return $this->conx;
    }
 }



?>