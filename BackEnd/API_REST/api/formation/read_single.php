<?php
//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Formation.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate blog  etudiant object

$formation = new Formation($db);
//GET ID
$formation->id_Formation=isset($_GET['id_Formation'])?$_GET['id_Formation']: die();
$formation->read_single();

//create array
$form_item =array(
    'id_Formation'=>$formation->id_Formation ,
    'Titre'=>$formation->Titre ,
    'Descriptions' =>$formation->Descriptions ,
    'Programme' =>$formation->Programme, 
    'Formateur_idFormateur'=>$formation->Formateur_idFormateur
    
);
 print_r(json_encode($form_item));
?>