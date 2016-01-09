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
## $Id: DataService.php 168 2010-08-28 01:24:04Z Benjamin Ortuzar Seconde $
##

class DataService
{
    //database connection handler
    protected $dbh;
    
    // Hold an instance of the class
    private static $instance;

    function __construct(){

         //database connection details
        $dbHost = DBHOST;
        $dbName = DBNAME;
        $dbUser = DBUSERNAME;
        $dbPass = DBPASSWORD;
        //echo $dbHost, $dbName, $dbUser,$dbPass;exit;
        $this->dbh=	new DBConnection($dbHost, $dbName, $dbUser,$dbPass);
    }

    // The singleton method
    public static function singleton() {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }

        return self::$instance;
    }

    // Prevent users to clone the singleton instance
    public function __clone() {
        trigger_error('\nClone is not allowed.', E_USER_ERROR);
    }

    /**
     * Gets an array of apps
     * 
     * @return <array>
     */
    public function getApps() {

        $sql = "SELECT AppId, AppName FROM Apps";
        
        $arr = $this->dbh->sql_query($sql);
        
        $appsArray = $arr;

        return $appsArray;
    }
    
    /**
     * Gets an array of certificates of type
     * 
     * @return <array>
     */
    public function getCertificates() {

        $sql = "SELECT CertificateId, CertificateName, C.CertificateTypeId, KeyCertFile, Passphrase, AppId FROM Certificates C";

        $arr = $this->dbh->sql_query($sql);

        $certificatesArray = $arr;
        
        return $certificatesArray;
    }
    
    /**
     * Gets a certificate
     * 
     * @param <int> $certificateId
     * @return <object>
     */
    public function getCertificate($certificateId) {

        $sql = "SELECT CertificateId, CertificateName, C.CertificateTypeId, KeyCertFile, Passphrase, AppId FROM Certificates C WHERE CertificateId = %d LIMIT 1";
	 	$sql = sprintf($sql, (int)$certificateId);

        $arr = $this->dbh->sql_query($sql);

        $certificate = $arr;

        return $certificate;
    }
    
     /**
     * Gets a certificate
     * 
     * @param <int> $certificateId
     * @return <object>
     */
    public function getCertificateServer($certificateId, $serverTypeId) {

        $sql = "SELECT ServerUrl FROM CertificateServer CS LEFT JOIN Servers S ON CS.ServerId = S.ServerId WHERE CertificateId = %d AND ServerTypeId = %d LIMIT 1";
	 	$sql = sprintf($sql, (int)$certificateId, (int)$serverTypeId);

        $arr = $this->dbh->sql_query($sql);

        $server = $arr;

        return $server;
    }


    /**
     * Validates is a token pattern is valid
     * 
     * @param <string> $deviceToken
     * @return <bool>
     */
    public function isTokenValid($deviceToken){
        //TODO: add validation method
        return true;
    }

    /**
     * Gets an array of devices
     * 
     * @param <int> $appId
     * @param <bool> $status
     * @return <array>
     */
    public function getDevices($appId, $status) {
        
        $sql = "SELECT AD.DeviceId, IsTestDevice, DeviceNotes FROM AppDevices AD, Devices D WHERE AD.DeviceId = D.DeviceId AND AD.AppId = %d AND AD.DeviceActive = %d";
        $sql = sprintf($sql, (int)$appId, $status);

        $arr = $this->dbh->sql_query($sql);

        $devicesArray = $arr;

        return $devicesArray;
    }
    
    
     /**
     * Gets an array of certificates of type
     * 
     * @return <array>
     */
    public function getAppSubscriptions($appId) {

        $sql = "SELECT AppSubscriptionId, SubscriptionName FROM AppSubscriptions WHERE AppId = %d";
		$sql = sprintf($sql, (int)$appId);
		 
        $arr = $this->dbh->sql_query($sql);

        $subscriptionsArray = $arr;

        return $subscriptionsArray;
    }
    
     /**
     * Gets an array of devices subscribed to a feature
     * 
     * @param <int> $appId
     * @param <int> $appFeatureId
     * @return <array>
     */
    public function getDevicesSubscribed($appSubscriptionId) {
        
        $sql = "SELECT D.DeviceId, D.DeviceNotes, IsTestDevice
				FROM AppDeviceSubscriptions ADS
				LEFT JOIN AppSubscriptions AppS ON ADS.AppSubscriptionId = AppS.AppSubscriptionId
				LEFT JOIN Devices D ON D.DeviceId = ADS.DeviceId
				LEFT JOIN AppDevices AD ON AD.DeviceID = ADS.DeviceID
				AND AD.AppId = AppS.AppId
				WHERE AppS.AppSubscriptionId = %d
				AND DeviceActive = 1
				AND ADS.SubscriptionEnabled =1";
				
        $sql = sprintf($sql, (int)$appSubscriptionId);

        $arr = $this->dbh->sql_query($sql);

        $devicesArray = $arr;

        return $devicesArray;
    }

    /**
     * Checks if a device has been  registered
     * 
     * @param <string> $deviceToken
     * @return <int>
     */
     public function isDeviceRegistered($deviceToken) {

        $sql = "SELECT DeviceId FROM Devices WHERE DeviceToken = '".$this->dbh->quote($deviceToken)."' LIMIT 1";
        
        //$sql = sprintf($sql, ''.$this->dbh->quote($deviceToken).'');
        
        
        $arr = $this->dbh->sql_query($sql);
        
        
        $deviceId = 0;
        if (count($arr) > 0) {
            //$app = $sth->fetch(PDO::FETCH_OBJ);
            $deviceId = $arr[0]['DeviceId'];
        }
        
        return $deviceId;
    }

    /**
     * Registers a device if it doesnt exist. Returns false if the deviceToken is not valid.
     *
     * @param <string> $deviceToken
     * @return <bool>
     */
    public function registerDevice($deviceToken) {

        $isTokenValid = $this->isTokenValid($deviceToken);
        if(!$isTokenValid){
            return false;
        }

        //check if device already exists
        $deviceId = $this->isDeviceRegistered($deviceToken);
        
        if($deviceId > 0){
            //device already exists
            return true;
        }

        $sql = "INSERT INTO Devices (DeviceToken) VALUES ('".$this->dbh->quote($deviceToken)."')";
        
        //$sql = sprintf($sql, $this->dbh->quote($deviceToken));
        
        $arr = $this->dbh->MySQLInsert($sql);
        
        return true;
        
    }
    
    /**
     * Sets the device status for an app
     *
     * @param <int> $deviceToekn
     * @param <int> $appId
     * @param <int> $active
     * @return <void>
     */
    public function setDeviceActive($deviceToken, $appId, $active) {

        $deviceId = $this->isDeviceRegistered($deviceToken);
        if($deviceId == 0){
            return false;
        }

        $sql = "SELECT DeviceId FROM AppDevices AD WHERE AD.DeviceId = '".$deviceId."' AND AD.AppId = '".$appId."'";
        //$sql = sprintf($sql, (int) $deviceId, (int) $appId);

        $arr = $this->dbh->sql_query($sql);

        //get the current UTC/GMT time
        $timestamp = gmdate('Y-m-d H:i:s', time());

        if (count($arr) <= 0) {
            $sql = "INSERT INTO AppDevices (AppId, DeviceID, DeviceActive, DateAdded, DateUpdated) Values ($appId, $deviceId, $active, '$timestamp', '$timestamp')";

        }else{
             $sql = "UPDATE AppDevices AD SET DeviceActive = $active, AD.DateUpdated = '{$timestamp}', LaunchCount = LaunchCount +1 WHERE AD.DeviceId = $deviceId  AND AD.AppId = $appId";
           
        }

        $arr1 = $this->dbh->sql_query($sql);
        

    }
    
    
     /**
     * Updates a subscription for a device
     *
     * @param <int> $deviceToekn
     * @param <int> $appSubscriptionId
     * @param <int> $enable
     * @return <void>
     */
    public function updateAppSubscription($deviceToken, $appSubscriptionId, $enable) {

        $deviceId = $this->isDeviceRegistered($deviceToken);
        if($deviceId == 0){
            return false;
        }

        $sql = "SELECT DeviceId FROM AppDeviceSubscriptions ADS WHERE ADS.DeviceId = %d AND ADS.AppSubscriptionId = %d LIMIT 1";
        $sql = sprintf($sql, (int) $deviceId, (int) $appSubscriptionId);

        $arr = $this->dbh->sql_query($sql);

        //get the current UTC/GMT time
        $timestamp = gmdate('Y-m-d H:i:s', time());

        if (count($arr) <= 0) {
            $sql = "INSERT INTO AppDeviceSubscriptions (DeviceID, AppSubscriptionId, DateAdded, DateUpdated, SubscriptionEnabled) Values ($deviceId, $appSubscriptionId, '$timestamp', '$timestamp', $enable)";

        }else{

             $sql = "UPDATE AppDeviceSubscriptions SET SubscriptionEnabled = $enable, DateUpdated = '{$timestamp}' WHERE DeviceId = $deviceId  AND AppSubscriptionId = $appSubscriptionId";
           
        }
		//echo $sql;
        $arr1 = $this->dbh->sql_query($sql);

    }


    /**
     * Sets a device Inactive.
     * 
     * @param <string> $deviceToken
     * @param <int> $appId
     * @param <int> $timestamp
     */
    public function setDeviceInactive($deviceToken, $appId, $timestamp){

        $sql = "UPDATE AppDevices SET DeviceActive = 0 WHERE AppId = %d AND UNIX_TIMESTAMP(DateUpdated) < %d AND DeviceId = (SELECT DeviceId FROM Devices WHERE DeviceToken = %s)";
        $sql = sprintf($sql, (int)$appId, (int)$timestamp, $this->dbh->quote($deviceToken));


        $arr = $this->dbh->sql_query($sql);

    }

    /**
     * Gets a list of messages
     * 
     * @param <int> $certificateId
     * @param <int> $statusId
     * @param <int> $limit
     * @return <array>
     */
    public function getMessages($certificateId, $statusId, $limit) {

        $sql = "SELECT DeviceToken, MessageId, Message, Badge, Sound FROM MessageQueue MQ, Devices D WHERE D.DeviceId = MQ.DeviceId AND CertificateId = %d  AND MQ.Status = %d LIMIT %d";
        $sql = sprintf($sql, (int) $certificateId, (int)$statusId, (int)$limit);

        $arr = $this->dbh->sql_query($sql);

        $messagesArray = $arr;

        return $messagesArray;
    }

    /**
     * Sets the status of a message in the Queue.
     * 
     * @param <int> $messageId
     * @param <int> $status
     */
    public function setMessageStatus($messageId, $status){

        $sql = "UPDATE MessageQueue SET Status = %d WHERE MessageId = %d";
        $sql = sprintf($sql, (int)$status, (int)$messageId);

        $arr = $this->dbh->sql_query($sql);

    }

    /**
     * Adds a message to the Queue
     * 
     * @param <int> $certificateId
     * @param <int> $deviceId
     * @param <string> $message
     * @param <int> $badge
     * @param <string> $sound
     */
    public function addMessage($certificateId, $deviceId, $message, $badge = NULL, $sound = NULL){

        $timestamp = gmdate('Y-m-d H:i:s', time());
        
        $sql = "INSERT INTO MessageQueue (CertificateId, DeviceId, Message, Badge, Sound, DateAdded) VALUES ('".$certificateId."', '".$deviceId."', '".$this->dbh->quote($message)."', '".$badge."', '".$this->dbh->quote($sound)."', '".$this->dbh->quote($timestamp)."')";
        //$sql = sprintf($sql, (int)$certificateId, (int)$deviceId, $this->dbh->quote($message), (int)$badge, $this->dbh->quote($sound), $this->dbh->quote($timestamp));

        //echo '<br/>'. $sql;
        $arr = $this->dbh->sql_query($sql);
    }
    
     /**
     * Checks if feed exists.
     *
     * @param <string> $feedUrl
     * @return <int>
     */
    public function isFeedRegistered($feedUrl){
    
    	$sql = "SELECT FeedId FROM Feeds WHERE FeedUrl = %s LIMIT 1";
        $sql = sprintf($sql, $this->dbh->quote($feedUrl));

		echo $sql;
		
        $arr = $this->dbh->sql_query($sql);

        $feedId = 0;
        if (count($arr) > 0) {
            
            $feedId = $arr[0]['FeedId'];
        }

        return $feedId;

    
    }
    
     /**
     * Registers a feed if it does not exist.
     *
     * @param <string> $feedUrl
     * @return <int>
     */
    public function registerFeed($feedUrl) {


        //check if device already exists
        $feedId = $this->isFeedRegistered($feedUrl);
        if($feedId > 0){
            //feed already exists
            return $feedId;
        }
        //get the current UTC/GMT time
        $timestamp = gmdate('Y-m-d H:i:s', time());

        $sql = "INSERT INTO Feeds (FeedUrl, DateLastChecked) VALUES (%s, %s)";
        $sql = sprintf($sql, $this->dbh->quote($feedUrl),  $this->dbh->quote($timestamp));

        $arr = $this->dbh->MySQLInsert($sql);
        
        $lastInsertedId = $arr;

        return $lastInsertedId;
        
    }
    
    
     /**
     * Subscribes a device to a feed
     * 
     * @param <int> $appDeviceId
     * @param <int> $feedId
     * @param <int> $enable
     * @return <void>
     */
    public function subscribeDeviceToFeed($deviceToken, $appId, $feedId, $enable){
    	
        $deviceId = $this->isDeviceRegistered($deviceToken);
        if($deviceId == 0){
            return false;
        }    	
    	//find the appDeviceId
    	$sql = "SELECT AppDeviceId FROM AppDevices AD WHERE AD.DeviceId = %d AND AD.AppId = %d LIMIT 1";
        $sql = sprintf($sql, (int) $deviceId, (int) $appId);

		//echo $sql;

        $arr = $this->dbh->sql_query($sql);
        
        $appDevice = $arr;
		//var_dump($appDevice);
		
		//check if its already subscribed.
		$sql = "SELECT FeedDeviceId FROM FeedDevices WHERE FeedId = %d AND AppDeviceId = %d LIMIT 1";
		$sql = sprintf($sql, $feedId, $appDevice->AppDeviceId);
		
		//echo $sql;
		
		$arr1 = $this->dbh->sql_query($sql);
        //get the current UTC/GMT time
        $timestamp = gmdate('Y-m-d H:i:s', time());

        if (count($arr1) <= 0) {
            $sql = "INSERT INTO FeedDevices (FeedId, AppDeviceId, DateAdded, DateUpdated, Enabled) Values (%d, %d, %s, %s, %d)";
			$sql = sprintf($sql, $feedId, $appDevice->AppDeviceId,   $this->dbh->quote($timestamp),$this->dbh->quote($timestamp), $enable);

        }else{

             $sql = "UPDATE FeedDevices SET Enabled = %d, DateUpdated = %s WHERE AppDeviceId = %d  AND FeedId = %d";
             $sql = sprintf($sql, $enable, $this->dbh->quote($timestamp), $appDevice->AppDeviceId, $feedId);
           
        }
		echo $sql;
        $arr = $this->dbh->sql_query($sql);
    }
    
    
     /**
     * Gets a list of feeds in random order
     * 
     * @return <array>
     */
    public function getFeeds() {

        $sql = "SELECT FeedId, FeedName, FeedUrl, DateLastUpdated, DateLastChecked FROM Feeds ORDER BY RAND()";
        
        $arr = $this->dbh->sql_query($sql);

        $feedsArray = $arr;

        return $feedsArray;
    }
    

    
    
     /**
     * Updates the DateLastChecked for a feed
     * 
     * @param <int> $feedId
     * @return <void>
     */
    public function updateFeedDateLastChecked($feedId){
    
    	 //get the current UTC/GMT time
        $timestamp = gmdate('Y-m-d H:i:s', time());
    	$sql = "UPDATE Feeds SET DateLastChecked = %s WHERE FeedId = %d";
    	$sql = sprintf($sql, $this->dbh->quote($timestamp),  $feedId);
 
        $arr = $this->dbh->sql_query($sql);
    
    }
    
    
      /**
     * Updates the DateLastChecked for a feed
     * 
     * @param <int> $feedId
     * @return <void>
     */
    public function updateFeedDateLastUpdated($feedId, $dateTime){
    
    	$sql = "UPDATE Feeds SET DateLastUpdated = %s WHERE FeedId = %d";
    	$sql = sprintf($sql, $this->dbh->quote($dateTime),  $feedId);
 		$arr = $this->dbh->sql_query($sql);
    
    }

    
    
     /**
     * Updates the DateLastChecked for a feed
     * 
     * @param <int> $feedId
     * @return <array>
     */
    public function getFeedDevices($feedId){
    
    	$sql = "SELECT D.DeviceId, D.IsTestDevice, D.DeviceNotes, C.CertificateId
				FROM  Feeds F
				LEFT JOIN FeedDevices FD ON F.FeedId = FD.FeedId
				LEFT JOIN AppDevices AD ON AD.AppDeviceId = FD.AppDeviceId
				LEFT JOIN Devices D ON AD.DeviceId = D.DeviceId
				LEFT JOIN Certificates C ON AD.AppId = C.AppId
				WHERE FD.Enabled = 1
				AND AD.DeviceActive =1
				AND C.CertificateTypeId =1
				AND F.FeedId = %d";
				
				
		$sql = sprintf($sql, $feedId);
 		//echo $sql;
        
        $arr = $this->dbh->sql_query($sql);

        $devicesArray = $arr;

        return $devicesArray;		
    }


    function destruct(){
        //close the DB connection
        $this->dbh = null;
    }
}


class DBConnection 
{
	private $DBASE="";
	private $CONN="";


	/**
	* @access	public
	* @check database connection
	* @return	true/false
	*/
	public function DBConnection($server="",$dbase="", $user="", $pass="") 
	{
        $this->DBASE = $dbase;
		$conn = mysql_connect($server,$user,$pass);
		mysql_set_charset('utf8',$conn); 
		if(!$conn) {
			$this->MySQLDie("Connection attempt failed");
		}
		if(!mysql_select_db($dbase,$conn)) {
			$this->MySQLDie("Dbase Select failed");
		}
		$this->CONN = $conn;
		return true;
	}

	/**
	* @access	public
	* @Close Database connection
	* @return	true/false
	*/
	public function MySQLClose()
	{
		$conn = $this->CONN ;
		$close = mysql_close($conn);
		if(!$close) {
			$this->MySQLDie("Connection close failed");
		}
		return true;
	}

	/**
	* @access	private
	* @Set Message for Die
	* @return	Message
	*/
	private function MySQLDie($text)
	{
		die($text);
	}

	/**
	* @access	public
	* @Retrive  Records
	* @param 	$sql query
	* @return	array
	*/
	public function MySQLSelect($sql="",$cached="")
	{	
		if(empty($sql)) { return false; }
		/*if(!eregi("^select",$sql))
		{
			echo "wrongquery<br>$sql<p>";
			echo "<H2>Wrong function silly!</H2>\n";
			return false;
		}*/
		if(empty($this->CONN)) { return false; }
		$conn = $this->CONN;
		$results = mysql_query($sql,$conn);
		if( (!$results) or (empty($results)) ) {
			return false;
		}
		$count = 0;
		$data = array();
		while ($row = mysql_fetch_assoc($results))
		{
			$data[$count] = $row;
			$count++;
		}
		mysql_free_result($results);
		return $data;
	}

	/**
	* @access	public
	* @get all fields from table 
	* @param 	$table name
	* @return	all fields
	*/
	public function MySQLGetFields($table)
	{
		$fields = mysql_list_fields($this->DBASE, $table, $this->CONN); 
		$columns = mysql_num_fields($fields); 
		for ($i = 0; $i < $columns; $i++) { 
		   $arr[]= mysql_field_name($fields, $i); 
		}
		return $arr;
	}
	/**
	* @access	public
	* @get all fields from table 
	* @param 	$table name
	* @return	all fields
	*/

	public function MySQLGetFieldsQuery($table,$primarykey='Yes')
	{
		$fields = mysql_list_fields($this->DBASE, $table, $this->CONN);

		$columns = mysql_num_fields($fields);

		for ($i = 0; $i < $columns; $i++)
		{
			if($primarykey=='Yes')
			{
				if($arrF !='')
						$arrF.= ",";
					
				$arrF.= mysql_field_name($fields, $i);
			}
			elseif($primarykey=='No')
			{
				if(!stristr(mysql_field_flags($fields, $i),'primary_key'))		
				{
					if($arrF !='')
						$arrF.= ",";
					
					$arrF.= mysql_field_name($fields, $i);
				}
			}
		}
		return $arrF;
	}
	
	
	/**
	* @access	public
	* @insert update/Query
	* @param 	$table name
	* @return	all fields
	*/
	public function MySQLQueryPerform($table, $data, $action = 'insert', $parameters = '')
	{
		$conn = $this->CONN;
		reset($data);
	    if ($action == 'insert'){$query = 'insert into ' . $table . ' (';while (list($columns, ) = each($data)) {
		$query .= $columns . ', ';
		
	    }
	    $query = substr($query, 0, -2) . ') values (';reset($data);
	   
		while (list(, $value) = each($data))
		{
			switch ((string)$value) {
			case 'null':
				$query .= 'null, ';
		    break;
		    default:
		    	$query .= '\'' . $value . '\', ';
		    	break;
		     }
	    }

		$query 		= substr($query, 0, -2) . ')'; //Insert Query ready
		
		$results 	= @mysql_query($query,$conn) or die("Query failed: " . mysql_error());
		$results 	= mysql_insert_id();
		if(!$results)
		   {
			 $this->MySQLDie("Query went bad!");
			 return false;
		   }
	    }
		elseif ($action == 'update')
		{
	      $query = 'update ' . $table . ' set ';
	      while (list($columns, $value) = each($data))
		  {
	        switch ((string)$value)
			{
	          case 'null':
	            $query .= $columns .= ' = null, ';
	             break;
	          default:
	            $query .= $columns . ' = \'' .$value. '\', ';
	            break;
	        }
	     }
	    $query = substr($query, 0, -2) . ' where ' . $parameters; //Update Query ready
		//echo $query;exit;
		$results = @mysql_query($query,$conn) or die("Query failed: " . mysql_error());
		  if(!$results)
		  {
			 $this->MySQLDie("Query went bad!");
			 return false;
		  }
	    }
		return $results;
	}
	
	/**
	* @access	public
	* @Delete
	* @param 	$table,$where
	* @return	$query
	*/
	public function MySQLDelete( $table, $where)
	{
		$query = "DELETE FROM `$table` WHERE  $where";
		//echo $query;exit;
		$conn = $this->CONN;

		// or MySQLDie("DELETE ERROR ($query): " . mysql_error() )

		if( $conn )
			return mysql_query($query, $conn);
		return $query;
	}
	
	/**
	**/
	/*public function Getfieldtype($table,$field)
	{
		$data = array();
		if(empty($table)) { return false; }
		if(empty($this->CONN)) { return false; }
		$conn = $this->CONN;
		$sql = "select * from ".$table;
		$results = mysql_query($sql,$conn) or die(mysql_error()."query fail");
		
		if(!$results)
		{   $message = "Query went bad!";
			$this->error($message);
			return false;
		}
		$i = 0;
		while ($i < mysql_num_fields($results)) 
		{
		    $meta = mysql_fetch_field($results,$i);
			echo $meta->name;
			echo $meta->type;
			echo "</br>";
			
			/*if ($meta->name == $field)
			{
				$data[name]=$meta->name;
				$data[type]=$meta->type;
			}
			$i++;
		}
		if($data)
		{
			return $data;
		}
		else
		{
			return false;
		}
	}*/
	
	/**
	* @access	public
	* @Perform the query action
	* @param 	$sql;
	* @return	$data;
	*/
	
	public function sql_query($sql="")
	{	if(empty($sql)) { return false; }
		if(empty($this->CONN)) { return false; }
		$conn = $this->CONN;
		
		$results = mysql_query($sql,$conn) or die(mysql_error()."query fail");
                
		if(!$results)
		{   $message = "Query went bad!";
			$this->error($message);
			return false;
		}
                
		if(!eregi("^select",$sql)){
			return true; }
		else {
                    
			$count = 0;
			
                        $data = array();
                        //$row = mysql_fetch_object($results);
                        
			while ( $row = mysql_fetch_array($results))	{
                            
				$data[$count] = $row;
				$count++;
			}
                        
			mysql_free_result($results);
                        
			return $data;
	 	}
	}
	
	public function MySQLInsert ($sql="")
	{
		if(empty($sql)) { return false; }
		if(!eregi("^insert",$sql))
		{
			return false;
		}
		if(empty($this->CONN))
		{
			return false;
		}
		$conn = $this->CONN;
		$results = mysql_query($sql,$conn);
		if(!$results) 
		{
			$this->error("<H2>No results!</H2>\n");
			return false;
		}
		$id = mysql_insert_id();
		return $id;
	}
	
	
	/**
	* @access	public
	* @insert  Query
	* @param 	$table name
	* @return	all fields
	*/
	public function MySQLInsertPerform($table, $data, $action = 'insert', $parameters = '')
	{
		$conn = $this->CONN;
		reset($data);
	    if ($action == 'insert'){$query = 'insert into ' . $table . ' (';while (list($columns, ) = each($data)) {
	        $query .= $columns . ', ';
	    }
	    $query = substr($query, 0, -2) . ') values (';reset($data);
		while (list(, $value) = each($data))
		{
			switch ((string)$value) {
			case 'null':
				$query .= 'null, ';
		    break;
		    default:
		    	$query .= '\'' . $value . '\', ';
		    	break;
		     }
	    }

		$query 		= substr($query, 0, -2) . ')'; //Insert Query ready
		
		$results 	= @mysql_query($query,$conn) or die("Query failed: " . mysql_error());
		if(!$results)
		   {
			 $this->MySQLDie("Query went bad!");
			 return false;
		   }
	    }
		return $results;
	}
	
	public function cache_array_new($query) {
	
    global $dbobj,$TIME_ELAPSE;
    
    $TIME_ELAPSE = !isset($TIME_ELAPSE) ? 10000:$TIME_ELAPSE;
    
    $filename = SPATH_ROOT."/cache_files/".md5($query).".txt";
      if (!file_exists($filename)) {
      	$content=	$this->MySQLSelect($query,"No");//Result array set of $array=$db->query($query, "query");
        
        if (!$handle = fopen($filename, 'w+')) {	//If File is not exists than attemp to create it
      		echo "not created";
      		exit();	
      	}
      	$content_file	=	serialize($content);
      	if (fwrite($handle, $content_file) === FALSE) {
      		echo "permision denied or file not exists";
      		exit();	
      	}
      	chmod($filename,0777);
      	fclose($handle);
      } else {
      	
        $time = filemtime($filename);
       	$time = $time + $TIME_ELAPSE;
      	$curTime = strtotime("now");
      	/*echo $curTime." < ".$time;
      	echo "<hr>";
      	echo $curTime < $time;*/
      	//echo "<pre>";
        if($curTime < $time) { 
          
        	if (!$handle = fopen($filename, 'r')) {	//If File exists than attemp to create it
        	
        		echo "not created";
        	
        		exit();	
        	}
        	$content	=	fread($handle, filesize($filename));
        	$content	=	unserialize($content);
        	//var_dump($content);
      	} else {
      	   $content=	$this->MySQLSelect($query,"No");	//Result array set of $array=$db->query($query, "query");
      
        	if (!$handle = fopen($filename, 'w+')) {	//If File is not exists than attemp to create it
        		echo "not created";
        		exit();	
        	}
        
        	$content_file	=	serialize($content);
        
        	if (fwrite($handle, $content_file) === FALSE) {
        		echo "permision denied or file not exists";
        		exit();	
        	}
        	chmod($filename,0777);
        	fclose($handle);
      	
        }
      }
    return $content;
    }
    
    function quote($val){
        return trim($val);
    }

}
?>
