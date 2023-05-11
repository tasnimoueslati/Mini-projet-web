<?php
//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Etudiant.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate blog  etudiant object

$etudiant = new Etudiant($db);
//Get raw posted data 
$data = json_decode(file_get_contents("php://input"));
//set ID to update

$etudiant->id_etudiant = $data->id_etudiant;
$etudiant->Nom = $data->Nom;
$etudiant->Prenom = $data->Prenom;
$etudiant->CIN = $data->CIN;
$etudiant->Date_naissance = $data->Date_naissance;
$etudiant->Email = $data->Email;
$etudiant->Genre = $data->Genre;
//update etudiant 
if($etudiant->update()){
echo json_encode(array ('message' =>'etudiant updated'));

}else {
    echo json_encode(array('message'=>'etudiant not updated' ));
}


?>