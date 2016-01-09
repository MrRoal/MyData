<?php
//echo '<pre>';print_r($_GET);exit;
if (isset($_GET["regId"]) && isset($_GET["message"])) {

    $regId = $_GET["regId"];
    $message = $_GET["message"];
 
    include_once 'GCM.php';
    
    $gcm = new GCM();
 	
    $gKey = $_GET["google_api_key"];
    $registatoin_ids = array($regId);
    $message = array("message" => $message,"msgcnt"=>1);

    $result = $gcm->send_notification($registatoin_ids, $message,$gKey);
 
    echo $result;
}
?>