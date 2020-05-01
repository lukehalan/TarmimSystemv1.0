<?php 
	
	include("includes/include_main.php");
	include("includes/modules/show_no_attack.php");	
	include("includes/modules/check_admin_login.php");	
	
	/////////////// user name ///////////////
	
	if( isset( $_POST["username"] ) ){
		
		if( trim( $_POST["username"] ) != "" ){
			
			if( strlen( $_POST["username"] ) >= 3 ){
			
				if( FormCheck::isUsername( strtolower( $_POST["username"] ) ) ){
								
					if( FormCheck::isUnique( "username" , strtolower( $_POST["username"] ) ) && FormCheck::isAllowed( strtolower( $_POST["username"] ) ) ){
						
						$inputStrArray["username"] = strtolower( $_POST["username"] );
						$validArray["username"] = true;
						
					}
					else{
						
						$validArray["username"] = false;
						$errorArray["username"] = "نام کاربری مورد نظر شما هم اکنون موجود می باشد !";				
						
					}
					
				}
				else{
					
					$validArray["username"] = false;
					$errorArray["username"] = "نام کاربری می بایست با حرف شروع و با حرف یا عددی پایان پذیرد و شامل نقاط کنار هم نباشد !";
					
				}
				
			}
			else{
				
				$validArray["username"] = false;				
				$errorArray["username"] = "نام کاربری شما می بایست دست کم 3 حرف باشد !";
				
			}
			
		}
		else{
				
			$validArray["username"] = false;				
			$errorArray["username"] = "شما می بایست نام کاربری مورد نظر خود را وارد نمایید !";
						
		}
		
	}
	else{
		
		$validArray["username"] = false;
		
	}
	
	/////////////// max_daily_login ///////////////	

	if( isset( $_POST["max_daily_login"] ) ){
				
		if( FormCheck::isPositiveNumber( $_POST["max_daily_login"] ) ){
					
			$inputNumArray["max_daily_login"] = $_POST["max_daily_login"];
			$validArray["max_daily_login"] = true;
			
		}
		else{
			
			$validArray["max_daily_login"] = false;				
			$errorArray["max_daily_login"] = "شما می بایست بیشینه ورود روزانه را به درستی وارد نمایید !";
			
		}
		
	}
	else{
		
		$validArray["max_daily_login"] = false;
		
	}	
	
	/////////////// max_monthly_login ///////////////	

	if( isset( $_POST["max_monthly_login"] ) ){
				
		if( FormCheck::isPositiveNumber( $_POST["max_monthly_login"] ) ){
					
			$inputNumArray["max_monthly_login"] = $_POST["max_monthly_login"];
			$validArray["max_monthly_login"] = true;
			
		}
		else{
			
			$validArray["max_monthly_login"] = false;				
			$errorArray["max_monthly_login"] = "شما می بایست بیشینه ورود ماهانه را به درستی وارد نمایید !";
			
		}
		
	}
	else{
		
		$validArray["max_monthly_login"] = false;
		
	}	

	/////////////// password ///////////////
	
	if( isset( $_POST["submit"] ) ){
		
		if( isset( $_POST["password1"] ) && $_POST["password1"] != "" ){
			
			if( isset( $_POST["password2"] ) && $_POST["password2"] != "" ){
				
				if( strcmp( $_POST["password1"] , $_POST["password2"] ) == 0 ){
					
					if( strlen( $_POST["password1"] ) >= 6 ){
						
						if( FormCheck::isSafePassword( stripslashes( htmlentities( $_POST["password1"] ) ) ) ){
					
							$inputStrArray["password"] = stripslashes( htmlentities( $_POST["password1"] , ENT_QUOTES , "UTF-8" ) );
							$validArray["password"] = true;
						}
						else{
							
							$validArray["password"] = false;
							$errorArray["password"] = "شما می بایست رمز عبور ایمنی برای خود انتخاب نمایید !";							
							
						}
						
					}
					else{
						
						$validArray["password"] = false;
						$errorArray["password"] = "رمز عبور می بایست دست کم 6 حرف باشد !";
						
					}
									
				}
				else{
					
					$validArray["password"] = false;
					$errorArray["password"] = "تایید رمز عبور می بایست با رمز عبور یکسان باشد !";
					
				}
				
			}
			else{
				
				$validArray["password"] = false;
				$errorArray["password"] = "شما می بایست تایید رمز عبور را وارد نمایید !";
				
			}
			
		}
		else{
			
			$validArray["password"] = false;
			$errorArray["password"] = "شما می بایست رمز عبور مورد نظر خود را وارد نمایید !";
			
		}	
		
	}
	else{
		
		$validArray["password"] = false;
		
	}		
			
	/////////////// compelete form ///////////////
	
	if( $validArray["username"] && $validArray["max_daily_login"] && $validArray["max_monthly_login"] && $validArray["password"] ){
		
		$validArray["register"] = true;		
				
	}
	else{
		
		$validArray["register"] = false;
		
	}

	/////////////// Register End ///////////////
	
	if( $validArray["register"] ){
		
		$inputStrArray["password"] = md5( $inputStrArray["password"] );
		
		$date = sunDate(3);
		$clock = tehranClock(3);
		$time = time();
		
		/////////////// connect database ///////////////
		
		$database = new MySQL( DB_ARYA , DB_ARYA_USER_SUPER , DB_ARYA_PASSWORD_SUPER , MYSQL_SERVER_1 );
		$database->connect();
			
		$str = "SET AUTOCOMMIT = 0";
		$res = $database->query( $str );
		$database->free_result( $res );
			
		$str = "BEGIN";
		$res = $database->query( $str );
		$database->free_result( $res );								

		$str = "INSERT INTO " . DB_ARYA_USER_TBL_USER . " SET";
		$str .= sprintf( " username = %s ," , quote_smart( $inputStrArray["username"] , "string" ) );
		$str .= sprintf( " password = %s ," , quote_smart( $inputStrArray["password"] , "string" ) );
		$str .= " last_login_date = '$date' , last_login_clock = '$clock' ,";			
		$str .= " last_login_time_stamp = $time ,";
		$str .= " last_login_ip = '' , last_login_host = '' , time_of_logon = 0 , ";
		$str .= sprintf( " allow_daily_login = %d ," , quote_smart( $inputNumArray["max_daily_login"] , "number" ) );
		$str .= sprintf( " allow_monthly_login = %d ," , quote_smart( $inputNumArray["max_monthly_login"] , "number" ) );
		$str .= sprintf( " max_daily_login = %d ," , quote_smart( $inputNumArray["max_daily_login"] , "number" ) );
		$str .= sprintf( " max_monthly_login = %d ," , quote_smart( $inputNumArray["max_monthly_login"] , "number" ) );	
		$str .= " active_date = '' , block = 'no'";
		$res = $database->query( $str );
		$database->free_result( $res );		
					
		$str = "COMMIT";
		$result = $database->query( $str );
		$database->free_result( $result );							
					
		$database->close_db();	
		
		if( $result ){
		
			$successArray["insert"] = "کاربر مورد نظر با موفقیت افزوده شد !";
			unset( $inputStrArray );
			unset( $inputNumArray );
			
		}
		else{
			
			$errorArray["insert"] = "در افزودن کاربر مورد نظر خطایی رخ داده است !";
			
		}
		
	}	

?>

<html>

<head>

	<title>Arya Teams</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="images/icon.gif" type="image/x-icon">
	<link href="style.css" rel="stylesheet" type="text/css" />
	<script src="javascripts/arya.js" type="text/javascript"></script>	
	
</head>

<body>

	<table align="center" border="0" cellpadding="0" cellspacing="0" width="750">
		
		<tr>	
			<td id="menu"><?php include("includes/boxes/menu.php"); ?></td>
		</tr>
			
		<tr>	
			<td id="top"><?php include("includes/boxes/top.php"); ?></td>
		</tr>
		
		<tr>	
			<td id="main"><?php include("includes/pages/admin/new_user.php"); ?></td>
		</tr>

		<tr>	
			<td id="bottom"><?php include("includes/boxes/bottom.php"); ?></td>
		</tr>			
		
	</table>

</body>

</html>