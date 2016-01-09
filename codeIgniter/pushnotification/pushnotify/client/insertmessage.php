<?php
# -*- coding: utf-8 -*-
##
##     Copyright (c) 2010 Benjamin Ortuzar Seconde <bortuzar@gmail.com>
##
##     This file is part of APNS.
##
##     APNS is free software: you can redistribute it and/or modify
##     it under the terms of the GNU Lesser General Public License as
##     published by the Free Software Foundation, either version 3 of
##     the License, or (at your option) any later version.
##
##     APNS is distributed in the hope that it will be useful,
##     but WITHOUT ANY WARRANTY; without even the implied warranty of
##     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
##     GNU General Public License for more details.
##
##     You should have received a copy of the GNU General Public License
##     along with APNS.  If not, see <http://www.gnu.org/licenses/>.
##
##
## $Id: subscriptionForm.php 168 2010-08-28 01:24:04Z Benjamin Ortuzar Seconde $
##

require_once("../config.php");

require_once('../classes/MessageStatus.php');
require_once("../classes/DataServiceMysql.php");
require_once('../classes/Apns.php');


	
    //echo "<br/>Started submitting messages to the queue";

	$certificate = DataService::singleton()->getCertificates($_REQUEST['certificateId']);
	
	/*echo ' Certificate: <pre>';
	print_r($certificate);*/
	$DeviceId  = DataService::singleton()->isDeviceRegistered($_REQUEST['deviceToken']);
	/*echo 'Device token: <pre>';
	print_r($DeviceId);*/
	$messagesArray = DataService::singleton()->getMessages($_REQUEST['certificateId'], MessageStatus::UNPROCESSED, 1000, $_REQUEST['deviceToken']);
	/*echo '<pre>';
	print_r($messagesArray);exit;*/
	if(count($messagesArray) > 0){
	    echo "Alredy in Quee";exit;
	}else{
	    if($DeviceId != ''){
				DataService::singleton()->addMessage($_REQUEST['certificateId'], $DeviceId, addslashes($_REQUEST['message']),'+2','push.wav');
				echo "Success";exit;
	    }    
	}
	
	echo "Fail";exit;

?>