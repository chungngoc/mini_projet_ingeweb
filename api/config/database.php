<?php
 class Database {

    private $username="chungsql";
    private $password="chung";
    private $db_name="hospital_db";
    private $host="localhost";
    private $conx;

    public function getConnection() {

        try {
        $this->conx=new PDO("mysql:host=" . $this->host .";dbname=" . $this->db_name,$this->username,$this->password);
        
        }catch(PDOException $e) {
            echo "Connection error" . $e->getMessage();

        }
        return $this->conx;
    }
 }



?>