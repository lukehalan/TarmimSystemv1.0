<?php

	@include("includes/include_main.php");		

	/////////////// connect database ///////////////
	
	$database = new MySQL( DB_ARYA , DB_ARYA_USER_SUPER , DB_ARYA_PASSWORD_SUPER , MYSQL_SERVER_1 );
	$database->connect();
	
	list( $usec , $sec ) = explode( " ", microtime() );
    $time = ( $sec . substr( $usec , 2 , strlen( $usec ) - 7 ) );
	$date = sunDate(3);
	$clock = tehranClock(3);
	$ip = CheckLogin::getIP();
	
	/////////////// insert or update data ///////////////
	
	$str  = "SELECT * FROM " . DB_ARYA_ONLINE_TBL_MONITOR_ATTACK . " WHERE ip = '$ip'";
	$res = $database->query( $str );
	$record = $database->num_rows( $res );
	
	while( $row = $database->fetch_object( $res ) ){
		
		$str1  = "UPDATE " . DB_ARYA_ONLINE_TBL_MONITOR_ATTACK . " SET time_stamp_1 = $row->time_stamp_2 , time_stamp_2 = $time WHERE ip = '$row->ip'";
		$res1 = $database->query( $str1 );
		$database->free_result( $res1 );
		
	}
	
	if( $record == 0 ){
		
		$str1  = "INSERT INTO " . DB_ARYA_ONLINE_TBL_MONITOR_ATTACK . " SET time_stamp_1 = 0 , time_stamp_2 = $time , ip = '$ip'";
		$res1 = $database->query( $str1 );
		$database->free_result( $res1 );		
		
	}
	
	$database->free_result( $res );
		
	/////////////// get info ///////////////
	
	$str  = "SELECT * FROM " . DB_ARYA_ONLINE_TBL_MONITOR_ATTACK . " WHERE ip = '$ip'";
	$res = $database->query( $str );
		
	/////////////// block ip ///////////////

	while( $rowIP = $database->fetch_object( $res ) ){
		
		//if( !set_cookie( "ip" , $ip ) ){
			
			$time_diff = $rowIP->time_stamp_2 - $rowIP->time_stamp_1;
			
			if( $time_diff < 300 ){
				
				/////////////// block_ip_list ///////////////
				
				changeMode( "." , "block_ip_list.html" , 0777 );
				
				$fp = @fopen( "./block_ip_list.html" , "a" );
				$string = "<font nowrap style='font-size:12px;' face='tahoma' color='#333333'>$rowIP->ip ## block ## $date :: $clock ##</font><br>";
				fwrite( $fp , $string );
				@fclose( $fp );
				
				changeMode( "." , "block_ip_list.html" , 0644 );

				/////////////// .htaccess ///////////////
								
				changeMode( "." , ".htaccess" , 0777 );
				
				$fp = @fopen( ".htaccess" , "a" );
				$string = "deny from $rowIP->ip\n";
				
				if( fwrite( $fp , $string ) ){
					
					$str1  = "UPDATE " . DB_ARYA_ONLINE_TBL_MONITOR_ATTACK . " SET block = 'yes' , time_stamp_block = " . ( $time + 5*60*1000 ) . " WHERE ip = '$rowIP->ip'";
					$res1 = $database->query( $str1 );
					$database->free_result( $res1 );					
					
				}
				
				@fclose( $fp );
				
				changeMode( "." , ".htaccess" , 0644 );
									
				exit();							
				
			}
				
		//}		
		
	}
	
	$database->free_result( $res );
	
	/////////////// get info ///////////////
	
	$str  = "SELECT * FROM " . DB_ARYA_ONLINE_TBL_MONITOR_ATTACK . " WHERE block = 'yes' AND time_stamp_block < $time ";
	$res = $database->query( $str );

	/////////////// free ip ///////////////
	
	while( $rowIP = $database->fetch_object( $res ) ){
						
		/////////////// block_ip_list ///////////////
				
		changeMode( "." , "block_ip_list.html" , 0777 );
		
		$string = file_get_contents( "./block_ip_list.html" );
		$string = str_replace( "$rowIP->ip ## block ##" , "$rowIP->ip ## free  ##" , $string );
		file_put_contents( "./block_ip_list.html" , $string );
		
		changeMode( "." , "block_ip_list.html" , 0644 );

		/////////////// .htaccess ///////////////
						
		changeMode( "." , ".htaccess" , 0777 );
		
		$string = file_get_contents( ".htaccess" );
		$string = str_replace( "deny from $rowIP->ip\n" , "" , $string );
		
		if( file_put_contents( ".htaccess" , $string ) ){
			
			$str1  = "UPDATE " . DB_ARYA_ONLINE_TBL_MONITOR_ATTACK . " SET block = 'no' , time_stamp_block = 0 WHERE ip = '$rowIP->ip' ";
			$res1 = $database->query( $str1 );
			$database->free_result( $res1 );

		}
			
		changeMode( "." , ".htaccess" , 0644 );		
		
	}
	
	$database->free_result( $res );
	
	/////////////// delete old online ///////////////
	
	$str  = "DELETE FROM " . DB_ARYA_ONLINE_TBL_MONITOR_ATTACK . " WHERE time_stamp_2 < " . ( $time - 30*60 ) . " AND block = 'no' ";
	$res = $database->query( $str );
	$database->free_result( $res );
	
	$database->close_db();

?>