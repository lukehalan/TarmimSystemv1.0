<?php
	
	/////////////// show main logout ///////////////	
	
	$check = new CheckLogin();
	$rowUser = $check->isLogon();
	
	if( is_array( $rowUser ) ){
		
		$check->updateInformation( $rowUser["sessionid"] );		
		@header("Location: download.php");		
		exit();	//Is Logon		
									
	}	
	
?>