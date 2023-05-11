<?php
class Formateur {
    private $conn;
    private $table='formateur';
    
    // formateur properties 
    public $idFormateur ;
    public $Nom ;
    public $Prenom ;
    public $CIN ;
    public $Date_naissance ;
    public $Email ;
    public $Genre ;
    public $specialite;
    // constructor with DB
    public function __construct($db){
        $this->conn=$db;


    }    
    //get formateur ;
    public function read(){
        //CREATE QUERY
        $query ='SELECT idFormateur , Nom  , Prenom  , Date_naissance , Email , Genre, specialite , CIN from  ' .$this->table ;

        //prepare satement
        $stmt=$this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;

    }
    public function read_single(){
        $query ='SELECT idFormateur , Nom  , Prenom , Date_naissance , Email ,Genre, specialite ,CIN from  ' .$this->table . ' WHERE idFormateur= ? LIMIT 0,1';
//prepare statement
$stmt=$this->conn->prepare($query);
//Bind ID
$stmt->bindParam(1, $this->idFormateur);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$this->Nom=$row['Nom'];
$this->Prenom=$row['Prenom'];
$this->Email=$row['Email'];
$this->CIN=$row['CIN'];
$this->Date_naissance=$row['Date_naissance'];
$this->Genre=$row['Genre'];
$this->Genre=$row['specialite'];




    }
     //Create formateur
     public function create(){
        //create query
        $query ='INSERT INTO ' . $this->table . '
        SET 
        
        Nom = :Nom,
        Prenom = :Prenom,
        Date_naissance = :Date_naissance, 
        Email = :Email,
        specialite= :specialite,
        Genre = :Genre,
        CIN = :CIN'
        
       
        ;
        //prepare statement 
        $stmt = $this->conn->prepare($query);
        //clean sata 
        //$this->idFormateur=htmlspecialchars(strip_tags($this->idFormateur));
        $this->Nom=htmlspecialchars(strip_tags($this->Nom));
        $this->Prenom=htmlspecialchars(strip_tags($this->Prenom));
        $this->CIN=htmlspecialchars(strip_tags($this->CIN));
        $this->Date_naissance=htmlspecialchars(strip_tags($this->Date_naissance)); 
        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->Genre=htmlspecialchars(strip_tags($this->Genre));
        $this->specialite=htmlspecialchars(strip_tags($this->specialite));
        //Bind data
        //$stmt->bindParam(':idFormateur',$this->idFormateur);
        $stmt->bindParam(':Nom',$this->Nom);
        $stmt->bindParam(':Prenom',$this->Prenom);
        $stmt->bindParam(':CIN',$this->CIN);
        $stmt->bindParam(':Date_naissance',$this->Date_naissance);
        $stmt->bindParam(':Email',$this->Email);
        $stmt->bindParam(':Genre',$this->Genre);
        $stmt->bindParam(':specialite',$this->specialite);
        //execute query
        if($stmt->execute()){
            return true;
        }
        //print error if something goes wrong
         printf("ERROR :%s.\n",$stmt->error);
        
        return false ;


    }
    public function update(){
        //create query
        $query ='UPDATE ' . $this->table . '
         SET 
       
        Nom = :Nom,
        Prenom = :Prenom,
        Date_naissance = :Date_naissance, 
        Email = :Email,
        specialite= :specialite,
        Genre = :Genre,
        CIN = :CIN
        
         WHERE idFormateur= :idFormateur' ;
        //prepare statement 
        $stmt = $this->conn->prepare($query);
        //clean sata 
        $this->idFormateur=htmlspecialchars(strip_tags($this->idFormateur));
        $this->Nom=htmlspecialchars(strip_tags($this->Nom));
        $this->Prenom=htmlspecialchars(strip_tags($this->Prenom));
        $this->CIN=htmlspecialchars(strip_tags($this->CIN));
        $this->Date_naissance=htmlspecialchars(strip_tags($this->Date_naissance)); 
        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->Genre=htmlspecialchars(strip_tags($this->Genre));
        $this->specialite=htmlspecialchars(strip_tags($this->Genre));

        //Bind data
        $stmt->bindParam(':idFormateur',$this->idFormateur);
        $stmt->bindParam(':Nom',$this->Nom);
        $stmt->bindParam(':Prenom',$this->Prenom);
        $stmt->bindParam(':CIN',$this->CIN);
        $stmt->bindParam(':Date_naissance',$this->Date_naissance);
        $stmt->bindParam(':Email',$this->Email);
        $stmt->bindParam(':Genre',$this->Genre);
        $stmt->bindParam(':specialite',$this->specialite);

        //execute query
        if($stmt->execute()){
            return true;
        }
        //print error if something goes wrong
         printf("ERROR :%s.\n",$stmt->error);
        
        return false ;


    }
    public function delete(){
        //create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE idFormateur =:idFormateur';
        //prepare statement 
        $stmt = $this->conn->prepare($query);
        //clean data 
        $this->idFormateur=htmlspecialchars(strip_tags($this->idFormateur));
        //bind data
        $stmt->bindParam(':idFormateur',$this->idFormateur);
        if($stmt->execute()){
            return true;
        }
        //print error if something goes wrong
         printf("ERROR :%s.\n",$stmt->error);
        
        return false ;
    }
}
?>