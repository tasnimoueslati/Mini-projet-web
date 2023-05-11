<?php
//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Session.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate  formateur object

$session = new Session($db);
//Get raw posted data 
$data = json_decode(file_get_contents("php://input"));
//set ID to DELETE

$session->id_session = $data->id_session;

//DELETE etudiant 
if($session->delete()){
echo json_encode(array ('message' =>'session deleted'));

}else {
    echo json_encode(array('message'=>'session  not deleted' ));
}
