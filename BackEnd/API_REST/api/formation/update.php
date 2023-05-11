
<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once '../../config/Database.php';
include_once '../../models/Formation.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate blog  etudiant object

$formation = new Formation($db);
//Get raw posted data 
$data = json_decode(file_get_contents("php://input"));
//set ID to update

$formation->id_Formation = $data->id_Formation;
$formation->Titre = $data->Titre;
$formation->Descriptions = $data->Descriptions;
$formation->Programme = $data->Programme;
$formation->Formateur_idFormateur = $data->Formateur_idFormateur;


//update formation 
if($formation->update()){
echo json_encode(array ('message' =>'formation updated'));

}else {
    echo json_encode(array('message'=>'formation not updated' ));
}



?>