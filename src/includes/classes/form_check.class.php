<?php

	class FormCheck{
	
		/////////////// username ///////////////
		
		function isUsername( $username ){
			
			$username = strtolower( $username );
						
			preg_match( '/^[a-zA-Z]+(\.[a-zA-Z0-9]+)*[a-zA-Z0-9]*/' , $username , $matches );
				
			if( $username == $matches[0] ){
				
				return true;
				
			}
			else{
				
				return false;
				
			}
			
		}
		
		/////////////// allowed ///////////////
		
		function isAllowed( $username ){
			
			$username = strtolower( $username );
						
			$notallowed = array( "admin" , "pishbal" , "aryashop" , "aryateams" , "offlinedvb" );
				
			for( $i = 0 ; $i < sizeof( $notallowed ) ; $i++ ){
				
				if( strchr( $username , $notallowed[$i] ) != "" ){
					
					return false;
					
				}
				
			}
			
			return true;
			
		}		
		
		/////////////// is unique field ///////////////
		
		function isUnique( $field , $value ){
					
			$database = new MySQL( DB_ARYA , DB_ARYA_USER_NORMAL , DB_ARYA_PASSWORD_NORMAL , MYSQL_SERVER_1 );
			$database->connect();
						
			$str = sprintf( "SELECT COUNT(*) FROM " . DB_ARYA_USER_TBL_USER . " WHERE %s = %s" , 
							 $field , quote_smart( $value , "string" ) );
			$res = $database->query( $str );
			$row = $database->fetch_array( $res );
			$numRows = $row["COUNT(*)"];
			$database->free_result( $res );
			$database->close_db();
			
			if( $numRows == 0 ){
				
				return true;
				
			}
			else{
				
				return false;
				
			}			
			
		}		
		
		/////////////// is one record ///////////////
		
		function isOne( $field , $value ){
			
			//$value = strtolower( $value );
			
			$database = new MySQL( DB_ARYA , DB_ARYA_USER_NORMAL , DB_ARYA_PASSWORD_NORMAL , MYSQL_SERVER_1 );
			$database->connect();	
			
			$str = sprintf( "SELECT * FROM " . DB_ARYA_USER_TBL_USER . " WHERE %s = %s" , 
							 $field , quote_smart( $value , "string" ) );			
			$res = $database->query( $str );
			$row = $database->fetch_array( $res );
			$numRows = $database->num_rows( $res );
			$database->free_result( $res );
			$database->close_db();
			
			if( $numRows == 1 ){
				
				return $row;
				
			}
			else{
				
				return false;
				
			}
			
		}			
				
		/////////////// positive number ///////////////
		
		function isPositiveNumber( $number ){
							
			preg_match( '/^[1-9]+[0-9]*/' , $number , $matches );
				
			if( $number > 0 && $number === $matches[0] ){
				
				return true;
				
			}
			else{
				
				return false;
				
			}	
			
		}
		
		/////////////// not negative number ///////////////
		
		function isNotNegativeNumber( $number ){
							
			preg_match( '/^[0-9]+[0-9]*/' , $number , $matches );
				
			if( $number >= 0 && $number === $matches[0] ){
				
				return true;
				
			}
			else{
				
				return false;
				
			}	
			
		}		

		/////////////// safe password ///////////////
		
		function isSafePassword( $password ){
							
			/*preg_match( '/^091+[0-9]+/' , $mobile , $matches );
				
			if( strlen( $mobile ) >= 10 && $mobile == $matches[0] ){
				
				return true;
				
			}
			else{
				
				return false;
				
			}	*/return true;
			
		}	
		
	}

?>