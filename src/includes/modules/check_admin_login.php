<?php

	/////////////// check admin normal login ///////////////	
	
	$check = new CheckLogin();
	$rowUser = $check->isLogon();
	
	if( is_array( $rowUser ) && $rowUser["username"] == "admin" ){
		
		$check->updateInformation( $rowUser["sessionid"] );	
				
	}
	else if( is_array( $rowUser ) && $rowUser["username"] != "admin" ){
		
		$check->updateInformation( $rowUser["sessionid"] );	
		@header("Location: index.php");
		exit();	//Is Not Security Logon
				
	}		
	else{
			
		@header("Location: index.php");		
		exit();	//Is Not Logon
		
	}	
	
?>