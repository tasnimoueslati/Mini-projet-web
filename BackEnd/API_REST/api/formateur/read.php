<?php
//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Formateur.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate blog  formateur object

$formateur = new Formateur($db);
//blog post query
$result= $formateur->read();
//Get row count
$num = $result->rowCount();
//check if any formateurs
if($num >0){
    $formateurs_arr=array();
    $formateurs_arr['data']=array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $form_item  =array(
            'idFormateur'=>$idFormateur ,
            'Nom'=>$Nom ,
            'Prenom' =>$Prenom ,
            
            'Date_naissance'=>$Date_naissance, 
            'Email'=>$Email ,
            
            'specialite'=>$specialite,
            'Genre' =>$Genre ,
            'CIN' =>$CIN 
        );
        //push to "data"
        array_push($formateurs_arr['data'],$form_item);
       
    }
     //Turn to JSON & output 
     echo json_encode($formateurs_arr);

}
else{
///no etudiants
echo json_encode(
    array('message'=>'no formateurs found')
);
}




?>