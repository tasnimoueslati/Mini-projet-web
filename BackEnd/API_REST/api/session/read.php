<?php
//HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Session.php';

// Instantiate DB & connect 
$database = new Database();
$db=$database->connect();
// Instantiate blog  formateur object

$session = new Session($db);
//blog post query
$result= $session->read();
//Get row count
$num = $result->rowCount();
//check if any formateurs
if($num >0){
    $session_arr=array();
    $session_arr['data']=array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $session_item  =array(
            'id_session'=>$id_session ,
            'Date_debut'=>$Date_debut ,
            'Date_fin' =>$Date_fin ,
            'Planning_seance' =>$Planning_seance,
            'Formation_id_Formation'=>$Formation_id_Formation
            
        );
        //push to "data"
        array_push($session_arr['data'],$session_item);
       
    }
     //Turn to JSON & output 
     echo json_encode($session_arr);

}
else{
///no etudiants
echo json_encode(
    array('message'=>'no sessions found')
);
}




?>