<?php
class Etudiant {
    private $conn;
    private $table='etudiant';
    
    // etudiant properties 
    public $id_etudiant ;
    public  $Nom ;
    public  $Prenom ;
    public $CIN ;
    public $Date_naissance ;
    public $Email ;
    public $Genre ;
    // constructor with DB
    public function __construct($db){
        $this->conn=$db;


    }    
    //get etudiants ;
    public function read(){
        //CREATE QUERY
        $query ='SELECT id_etudiant , Nom  , Prenom , CIN , Date_naissance , Email ,Genre from  ' .$this->table ;

        //prepare satement
        $stmt=$this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;

    }
    //Get Single etudiant
    public function read_single(){
        $query ='SELECT id_etudiant , Nom  , Prenom , CIN , Date_naissance , Email ,Genre from  ' .$this->table . ' WHERE id_etudiant= ? LIMIT 0,1';
//prepare statement
$stmt=$this->conn->prepare($query);
//Bind ID
$stmt->bindParam(1, $this->id_etudiant);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$this->Nom=$row['Nom'];
$this->Prenom=$row['Prenom'];
$this->Email=$row['Email'];
$this->CIN=$row['CIN'];
$this->Date_naissance=$row['Date_naissance'];
$this->Genre=$row['Genre'];




    }
    //Create etudiant
    public function create(){
        //create query
        $query ='INSERT INTO ' . $this->table . '
        SET 
       
        Nom = :Nom,
        Prenom = :Prenom, 
        CIN = :CIN,
        Date_naissance = :Date_naissance,
        Email = :Email,
        Genre = :Genre';
        //prepare statement 
        $stmt = $this->conn->prepare($query);
        //clean sata 
       // $this->id_etudiant=htmlspecialchars(strip_tags($this->id_etudiant));
        $this->Nom=htmlspecialchars(strip_tags($this->Nom));
        $this->Prenom=htmlspecialchars(strip_tags($this->Prenom));
        $this->CIN=htmlspecialchars(strip_tags($this->CIN));
        $this->Date_naissance=htmlspecialchars(strip_tags($this->Date_naissance)); 
        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->Genre=htmlspecialchars(strip_tags($this->Genre));
        //Bind data
        //$stmt->bindParam(':id_etudiant',$this->id_etudiant);
        $stmt->bindParam(':Nom',$this->Nom);
        $stmt->bindParam(':Prenom',$this->Prenom);
        $stmt->bindParam(':CIN',$this->CIN);
        $stmt->bindParam(':Date_naissance',$this->Date_naissance);
        $stmt->bindParam(':Email',$this->Email);
        $stmt->bindParam(':Genre',$this->Genre);
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
        CIN = :CIN,
        Date_naissance = :Date_naissance,
        Email = :Email,
        Genre = :Genre
        WHERE
          id_etudiant= :id_etudiant' ;
        //prepare statement 
        $stmt = $this->conn->prepare($query);
        //clean sata 
        $this->id_etudiant=htmlspecialchars(strip_tags($this->id_etudiant));
        $this->Nom=htmlspecialchars(strip_tags($this->Nom));
        $this->Prenom=htmlspecialchars(strip_tags($this->Prenom));
        $this->CIN=htmlspecialchars(strip_tags($this->CIN));
        $this->Date_naissance=htmlspecialchars(strip_tags($this->Date_naissance)); 
        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->Genre=htmlspecialchars(strip_tags($this->Genre));
        //Bind data
        $stmt->bindParam(':id_etudiant',$this->id_etudiant);
        $stmt->bindParam(':Nom',$this->Nom);
        $stmt->bindParam(':Prenom',$this->Prenom);
        $stmt->bindParam(':CIN',$this->CIN);
        $stmt->bindParam(':Date_naissance',$this->Date_naissance);
        $stmt->bindParam(':Email',$this->Email);
        $stmt->bindParam(':Genre',$this->Genre);
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
        $query = 'DELETE FROM ' . $this->table . ' WHERE id_etudiant =:id_etudiant';
        //prepare statement 
        $stmt = $this->conn->prepare($query);
        //clean data 
        $this->id_etudiant=htmlspecialchars(strip_tags($this->id_etudiant));
        //bind data
        $stmt->bindParam(':id_etudiant',$this->id_etudiant);
        if($stmt->execute()){
            return true;
        }
        //print error if something goes wrong
         printf("ERROR :%s.\n",$stmt->error);
        
        return false ;
    }

}
?>