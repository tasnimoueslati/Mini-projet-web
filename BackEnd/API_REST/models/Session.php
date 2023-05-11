<?php
class Session {
    private $conn;
    private $table='session';
    
    // formateur properties 
    public $id_session ;
    public  $Date_debut ;
    public  $Date_fin ;
    public $Planning_seance ;
    public $Formation_id_Formation ;
   
    // constructor with DB
    public function __construct($db){
        $this->conn=$db;


    }    
    //get formateur ;
    public function read(){
        //CREATE QUERY
        $query ='SELECT id_session , Date_debut  , Date_fin , Planning_seance , Formation_id_Formation  FROM  ' .$this->table ;

        //prepare satement
        $stmt=$this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;

    }

    public function read_single(){
        $query ='SELECT id_session , Date_debut  , Date_fin , Planning_seance , Formation_id_Formation   from  ' .$this->table . ' WHERE id_session= ? LIMIT 0,1';
//prepare statement
$stmt=$this->conn->prepare($query);
//Bind ID
$stmt->bindParam(1, $this->id_session);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$this->id_session=$row['id_session'];
$this->Date_debut=$row['Date_debut'];
$this->Date_fin=$row['Date_fin'];
$this->Planning_seance=$row['Planning_seance'];
$this->Formation_id_Formation=$row['Formation_id_Formation'];





    }

    public function update(){
        //create query
        $query ='UPDATE ' . $this->table . '
         SET 
       
        
        Date_debut = :Date_debut,
        Date_fin = :Date_fin, 
        Planning_seance= :Planning_seance,
        Formation_id_Formation= :Formation_id_Formation
       
        
         WHERE id_session= :id_session' ;
        //prepare statement 
        $stmt = $this->conn->prepare($query);
        //clean sata 
        $this->id_session=htmlspecialchars(strip_tags($this->id_session));
        $this->Date_debut=htmlspecialchars(strip_tags($this->Date_debut));
        $this->Date_fin=htmlspecialchars(strip_tags($this->Date_fin));
        $this->Planning_seance=htmlspecialchars(strip_tags($this->Planning_seance));
        $this->Formation_id_Formation=htmlspecialchars(strip_tags($this->Formation_id_Formation)); 
        

        //Bind data
        $stmt->bindParam(':id_session',$this->id_session);
        $stmt->bindParam(':Date_debut',$this->Date_debut);
        $stmt->bindParam(':Date_fin',$this->Date_fin);
        $stmt->bindParam(':Planning_seance',$this->Planning_seance);
        $stmt->bindParam(':Formation_id_Formation',$this->Formation_id_Formation);
        

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE id_session =:id_session';
        //prepare statement 
        $stmt = $this->conn->prepare($query);
        //clean data 
        $this->id_session=htmlspecialchars(strip_tags($this->id_session));
        //bind data
        $stmt->bindParam(':id_session',$this->id_session);
        if($stmt->execute()){
            return true;
        }
        //print error if something goes wrong
         printf("ERROR :%s.\n",$stmt->error);
        
        return false ;
    }

    public function create(){
        //create query
        $query ='INSERT INTO ' . $this->table . '
         SET 
       
        Date_debut = :Date_debut,
        Date_fin = :Date_fin,
        Planning_seance = :Planning_seance, 
        Formation_id_Formation = :Formation_id_Formation'
       
        ;
        //prepare statement 
        $stmt = $this->conn->prepare($query);
        //clean sata 
        //$this->id_Formation=htmlspecialchars(strip_tags($this->id_Formation));
        $this->Date_debut=htmlspecialchars(strip_tags($this->Date_debut));
        $this->Date_fin=htmlspecialchars(strip_tags($this->Date_fin));
        $this->Planning_seance=htmlspecialchars(strip_tags($this->Planning_seance));
       
        $this->Formation_id_Formation =htmlspecialchars(strip_tags($this->Formation_id_Formation));
      
        //Bind data
       // $stmt->bindParam(':id_Formation',$this->id_Formation);
        $stmt->bindParam(':Date_debut',$this->Date_debut);
        $stmt->bindParam(':Date_fin',$this->Date_fin);
        $stmt->bindParam(':Planning_seance',$this->Planning_seance);
        $stmt->bindParam(':Formation_id_Formation',$this->Formation_id_Formation);
       
        //execute query
        if($stmt->execute()){
            return true;
        }
        //print error if something goes wrong
         printf("ERROR :%s.\n",$stmt->error);
        
        return false ;


    }


}