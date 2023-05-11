<?php
//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Formation.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate  formateur object

$formation = new Formation($db);
//Get raw posted data 
$data = json_decode(file_get_contents("php://input"));
//set ID to DELETE

$formation->id_Formation = $data->id_Formation;

//DELETE etudiant 
if($formation->delete()){
echo json_encode(array ('message' =>'formation deleted'));

}else {
    echo json_encode(array('message'=>'formation not deleted' ));
}


?>