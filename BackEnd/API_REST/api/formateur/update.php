<?php
//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Formateur.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate blog  etudiant object

$formateur = new Formateur($db);
//Get raw posted data 
$data = json_decode(file_get_contents("php://input"));
//set ID to update

$formateur->idFormateur = $data->idFormateur;
$formateur->Nom = $data->Nom;
$formateur->Prenom = $data->Prenom;
$formateur->CIN = $data->CIN;
$formateur->Date_naissance = $data->Date_naissance;
$formateur->Email = $data->Email;
$formateur->Genre = $data->Genre;
//update etudiant 
if($formateur->update()){
echo json_encode(array ('message' =>'formateur updated'));

}else {
    echo json_encode(array('message'=>'formateur not updated' ));
}


?>