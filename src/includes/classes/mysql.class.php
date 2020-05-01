<?php

	class MySQL{
	
		var $conn_id;
		var $result;
		var $record;
		var $host;
		var $port;
		var $user;
		var $pass;
		var $database;
		
		
		function MySQL( $database , $user , $pass , $host , $port = 3306 ){
		    
			$this->host = $host;
			$this->port = $port;				
			$this->user = $user;
			$this->pass = $pass;
			$this->database = $database;
					
		}
		
		/////////////// connect  ///////////////
		
		function connect(){
		
			$this->conn_id = @mysql_connect( $this->host . ":" . $this->port , $this->user ,$this->pass );
			
			if( $this->conn_id == 0 ){
			
				$this->sql_error("Connection Error");
			
			}
			
			if( !@mysql_select_db( $this->database , $this->conn_id ) ){
			
				$this->sql_error("Database Error");
			
			}
			
			return $this->conn_id;
		
		}
		
		/////////////// query  ///////////////
		
		function query( $query_string ){
		
			$this->result = @mysql_query( $query_string , $this->conn_id );
			
			if( !$this->result ){echo $query_string;
			
				$this->sql_error("Query Error");
			
			}
			
			return $this->result;
		
		}
		
		/////////////// fetch array  ///////////////
		
		function fetch_array( $query_id ){
		
			$this->record = @mysql_fetch_array( $query_id );
			
			return $this->record;
		
		}
		
		/////////////// fetch object  ///////////////
		
		function fetch_object( $query_id ){
		
			$this->record = @mysql_fetch_object( $query_id );
			
			return $this->record;
		
		}	
		
		/////////////// num rows  ///////////////
		
		function num_rows( $query_id ){
		
			return ($query_id) ? @mysql_num_rows( $query_id ) : 0;
		
		}
		
		/////////////// num fields  ///////////////
		
		function num_fields( $query_id ){
		
			return ($query_id) ? @mysql_num_fields( $query_id ) : 0;
		
		}
		
		/////////////// free result  ///////////////
		
		function free_result( $query_id ){
		
			return @mysql_free_result( $query_id );
		
		}
		
		/////////////// affected rows  ///////////////
		
		function affected_rows(){
		
			return @mysql_affected_rows( $this->conn_id );
		
		}
		
		/////////////// close database  ///////////////
		
		function close_db(){
		
			if( $this->conn_id ){
				
				return @mysql_close( $this->conn_id );
			  
			} 
			else{
			  
				return false;
				
			}
		
		}
		
		/////////////// error  ///////////////
		
		function sql_error( $message ){
		
		$description = mysql_error();
		$number = mysql_errno();
		$error ="MySQL Error : $message\n";
		$error.="Error Number: $number $description\n";
		$error.="Date        : " . sunDate(3) . " :: " . tehranClock(3) . "\n";
		$error.="IP          : " . getenv("REMOTE_ADDR") . "\n";
		$error.="Browser     : " . getenv("HTTP_USER_AGENT") . "\n";
		$error.="Referer     : " . getenv("HTTP_REFERER") . "\n";
		$error.="PHP Version : " . PHP_VERSION . "\n";
		$error.="OS          : " . PHP_OS . "\n";
		$error.="Server      : " . getenv("SERVER_SOFTWARE") . "\n";
		$error.="Server Name : " . getenv("SERVER_NAME") . "\n";
		
echo "<br>".$error;//hide for upload

		echo "
		
			<html>
			
			<head>
			
				<title>Arya Shop</title>
				<meta http-equiv='content-type' content='text/html; charset=UTF-8'>
				<link href='../../style.css' rel='stylesheet' type='text/css' />
					
			</head>
			
			<body>
		
			<table cellpadding='0' cellspacing='0' border='0' align='center' width='500'>
			
				<tr>	
				  <td valign='top' height='30'></td>	  
				</tr>
				
				<tr>
					<td>
					
						<table cellpadding='0' cellspacing='0' border='0' align='center'>
			
							<tr>
								<td align='center' dir='rtl' width='500' class='error'>
									خطایی در بانک اطلاعاتی رخ داده است !
								</td>
							</tr>	
			
							<tr>
								<td align='center' dir='rtl' width='500' class='green' height='10'>
								</td>
							</tr>	
															
							<tr>
								<td align='center' dir='rtl' width='500' class='green'>
									لطفا بار دیگر تلاش نمایید
								</td>
							</tr>				
							
							<tr>
								<td align='center' dir='rtl' width='500' class='green' height='10'>
								</td>
							</tr>	
							
						</table>
			
					</td>
				</tr>
					
			</table>		
		
			</body>
			
			</html>
			
		     ";
		
		$headers = "From: " . $this->database . "@" . $this->host . "\nX-Mailer: Arya Report Error";
		$to = WEBMASTER_EMAIL;
		@mail( $to , "Arya Report Error" , $error , $headers );
		
		exit();
		
		}
	
	}

?>