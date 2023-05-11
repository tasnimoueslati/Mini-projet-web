<?php

class Database {
    private $host ="localhost";
    private $db_name ="mydb";
    private $username ="user01";
    private $password="user01";
    private $conn ;
    //DB connect 
    public function connect(){
        $this->conn=null;
        try{
          //  $this->conn= new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name , $this->username,$this->password) ;
          $this->conn= new PDO("mysql:host=localhost;dbname=mydb;port=3307;charset=utf8",'user01','user01');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            echo 'Connection error :'.$e->getMessage();
            
        }
        return $this->conn;
    }
}
?>

