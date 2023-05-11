<?php
//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Session.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate blog  etudiant object

$session = new Session($db);
//GET ID
$session->id_session=isset($_GET['id_session'])?$_GET['id_session']: die();
$session->read_single();

//create array
$session_item =array(
    'id_session'=>$session->id_session ,
    'Date_debut'=>$session->Date_debut ,
    'Date_fin' =>$session->Date_fin ,
    
    'Planning_seance'=>$session->Planning_seance ,
    'Formation_id_formation'=>$session->Formation_id_Formation 
    
);
 print_r(json_encode($session_item));
?>