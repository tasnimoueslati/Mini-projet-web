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
//GET ID
$formateur->idFormateur=isset($_GET['idFormateur'])?$_GET['idFormateur']: die();
$formateur->read_single();

//create array
$form_arr=array('idFormateur'=>$formateur->idFormateur,
'Nom'=>$formateur->Nom,
'Prenom'=>$formateur->Prenom,
'Email'=>$formateur->Email,
'CIN'=>$formateur->CIN,
'Genre'=>$formateur->Genre,
'specialite'=>$formateur->specialite,

 );
 print_r(json_encode($form_arr));
?>