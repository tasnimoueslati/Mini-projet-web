<?php
//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Etudiant.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate blog  etudiant object

$etudiant = new Etudiant($db);
//blog post query
$result= $etudiant->read();
//Get row count
$num = $result->rowCount();
//check if any posts
if($num >0){
    $etudiants_arr=array();
    $etudiants_arr['data']=array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $etud_item  =array(
            'id'=>$id_etudiant ,
            'nom'=>$Nom ,
            'prenom' =>$Prenom ,
            'CIN' =>$CIN ,
            'Date_naissance'=>$Date_naissance, 
            'Email'=>$Email ,
            'Genre' =>$Genre 
        );
        //push to "data"
        array_push($etudiants_arr['data'],$etud_item);
       
    }
     //Turn to JSON & output 
     echo json_encode($etudiants_arr);

}
else{
///no etudiants
echo json_encode(
    array('message'=>'no etudiants found')
);
}




?>