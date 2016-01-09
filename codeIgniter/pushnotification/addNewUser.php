<?php

$myFile = "testFile.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = '';
foreach($_REQUEST as $key=>$var){
$stringData.= $key."==>".$var."\n"; 
}
fwrite($fh, $stringData);
fclose($fh);

define('_TEXEC', 1 );
define('TPATH_BASE', dirname(dirname(dirname(__FILE__)) ));

define('DS', DIRECTORY_SEPARATOR );



 

include_once("includes/configuration.php");

include_once("includes/defines.php");


//http://localhost/TAGDAPP/insert_tag.php?iUserId=17&iTagId=19&vLatitude=16&vLongitude=47

$vDeviceid = $_REQUEST['vDeviceid'];
$vDevicename = $_REQUEST['vDevicename'];
$devicetoken = $_REQUEST['deviceToken'];
$vType = $_REQUEST['vType'];
$devicetoken = str_replace("<","",$devicetoken);
$devicetoken = str_replace(">","",$devicetoken);
$devicetoken = str_replace(" ","",$devicetoken);

$sql="select * from user where vDeviceid='".$vDeviceid."'";  
$db_res = $obj->MySQLSelect($sql);

$data['vDeviceid']=$vDeviceid;
$data['vDevicename']=$vDevicename;
$data['vToken']=$devicetoken;
$data['vType']=$vType;

if($vDeviceid == $db_res[0]['vDeviceid']){
    createuser($data,APPID);
    $id = $obj->MySQLQueryPerform("user",$data,'update'," vDeviceid='".$vDeviceid."'");
}else{
    
    $id = $obj->MySQLQueryPerform("user",$data,'insert');
    
    //$id =1;
}

function createuser($push,$appid){
    //    echo $Url;exit;
    // is cURL installed yet?
    //$appid = '1';
    if($push['vType'] != 'Android'){
        $Url = PUSHURL."registerDeviceMysql.php?appId=".$appid."&deviceToken=".$push['vToken']."";
        
        if (!function_exists('curl_init')){
            die('Sorry cURL is not installed!');
        }
     
        // OK cool - then let's create a new cURL resource handle
        $ch = curl_init();
     
        // Now set some options (most are optional)
     
        // Set URL to download
        curl_setopt($ch, CURLOPT_URL, $Url);  
     
        // Set a referer
        curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
     
        // User agent
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
     
        // Include header in result? (0 = yes, 1 = no)
        curl_setopt($ch, CURLOPT_HEADER, 0);
     
        // Should cURL return or print out the data? (true = return, false = print)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     
        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
     
        // Download the given URL, and return output
        $output = curl_exec($ch);
     
        // Close the cURL resource, and free system resources
        curl_close($ch);
    }else{
        $output =1;
    }
 
    return $output;
    
    //$cmd='curl -i -u "i7zSdDfxRy-itsYZ8yet2Q:7FI_ERf3TQyNelFhsxFYsQ" -H "Content-type: application/json" -X PUT --data \''.$json.'\' https://go.urbanairship.com/api/device_tokens/c9d424bb04afe2f04bf78274c052e34cfa32f4185c66d736289260ea243eec9d';
    //exec($cmd,$result);
    //echo "<pre>";
    //print_r($result);exit;
    //return $ret;   
 }

if($id){
    $var_msg = 1;
    $contents = array(); 
                $contents['alias'] = $vDevicename;
                $contents['tags'][0] = $vDevicename;
                $contents['badge'] = 2;
                
                $push = $contents; 
                //$push['device_tokens'][0] = $devicetoken;//'C9D424BB04AFE2F04BF78274C052E34CFA32F4185C66D736289260EA243EEC9D';
                $s =  createuser($data,APPID); 
}else{
    $id = $db_res[0]['iUserId'];
    $var_msg = 0;
}

//$arr = array("iQuestionId"=>$id,"msg"=>$var_msg);
$arr = array();
$arr[0]['iUserId'] = $id;
$arr[0]['msg'] = $var_msg;

header('Content-type: application/json');
echo json_encode($arr);exit;
?>
