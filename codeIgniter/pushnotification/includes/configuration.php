<?php
if(strpos($_SERVER["HTTP_HOST"],"localhost") >= 0 || strpos($_SERVER["HTTP_HOST"],"192.168.1") >= 0)
{
	$tconfig["tsite_folder"] = "/pushnotification";
	$tconfig["tsite_folder1"] = "/pushnotification";
}	
else
{
	$tconfig["tsite_folder"]  = "/pushnotification";
	$tconfig["tsite_folder1"] = "/pushnotification";
}
//echo $tconfig["tsite_folder"];exit;
$tconfig["tsite_admin"] = "admin";
$tconfig["tsite_url"] = "http://".$_SERVER["HTTP_HOST"].$tconfig["tsite_folder"];

$site_path	= $_SERVER["DOCUMENT_ROOT"].$tconfig["tsite_folder"];
$site_url = $tconfig["tsite_url"];


$tconfig["tpanel_url"] = "http://".$_SERVER["HTTP_HOST"]."/".$tconfig["tsite_folder"]."/".$tconfig["tsite_admin"];

$admin_url = $tconfig["tpanel_url"];
$admin_path=$_SERVER["DOCUMENT_ROOT"].$tconfig["tsite_folder"]."/".$tconfig["tsite_admin"];

define('PUSHURL', $tconfig["tsite_url"].'/pushnotify/');
define('ANDROID_PUSHURL', $tconfig["tsite_url"].'/pushnotify_Android/');

//p($_REQUEST);exit;
if(!empty($_REQUEST['project'])){
	$projectName = $_REQUEST['project'];	
}

/*if(!empty($_REQUEST['googleApiKey'])){
	$googleApiKey = $_REQUEST['googleApiKey'];
}*/

$con=mysqli_connect("localhost","root","root","happyhour");
$result = mysqli_query($con,"SELECT c.CertificateId,c.AppId,a.AppId,a.vProjectName,a.tGoogleApi FROM apps a LEFT JOIN certificates c ON c.AppId = a.AppId WHERE a.vProjectName = '".$projectName."'");
$row = mysqli_fetch_array($result);

define('APPID', $row['AppId']);
define('CERTID', $row['CertificateId']);
$googleApiKey = $row['tGoogleApi'];

//echo $googleApiKey;exit;

//define('APPID', '1');
//define('CERTID', '1');


//defined( '_TEXEC' ) or die( 'Restricted access' );
//echo $tconfig["tsite_folder1"];exit;
$parts = explode( DS, TPATH_BASE );
define( 'TPATH_ROOT',			$tconfig["tsite_folder1"] );

define( 'TPATH_ADMINISTRATOR', 	TPATH_ROOT.DS.'admin' );
define( 'TPATH_LIBRARIES', 		TPATH_ROOT.DS.'libraries' );
define( 'TPATH_CLASS_DATABASE', TPATH_ROOT.DS.'libraries'.DS.'database/' );
define( 'TPATH_CLASS_GEN', 		TPATH_ROOT.DS.'libraries'.DS.'general/' );

$imagemagickinstalldir='/usr/local/bin';
$useimagemagick = "Yes";


if(strpos($_SERVER["HTTP_HOST"],"localhost") >= 0 || strpos($_SERVER["HTTP_HOST"],"192.168.1") >= 0)
{

	define( 'TSITE_SERVER','localhost');
	define( 'TSITE_DB','happyhour');
	define( 'TSITE_USERNAME','root');
	define( 'TSITE_PASS','root');
	
	/**
	* Database config variables
	*/
	define("DB_HOST", "localhost");
	define("DB_DATABASE", "happyhour");
	define("DB_USER", "root");
	define("DB_PASSWORD", "root");
	
	/*
	* Google API Key
	*/
	define("GOOGLE_API_KEY", $googleApiKey); // PUSH TEST

}
else
{
	define( 'TSITE_SERVER','localhost');
	define( 'TSITE_DB','happyhour');
	define( 'TSITE_USERNAME','root');
	define( 'TSITE_PASS','root');
	/**
	* Database config variables
	*/
	define("DB_HOST", "localhost");
	define("DB_DATABASE", "happyhour");
	define("DB_USER", "root");
	define("DB_PASSWORD", "root");
	
	/*
	* Google API Key
	*/
	define("GOOGLE_API_KEY", $googleApiKey);
}

//Certificate folder
$certificateFolder = 'certificates';


//Push and Feedback servers
//These urls are stored in mySQL in the CertificateTypes table.

//Date settings. Apple uses UTC dates for Feedback info
date_default_timezone_set('UTC');

function p($var){
	echo "<pre>";
	print_r($var);
	echo "<hr>";
}
?>
