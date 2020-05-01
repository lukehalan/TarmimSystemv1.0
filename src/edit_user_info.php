<?php 
	
	include("includes/include_main.php");
	include("includes/modules/show_no_attack.php");	
	include("includes/modules/check_admin_login.php");	

	/////////////// connect database ///////////////
	
	$database = new MySQL( DB_ARYA , DB_ARYA_USER_SUPER , DB_ARYA_PASSWORD_SUPER , MYSQL_SERVER_1 );
	$database->connect();	
	
	/////////////// get user ///////////////
	
	if( isset( $_GET["username"] ) && trim( $_GET["username"] ) != "" ){
	
		$username = $_GET["username"];
		$id = sprintf( "%s" , quote_smart( $_GET["username"] , "string" ) );
				
		$str = "SELECT * FROM " . DB_ARYA_USER_TBL_USER . " WHERE username = $id";
		$res = $database->query( $str );
		$rowInfo = $database->fetch_object( $res );
		$database->free_result( $res );
		
	}
	
	if( !is_object( $rowInfo ) ){
		
		header("Location: edit_user.php");
		exit();
		
	}

	/////////////// remove date ///////////////
	
	if( isset( $_GET["action"] ) && $_GET["action"] == "delete" && isset( $_GET["date"] ) ){
	
		$id = $_GET["date"];

		if( $id == "all" ){
			
			$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET active_date = '' WHERE username = '$rowInfo->username'";
			$result = $database->query( $str );
			$database->free_result( $result );			
			
			if( $result ){
			
				$successArray["edit"] = "روز های مورد نظر با موفقیت حذف شدند !";
				unset( $inputStrArray );
				unset( $inputNumArray );
				
			}
			else{
				
				$errorArray["edit"] = "در حذف روز های مورد نظر خطایی رخ داده است !";
				
			}
					
		}
		else{
			
			$active_date = str_replace( $id . ";" , "" , $rowInfo->active_date );
			
			$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET active_date = '$active_date' WHERE username = '$rowInfo->username'";
			$result = $database->query( $str );
			$database->free_result( $result );

			if( $result ){
			
				$successArray["edit"] = "روز مورد نظر با موفقیت حذف شدند !";
				unset( $inputStrArray );
				unset( $inputNumArray );
				
			}
			else{
				
				$errorArray["edit"] = "در حذف روز مورد نظر خطایی رخ داده است !";
				
			}
								
		}
		
	}	
	
	/////////////// max_daily_login ///////////////	

	if( isset( $_POST["max_daily_login"] ) ){
				
		if( FormCheck::isPositiveNumber( $_POST["max_daily_login"] ) ){
			
			if( $_POST["max_daily_login"] != $rowInfo->max_daily_login ){
				
				$inputNumArray["max_daily_login"] = $_POST["max_daily_login"];
				$validArray["max_daily_login"] = true;
			
			}
			else{
				
				$inputNumArray["max_daily_login"] = $_POST["max_daily_login"];
				$validArray["max_daily_login"] = false;			
				
			}			
			
		}
		else{
			
			$inputNumArray["max_daily_login"] = $rowInfo->max_daily_login;
			$validArray["max_daily_login"] = false;				
			$errorArray["max_daily_login"] = "شما می بایست بیشینه ورود روزانه را به درستی وارد نمایید !";
			
		}
		
	}
	else{
		
		$inputNumArray["max_daily_login"] = $rowInfo->max_daily_login;
		$validArray["max_daily_login"] = false;
		
	}	
	
	/////////////// Edit End ///////////////
	
	if( $validArray["max_daily_login"] ){		

		$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET";
		$str .= sprintf( " max_daily_login = %d ," , quote_smart( $inputNumArray["max_daily_login"] , "number" ) );
		$str .= sprintf( " allow_daily_login = %d " , quote_smart( $inputNumArray["max_daily_login"] , "number" ) );
		$str .= "WHERE username = '$rowInfo->username'";
		$result = $database->query( $str );
		$database->free_result( $result );								
					
		if( $result ){
		
			$successArray["max_daily_login"] = "بیشینه ورود روزانه کاربر مورد نظر با موفقیت ویرایش شد !";
			
		}
		else{
			
			$errorArray["max_daily_login"] = "در ویرایش بیشینه ورود روزانه کاربر مورد نظر خطایی رخ داده است !";
			
		}
		
	}
		
	/////////////// max_monthly_login ///////////////	

	if( isset( $_POST["max_monthly_login"] ) ){
				
		if( FormCheck::isPositiveNumber( $_POST["max_monthly_login"] ) ){
			
			if( $_POST["max_monthly_login"] != $rowInfo->max_monthly_login ){
				
				$inputNumArray["max_monthly_login"] = $_POST["max_monthly_login"];
				$validArray["max_monthly_login"] = true;
				
			}
			else{
				
				$inputNumArray["max_monthly_login"] = $_POST["max_monthly_login"];
				$validArray["max_monthly_login"] = false;				
				
			}
			
		}
		else{
			
			$inputNumArray["max_monthly_login"] = $rowInfo->max_monthly_login;
			$validArray["max_monthly_login"] = false;				
			$errorArray["max_monthly_login"] = "شما می بایست بیشینه ورود ماهانه را به درستی وارد نمایید !";
			
		}
		
	}
	else{
		
		$inputNumArray["max_monthly_login"] = $rowInfo->max_monthly_login;
		$validArray["max_monthly_login"] = false;
		
	}	

	/////////////// Edit End ///////////////
	
	if( $validArray["max_monthly_login"] ){		

		$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET";
		$str .= sprintf( " max_monthly_login = %d ," , quote_smart( $inputNumArray["max_monthly_login"] , "number" ) );
		$str .= sprintf( " allow_monthly_login = %d " , quote_smart( $inputNumArray["max_monthly_login"] , "number" ) );
		$str .= "WHERE username = '$rowInfo->username'";
		$result = $database->query( $str );
		$database->free_result( $result );								
					
		if( $result ){
		
			$successArray["max_monthly_login"] = "بیشینه ورود ماهانه کاربر مورد نظر با موفقیت ویرایش شد !";
			
		}
		else{
			
			$errorArray["max_monthly_login"] = "در ویرایش بیشینه ورود ماهانه کاربر مورد نظر خطایی رخ داده است !";
			
		}
		
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
				//$errorArray["password"] = "شما می بایست تایید رمز عبور را وارد نمایید !";
				
			}
			
		}
		else{
			
			$validArray["password"] = false;
			//$errorArray["password"] = "شما می بایست رمز عبور مورد نظر خود را وارد نمایید !";
			
		}	
		
	}
	else{
		
		$validArray["password"] = false;
		
	}		

	/////////////// Edit End ///////////////
	
	if( $validArray["password"] ){
		
		$inputStrArray["password"] = md5( $inputStrArray["password"] );						

		$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET";
		$str .= sprintf( " password = %s " , quote_smart( $inputStrArray["password"] , "string" ) );
		$str .= "WHERE username = '$rowInfo->username'";
		$result = $database->query( $str );
		$database->free_result( $result );								
					
		if( $result ){
		
			$successArray["passwoed"] = "رمز عبور کاربر مورد نظر با موفقیت ویرایش شد !";
			
		}
		else{
			
			$errorArray["password"] = "در ویرایش رمز عبور کاربر مورد نظر خطایی رخ داده است !";
			
		}
		
	}	

	/////////////// status ///////////////	

	if( isset( $_POST["status"] ) && $_POST["status"] != ( $rowInfo->block == 'yes' ? 'block' : 'unblock' ) ){
				
		if( $_POST["status"] == "block" ){
					
			$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET";
			$str .= " block = 'yes' WHERE username = '$rowInfo->username'";
			$result = $database->query( $str );
			$database->free_result( $result );								
	
		}
		else if( $_POST["status"] == "unblock" ){
			
			$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET";
			$str .= " block = 'no' WHERE username = '$rowInfo->username'";
			$result = $database->query( $str );
			$database->free_result( $result );	
			
		}
		
		if( $result ){
		
			$successArray["status"] = "وضعیت کاربر مورد نظر با موفقیت ویرایش شد !";
			
		}
		else{
			
			$errorArray["status"] = "در ویرایش وضعیت کاربر مورد نظر خطایی رخ داده است !";
			
		}
				
	}
		
	/////////////// date ///////////////
	
	if( isset( $_POST["submit1"] ) ){
	
		if( isset( $_POST["date_year"] ) && isset( $_POST["date_month"] ) && isset( $_POST["date_day"] ) &&
			trim( $_POST["date_year"] ) != "" && trim( $_POST["date_month"] ) != "" && trim( $_POST["date_day"] ) != "" ){			
							
			$date_year = $_POST["date_year"];
			$date_month = $_POST["date_month"];
			$date_day = $_POST["date_day"];
			$inputStrArray["date"] = sprintf( "%04s" , $date_year ) . "/" . sprintf( "%02s" , $date_month ) . "/" . sprintf( "%02s" , $date_day );
			$validArray["date"] = true;
				
		}
		else{
			
			$inputStrArray["date"] = "0000/00/00";
			$validArray["date"] = false;				
			$errorArray["date"] = "شما می بایست روز ، ماه و سال روز دانلود را انتخاب نمایید !";
			
		}	
		
	}
	else{
		
		$inputStrArray["date"] = "0000/00/00";
		$validArray["date"] = false;			
	
	}

	/////////////// Insert End ///////////////
	
	if( $validArray["date"] ){
		
		$date = str_replace( "/" , "" , $inputStrArray["date"] ) . ";";
			
		$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET active_date = CONCAT( active_date , '$date' ) WHERE username = '$rowInfo->username'";
		$result = $database->query( $str );
		$database->free_result( $result );			
		
		if( $result ){
		
			$successArray["edit"] = "روز مورد نظر با موفقیت افزوده شد !";
			unset( $inputStrArray );
			unset( $inputNumArray );
			
		}
		else{
			
			$errorArray["edit"] = "در افزودن روز مورد نظر خطایی رخ داده است !";
			
		}
					
	}
	
	/////////////// get info ///////////////
	
	$str = "SELECT * FROM " . DB_ARYA_USER_TBL_USER . " WHERE username = '$rowInfo->username'";
	$res = $database->query( $str );
	$rowInfo = $database->fetch_object( $res );
	$database->free_result( $res );
			
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
			<td id="main"><?php include("includes/pages/admin/edit_user_info.php"); ?></td>
		</tr>

		<tr>	
			<td id="bottom"><?php include("includes/boxes/bottom.php"); ?></td>
		</tr>			
		
	</table>

</body>

</html>