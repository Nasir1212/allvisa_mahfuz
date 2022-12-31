<?php 
// Include CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Content-Type: application/json');
header("HTTP/1.1 200 OK");
include_once(__DIR__."/Controller.php");
include_once(__DIR__."/Covid_info_controller.php");

$obj_cont = new Controller();
$obj_Covid_info = new Covid_info_controller();
if(isset($_GET['page__id'])){
	$page_id = base64_decode($_GET['page__id']);

$fetch_data =  $obj_cont->Read_page($page_id);

$log_json_data = array();

    while($row = $fetch_data ->fetch(PDO::FETCH_ASSOC)){	
        array_push($log_json_data,$row);
    }
    echo json_encode($log_json_data);

}



if(isset($_GET['covid_info_id'])){
	$covid_id = base64_decode($_GET['covid_info_id']);

$fetch_data =  $obj_Covid_info->get_by_id($covid_id);

$log_json_data = array();

    while($row = $fetch_data ->fetch(PDO::FETCH_ASSOC)){	
        array_push($log_json_data,$row);



    }
    echo json_encode($log_json_data);
}


?>