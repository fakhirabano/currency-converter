<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';

include_once '../models/Converter.php';
  
$database = new Database();

$db = $database->getConnection();

$conversion = new Api\models\Converter($db);

$data = json_decode(file_get_contents("php://input"));
  
if(
    !empty($data->src_currency) &&
    !empty($data->tar_currency) &&
    !empty($data->amount) 
){
  
    $conversion->src_currency = $data->src_currency;
    $conversion->tar_currency = $data->tar_currency;
    $conversion->amount = $data->amount;
    $conversion_result = $conversion->convert();
   

    if($conversion_result){
        
        $insert_status = $conversion->insert($conversion_result);

        if($insert_status === true) {
            http_response_code(201);
    
            echo json_encode(array("message" => $conversion_result));
        }

        else {
            http_response_code(503);
            echo json_encode(array("error" => $insert_status));
        }

    }
  
}
  
else{
  
    http_response_code(400);
  
    echo json_encode(array("message" => "Unable to create conversion. Data is incomplete."));
}

?>