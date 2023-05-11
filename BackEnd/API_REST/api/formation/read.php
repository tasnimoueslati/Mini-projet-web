<?php
//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Formation.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate blog  formation object

$formation = new Formation($db);
//blog post query
$result= $formation->read();
//Get row count
$num = $result->rowCount();
//check if any formateurs
if($num >0){
    $formation_arr=array();
    $formation_arr['data']=array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $form_item =array(
            'id_Formation'=>$id_Formation ,
            'Titre'=>$Titre ,
            'Descriptions' =>$Descriptions ,
            'Programme' => $Programme, 
            'Formateur_idFormateur'=>$Formateur_idFormateur
            
        );
        //push to "data"
        array_push($formation_arr['data'],$form_item);
       
      
    }
     //Turn to JSON & output 
    echo json_encode($formation_arr);

}
else{
///no etudiants
echo json_encode(
    array('message'=>'no formations found')
);
}




?>