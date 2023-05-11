<?php
//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Formateur.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate  formateur object

$formateur = new Formateur($db);
//Get raw posted data 
$data = json_decode(file_get_contents("php://input"));
//set ID to DELETE

$formateur->idFormateur = $data->idFormateur;

//DELETE etudiant 
if($formateur->delete()){
echo json_encode(array ('message' =>'formateur deleted'));

}else {
    echo json_encode(array('message'=>'formateur not deleted' ));
}


?>