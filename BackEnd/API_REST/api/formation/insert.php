<?php
//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Formation.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate blog  formateur object

$formation = new Formation($db);
//Get raw posted data 
$data = json_decode(file_get_contents("php://input"));
//$formation->id_Formation = $data->id_Formation;
$formation->Titre = $data->Titre;
$formation->Descriptions = $data->Descriptions;
$formation->Programme = $data->Programme;
$formation->Formateur_idFormateur = $data->Formateur_idFormateur;

//Create formateur 
if($formation->create()){
echo json_encode(array ('message' =>'formation est inseré'));

}else {
    echo json_encode(array('message'=>'formation ne pas inseré' ));
}


?>