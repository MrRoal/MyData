<?php
$ch = curl_init();
/*curl_setopt($ch, CURLOPT_URL, "http://192.168.1.170/api/happyhour/webservices/avibilitycrone");*/
curl_setopt($ch, CURLOPT_URL, "http://happyhour.coderspreview.com/webservices/avibilitycrone");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, true);
$data = curl_exec($ch);
?>