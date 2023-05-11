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
//GET ID
$etudiant->id_etudiant=isset($_GET['id_etudiant'])?$_GET['id_etudiant']: die();
$etudiant->read_single();

//create array
$etud_arr=array('id_etudiant'=>$etudiant->id_etudiant,
'Nom'=>$etudiant->Nom,
'Prenom'=>$etudiant->Prenom,
'Email'=>$etudiant->Email,
'CIN'=>$etudiant->CIN,
'Genre'=>$etudiant->Genre
 );
 print_r(json_encode($etud_arr));
?>