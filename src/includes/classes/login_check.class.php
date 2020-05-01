<?php

	class CheckLogin{
		
		/////////////// Delete Expired Session ///////////////

		function CheckLogin(){
			
			$database = new MySQL( DB_ARYA , DB_ARYA_USER_SUPER , DB_ARYA_PASSWORD_SUPER , MYSQL_SERVER_1 );
			$database->connect();	
								
			/////////////// normal login ///////////////
			
			$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " as t1 LEFT JOIN " . 
				   DB_ARYA_ONLINE_TBL_USER . " as t2 ON t1.username = t2.username SET " .
				   "t1.last_login_time_stamp = t2.time_stamp ,
				   t1.last_login_ip = t2.ip , t1.last_login_host = t2.host ,
				   t1.time_of_logon = t2.last_action - t2.time_stamp , t2.expire = 'yes'  
				   WHERE t2.last_action < " . ( time() - 20 * 60 ) . " AND t2.expire = 'no'";
			$res = $database->query( $str );
			$database->free_result( $res );			
			
			/////////////// delete expire ///////////////
	
			$str = "DELETE FROM " . DB_ARYA_ONLINE_TBL_USER . " WHERE expire = 'yes'";
			$res = $database->query( $str );
			$database->free_result( $res );
								
			$database->close_db();
				
		}	
		
		/////////////// is unique field ///////////////
		
		function isUnique( $field , $value ){
				
			$database = new MySQL( DB_ARYA , DB_ARYA_USER_NORMAL , DB_ARYA_PASSWORD_NORMAL , MYSQL_SERVER_1 );
			$database->connect();	
							
			$str = sprintf( "SELECT COUNT(*) FROM " . DB_ARYA_ONLINE_TBL_USER . " WHERE %s = %s" , 
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

		/////////////// get IP ///////////////

		function getIP(){
			
			$ip = $_SERVER["REMOTE_ADDR"];
			
			return $ip;
		
		}
		
		/////////////// get Host ///////////////
		
		function getHost(){
					
			$host = gethostbyaddr( $_SERVER["REMOTE_ADDR"] );
			
			return $host;	
		
		}
		
		/////////////// is match username & password ///////////////
		
		function isMatch( $username , $password ){
			
			$database = new MySQL( DB_ARYA , DB_ARYA_USER_NORMAL , DB_ARYA_PASSWORD_NORMAL , MYSQL_SERVER_1 );
			$database->connect();				
			
			$username = strtolower( $username );	
			
			$str = sprintf( "SELECT * FROM " . DB_ARYA_USER_TBL_USER . " WHERE username = %s AND password = %s" , 
							 quote_smart( $username , "string" ) , quote_smart( $password , "string" ) );			
			$res = $database->query( $str );
			$numRows = $database->num_rows( $res );
			$row = $database->fetch_array( $res );
			$database->free_result( $res );
			$database->close_db();
			
			if( $numRows == 1 ){
				
				return $row;
				
			}
			else{
				
				return false;
				
			}			
			
		}
		
		
		/////////////// Check User's Authentication  ///////////////
		
		function isLogon(){
			
			if( isset( $_COOKIE["si"] ) ){
				
				$database = new MySQL( DB_ARYA , DB_ARYA_USER_NORMAL , DB_ARYA_PASSWORD_NORMAL , MYSQL_SERVER_1 );
				$database->connect();	
							
				$sessionid = base64_decode( $_COOKIE["si"] );
				
				$str = sprintf( "SELECT * FROM " . DB_ARYA_ONLINE_TBL_USER . " WHERE sessionid = %s AND expire = 'no'" , 
								 quote_smart( $sessionid , "string" ) );					
				$res = $database->query( $str );
				$numRows = $database->num_rows( $res );
				$row = $database->fetch_array( $res );
				$database->free_result( $res );
				$database->close_db();
				
				if( $numRows == 1 ){
					
					if( ( $this->getIP() == $row["ip"] ) && ( $this->getHost() == $row["host"] ) ){
						
						return $row;
						
					}
					else{
						
						return false;
						
					}
					
				}
				else{
					
					set_cookie( "si" , "" , time() - 24 * 60 * 60 );
					return false;
					
				}
				
			}
			else{
				
				return false;
				
			}
			
		}
				
		/////////////// Update User's Online Information  ///////////////
		
		function updateInformation( $sessionid ){
			
			$database = new MySQL( DB_ARYA , DB_ARYA_USER_SUPER , DB_ARYA_PASSWORD_SUPER , MYSQL_SERVER_1 );
			$database->connect();	
						
			$str = sprintf( "UPDATE " . DB_ARYA_ONLINE_TBL_USER . " SET last_action = " . time() ." WHERE sessionid = %s AND expire = 'no'" , 
							 quote_smart( $sessionid , "string" ) );				
			$res = $database->query( $str );
			$numRows = $database->affected_rows();
			$database->free_result( $res );
			$database->close_db();
			
			if( $numRows == 1 ){

				set_cookie( "si" , base64_encode( $sessionid ) , time() + 30 * 60 );		
				
			}
			
		}
				
	}		
		
?>