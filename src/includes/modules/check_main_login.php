<?php

	/////////////// check main login ///////////////	
	
	$check = new CheckLogin();
	$rowUser = $check->isLogon();
	
	if( is_array( $rowUser ) ){
		
		$check->updateInformation( $rowUser["sessionid"] ); //Is Logon
									
	}
	else{
		 		
  		@header("Location: index.php" );
		exit();	//Is Not Logon
		
	}		
	
?>