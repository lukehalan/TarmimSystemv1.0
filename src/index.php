<?php 
	
	include("includes/include_main.php");
	include("includes/modules/show_no_attack.php");	
	include("includes/modules/show_main_logout.php");	

	/////////////// username ///////////////
	
	if( isset( $_POST["username"] ) ){
		
		if( trim( $_POST["username"] ) != "" ){

			$validArray["username"] = true;				

		}
		else{

			$validArray["username"] = false;
			$errorArray["username"] = "شما می بایست نام کاربری خود را وارد نمایید !";
						
		}								
		
	}
	else{
		
		$validArray["username"] = false;

	}
	
	/////////////// password ///////////////
	
	if( isset( $_POST["password"] ) ){
		
		if( trim( $_POST["password"] ) != "" ){
			
			$validArray["password"] = true;
	
		}
		else{
			
			$validArray["password"] = false;
			$errorArray["password"] = "شما می بایست رمز عبور خود را وارد نمایید !";

		}	
		
	}
	else{

		$validArray["password"] = false;
		
	}	
	
	/////////////// secure code ///////////////
	
	if( isset( $_POST["securecode"] ) ){
		
		if( trim( $_POST["securecode"] ) != "" ){
		
			if( isset( $_COOKIE["sc"] ) ){
				
				if( md5( strtolower( $_POST["securecode"] ) ) == base64_decode( $_COOKIE["sc"] ) ){
					
					$validArray["securecode"] = true;
					
				}
				else{
					
					$validArray["securecode"] = false;
					$errorArray["securecode"] = "شما می بایست کد امنیتی را به درستی وارد نمایید !";
					
				}
				
			}
			else{
				
				$validArray["securecode"] = false;
				$errorArray["securecode"] = "کد امنیتی را دوباره وارد نمایید !";
				
			}
			
		}
		else{
			
			$validArray["securecode"] = false;
			$errorArray["securecode"] = "شما می بایست کد امنیتی را وارد نمایید !";
			
		}	
		
	}
	else{
		
		$validArray["securecode"] = false;
		
	}	
			
	/////////////// matching username & password ///////////////
	
	if( $validArray["username"] && $validArray["password"] && $validArray["securecode"] ){
		
		$username = stripslashes( htmlentities( $_POST["username"] , ENT_QUOTES , "UTF-8" ) );
		$password = md5( stripslashes( htmlentities( $_POST["password"] , ENT_QUOTES , "UTF-8" ) ) );
			
		$row = $check->isMatch( $username , $password );
		
		if( is_array( $row ) ){
			
			$validArray["match"] = true;
			
		}
		else{
			
			$validArray["match"] = false;
			$errorArray["match"] = "نام کاربری با رمز عبور هم خوانی ندارد !";
			
		}
		
	}	
	
	/////////////// login ///////////////
	
	if( $validArray["match"] ){
		
		$login = true;
		
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
		
		$str = "SELECT * FROM " . DB_ARYA_ONLINE_TBL_USER . " WHERE username = '" . $row["username"] . "'";
		$res = $database->query( $str );
		$rowOnline = $database->fetch_object( $res );
		$database->free_result( $res );	
		
		if( $rowOnline->ip == $check->getIP() && $rowOnline->host == $check->getHost() ){
			
			$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET block = 'yes' WHERE username <> 'admin' AND username = '" . $row["username"] . "'";
			$res = $database->query( $str );
			$database->free_result( $res );
				
			$str = "UPDATE " . DB_ARYA_ONLINE_TBL_USER . " SET expire = 'yes' WHERE username <> 'admin' AND username = '" . $row["username"] . "'";
			$res = $database->query( $str );
			$database->free_result( $res );
							
			$login = false;
			
		}
		
		if( $row["block"] == "yes" ){
			
			$errorArray["error1"] = "حساب کاربری شما مسدود شده است !";
			$login = false;
			
		}
		
		if( $row["last_login_date"] == sunDate(3) && $row["allow_daily_login"] <= 0 ){
			
			$errorArray["error2"] = "اجازه ورود شما برای امروز به پایان رسیده است !";
			$login = false;
			
		}
		else if( $row["last_login_date"] != sunDate(3) ){
			
			$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET allow_daily_login = max_daily_login WHERE username = '" . $rowUser["username"] . "'";
			$res = $database->query( $str );
			$database->free_result( $res );	
			
		}
		
		if( substr( $row["last_login_date"] , 0 , 6 ) == substr( sunDate(3) , 0 , 6 ) && $row["allow_monthly_login"] <= 0 ){
			
			$errorArray["error3"] = "اجازه ورود شما برای این ماه به پایان رسیده است !";
			$login = false;
			
		}
		else if( substr( $row["last_login_date"] , 0 , 6 ) != substr( sunDate(3) , 0 , 6 ) ){
			
			$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET allow_monthly_login = max_monthly_login WHERE username = '" . $rowUser["username"] . "'";
			$res = $database->query( $str );
			$database->free_result( $res );		
			
		}
		
		if( $login ){
		
			$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET allow_monthly_login = allow_monthly_login - 1 , allow_daily_login = allow_daily_login - 1 , last_login_date = '" . sunDate(3) . "' , last_login_clock = '" . tehranClock(3) . "' , last_login_time_stamp = '" . time() . "' WHERE username = '" . $row["username"] . "' AND allow_monthly_login > 0 AND allow_daily_login > 0";
			$res = $database->query( $str );
			$database->free_result( $res );

					
			$inputStrArray["username"] = $row["username"];
			$inputStrArray["ip"] = $check->getIP();
			$inputStrArray["host"] = $check->getHost();
			$session = md5( rand() . sunDate(3) . tehranClock(3) . $inputStrArray["username"] . $inputStrArray["ip"] . $inputStrArray["host"] );
			$inputStrArray["sessionid"] = $session;
			$inputNumArray["time_stamp"] = time();
			$inputNumArray["last_action"] = time();
			
			$str = "INSERT INTO " . DB_ARYA_ONLINE_TBL_USER . " SET";
			
			if( !empty( $inputStrArray ) ){
				
				foreach( $inputStrArray as $field => $value ){
					
					$str .= " $field = '$value' ,";
					
				}
				
			}
			
			if( !empty( $inputNumArray ) ){
				
				foreach( $inputNumArray as $field => $value ){
					
					$str .= " $field = $value ,";
					
				}
	
			}	
			
			$str = substr( $str , 0 , strlen( $str ) - 2 );
			$res = $database->query( $str );
			$numRows = $database->affected_rows( $res );
			$database->free_result( $res );
		
		}
		
		$str = "COMMIT";
		$result = $database->query( $str );
		$database->free_result( $result );
			
		$database->close_db();	
		
		if( $numRows == 1 ){
		
			if( set_cookie( "si" , base64_encode( $session ) , time() + 30 * 60 ) ){ 					
				
		  		header("Location: download.php");								
				exit();	//Login Successfull
				
			}
			
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
			<td valign="middle" width="700" align="center" height="30" id="menu" class="title">به سیستم ترمیم فایل آریا تیمز خوش آمدید</td>
		</tr>
			
		<tr>	
			<td id="top"><?php include("includes/boxes/top.php"); ?></td>
		</tr>
		
		<tr>	
			<td id="main"><?php include("includes/pages/login.php"); ?></td>
		</tr>

		<tr>	
			<td id="bottom"><?php include("includes/boxes/bottom.php"); ?></td>
		</tr>			
		
	</table>

</body>

</html>