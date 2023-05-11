<?php
//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Session.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate blog  formateur object

$session = new Session($db);
//Get raw posted data 
$data = json_decode(file_get_contents("php://input"));
$session->Date_debut = $data->Date_debut;
//$session->Titre = $data->Titre;
$session->Date_fin = $data->Date_fin;
$session->Planning_seance = $data->Planning_seance;
$session->Formation_id_Formation = $data->Formation_id_Formation;

//Create formateur 
if($session->create()){
echo json_encode(array ('message' =>'session est inseré'));

}else {
    echo json_encode(array('message'=>'session ne pas inseré' ));
}


?>