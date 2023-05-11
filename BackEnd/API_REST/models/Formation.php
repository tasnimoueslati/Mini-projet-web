<?php
class Formation {
    private $conn;
    private $table='formation';
    
    // formateur properties 
    public $id_Formation ;
    public  $Titre ;
    public  $Descriptions ;
    public $Programme ;
    public $Formateur_idFormateur ;
   
    // constructor with DB
    public function __construct($db){
        $this->conn=$db;


    }    
    //get formateur ;
    public function read(){
        //CREATE QUERY
        $query ='SELECT id_Formation , Titre  , Descriptions , Programme , Formateur_idFormateur  FROM  ' .$this->table ;

        //prepare satement
        $stmt=$this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;

    }
    public function read_single(){
        $query ='SELECT id_Formation , Titre  , Descriptions , Programme , Formateur_idFormateur   from  ' .$this->table . ' WHERE id_Formation= ? LIMIT 0,1';
//prepare statement
$stmt=$this->conn->prepare($query);
//Bind ID
$stmt->bindParam(1, $this->id_Formation);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$this->id_Formation=$row['id_Formation'];
$this->Titre=$row['Titre'];
$this->Descriptions=$row['Descriptions'];
$this->Programme=$row['Programme'];
$this->Formateur_idFormateur=$row['Formateur_idFormateur'];





    }

   
    
    public function create(){
        //create query
        $query ='INSERT INTO ' . $this->table . '
         SET 
       
        Titre = :Titre,
        Descriptions = :Descriptions,
        Programme = :Programme, 
        Formateur_idFormateur = :Formateur_idFormateur'
       
        ;
        //prepare statement 
        $stmt = $this->conn->prepare($query);
        //clean sata 
        //$this->id_Formation=htmlspecialchars(strip_tags($this->id_Formation));
        $this->Titre=htmlspecialchars(strip_tags($this->Titre));
        $this->Descriptions=htmlspecialchars(strip_tags($this->Descriptions));
        $this->Programme=htmlspecialchars(strip_tags($this->Programme));
        $this->Formateur_idFormateur=htmlspecialchars(strip_tags($this->Formateur_idFormateur));
      
        //Bind data
       // $stmt->bindParam(':id_Formation',$this->id_Formation);
        $stmt->bindParam(':Titre',$this->Titre);
        $stmt->bindParam(':Descriptions',$this->Descriptions);
        $stmt->bindParam(':Programme',$this->Programme);
        $stmt->bindParam(':Formateur_idFormateur',$this->Formateur_idFormateur);
       
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
       
        
        Titre = :Titre,
        Descriptions = :Descriptions, 
        Programme= :Programme,
        Formateur_idFormateur= :Formateur_idFormateur
       
        
         WHERE id_Formation= :id_Formation' ;
        //prepare statement 
        $stmt = $this->conn->prepare($query);
        //clean sata 
        $this->id_Formation=htmlspecialchars(strip_tags($this->id_Formation));
        $this->Titre=htmlspecialchars(strip_tags($this->Titre));
        $this->Descriptions=htmlspecialchars(strip_tags($this->Descriptions));
        $this->Programme=htmlspecialchars(strip_tags($this->Programme));
        $this->Formateur_idFormateur=htmlspecialchars(strip_tags($this->Formateur_idFormateur)); 
        

        //Bind data
        $stmt->bindParam(':id_Formation',$this->id_Formation);
        $stmt->bindParam(':Titre',$this->Titre);
        $stmt->bindParam(':Descriptions',$this->Descriptions);
        $stmt->bindParam(':Programme',$this->Programme);
        $stmt->bindParam(':Formateur_idFormateur',$this->Formateur_idFormateur);
        

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE id_Formation =:id_Formation';
        //prepare statement 
        $stmt = $this->conn->prepare($query);
        //clean data 
        $this->id_Formation=htmlspecialchars(strip_tags($this->id_Formation));
        //bind data
        $stmt->bindParam(':id_Formation',$this->id_Formation);
        if($stmt->execute()){
            return true;
        }
        //print error if something goes wrong
         printf("ERROR :%s.\n",$stmt->error);
        
        return false ;
    }

}
    ?>