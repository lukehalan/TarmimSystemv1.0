<?php

	include("includes/include_main.php");
	include("includes/modules/show_no_attack.php");
	include("includes/modules/check_main_login.php");	

	/////////////// logout ///////////////
		
	/////////////// connet database ///////////////
	
	$database = new MySQL( DB_ARYA , DB_ARYA_USER_SUPER , DB_ARYA_PASSWORD_SUPER , MYSQL_SERVER_1 );
	$database->connect();
		
	/////////////// security logout ///////////////		
	
	$str = "SET AUTOCOMMIT = 0";
	$res = $database->query( $str );
	$database->free_result( $res );
		
	$str = "BEGIN";
	$res = $database->query( $str );
	$database->free_result( $res );	
		
	/////////////// normal logout ///////////////
	
	$str = "SELECT * FROM " . DB_ARYA_ONLINE_TBL_USER . " WHERE sessionid = '" . $rowUser["sessionid"] . "'";
	$res = $database->query( $str );												
	
	if( $row = $database->fetch_object( $res ) ){
		
		$length_of_time = $row->last_action - $row->time_stamp;				
		
		$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET last_login_time_stamp = $row->time_stamp , 
			   last_login_ip = '$row->ip' , last_login_host = '$row->host' , 
			   time_of_logon = $length_of_time 
			   WHERE username = '$row->username'";
		$res = $database->query( $str );
		$database->free_result( $res );
		
		$str = "DELETE FROM " . DB_ARYA_ONLINE_TBL_USER . " WHERE sessionid = '$row->sessionid'";
		$res = $database->query( $str );
		$database->free_result( $res );
		
	}

	$str = "COMMIT";
	$result = $database->query( $str );
	$database->free_result( $result );
			
	$database->close_db();
	
	if( $result ){
	
		set_cookie( "si" , "" , time() - 24 * 60 * 60 );				
		header("Location: index.php");
		exit();	//Logout Successfull
		
	}

?>