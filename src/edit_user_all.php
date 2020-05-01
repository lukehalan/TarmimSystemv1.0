<?php 
	
	include("includes/include_main.php");
	include("includes/modules/show_no_attack.php");	
	include("includes/modules/check_admin_login.php");	

	/////////////// connect database ///////////////
	
	$database = new MySQL( DB_ARYA , DB_ARYA_USER_SUPER , DB_ARYA_PASSWORD_SUPER , MYSQL_SERVER_1 );
	$database->connect();	

	/////////////// remove date ///////////////
	
	if( isset( $_GET["action"] ) && $_GET["action"] == "delete" && isset( $_GET["date"] ) ){
	
		$id = $_GET["date"];

		if( $id == "all" ){
			
			$str = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET active_date = ''";
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
		$result = $database->query( $str );
		$database->free_result( $result );								
					
		if( $result ){
		
			$successArray["max_monthly_login"] = "بیشینه ورود ماهانه کاربر مورد نظر با موفقیت ویرایش شد !";
			
		}
		else{
			
			$errorArray["max_monthly_login"] = "در ویرایش بیشینه ورود ماهانه کاربر مورد نظر خطایی رخ داده است !";
			
		}
		
	}
		
	/////////////// date1 ///////////////
	
	if( isset( $_POST["submit1"] ) ){
	
		if( isset( $_POST["date1_year"] ) && isset( $_POST["date1_month"] ) && isset( $_POST["date1_day"] ) &&
			trim( $_POST["date1_year"] ) != "" && trim( $_POST["date1_month"] ) != "" && trim( $_POST["date1_day"] ) != "" ){			
							
			$date1_year = $_POST["date1_year"];
			$date1_month = $_POST["date1_month"];
			$date1_day = $_POST["date1_day"];
			$inputStrArray["date1"] = sprintf( "%04s" , $date1_year ) . "/" . sprintf( "%02s" , $date1_month ) . "/" . sprintf( "%02s" , $date1_day );
			$validArray["date1"] = true;
				
		}
		else{
			
			$inputStrArray["date1"] = "0000/00/00";
			$validArray["date1"] = false;				
			$errorArray["date1"] = "شما می بایست روز ، ماه و سال روز دانلود را انتخاب نمایید !";
			
		}	
		
	}
	else{
		
		$inputStrArray["date1"] = "0000/00/00";
		$validArray["date1"] = false;			
	
	}

	/////////////// Insert End ///////////////
	
	if( $validArray["date1"] ){
		
		$date1 = str_replace( "/" , "" , $inputStrArray["date1"] ) . ";";
		
		$str = "SET AUTOCOMMIT = 0";
		$res = $database->query( $str );
		$database->free_result( $res );
			
		$str = "BEGIN";
		$res = $database->query( $str );
		$database->free_result( $res );		
					
		$str = "SELECT username,active_date FROM " . DB_ARYA_USER_TBL_USER;
		$res = $database->query( $str );
		
		while( $row = $database->fetch_object( $res ) ){
				
			$date = str_replace( $date1 , "" , $row->active_date ) . $date1;	
					
			$str1 = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET active_date = '$date' WHERE username = '$row->username'";
			$res1 = $database->query( $str1 );
			$database->free_result( $res1 );			
			
		}			
		
		$database->free_result( $res );
		
		$str = "COMMIT";
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
		
	/////////////// date2 ///////////////
	
	if( isset( $_POST["submit2"] ) ){
	
		if( isset( $_POST["date2_year"] ) && isset( $_POST["date2_month"] ) && isset( $_POST["date2_day"] ) &&
			trim( $_POST["date2_year"] ) != "" && trim( $_POST["date2_month"] ) != "" && trim( $_POST["date2_day"] ) != "" ){			
							
			$date2_year = $_POST["date2_year"];
			$date2_month = $_POST["date2_month"];
			$date2_day = $_POST["date2_day"];
			$inputStrArray["date2"] = sprintf( "%04s" , $date2_year ) . "/" . sprintf( "%02s" , $date2_month ) . "/" . sprintf( "%02s" , $date2_day );
			$validArray["date2"] = true;
				
		}
		else{
			
			$inputStrArray["date2"] = "0000/00/00";
			$validArray["date2"] = false;				
			$errorArray["date2"] = "شما می بایست روز ، ماه و سال روز دانلود را انتخاب نمایید !";
			
		}	
		
	}
	else{
		
		$inputStrArray["date2"] = "0000/00/00";
		$validArray["date2"] = false;			
	
	}

	/////////////// Insert End ///////////////
	
	if( $validArray["date2"] ){
		
		$date2 = str_replace( "/" , "" , $inputStrArray["date2"] ) . ";";
			
		$str = "SET AUTOCOMMIT = 0";
		$res = $database->query( $str );
		$database->free_result( $res );
			
		$str = "BEGIN";
		$res = $database->query( $str );
		$database->free_result( $res );		
					
		$str = "SELECT username,active_date FROM " . DB_ARYA_USER_TBL_USER;
		$res = $database->query( $str );
		
		while( $row = $database->fetch_object( $res ) ){
				
			$date = str_replace( $date2 , "" , $row->active_date );	
					
			$str1 = "UPDATE " . DB_ARYA_USER_TBL_USER . " SET active_date = '$date' WHERE username = '$row->username'";
			$res1 = $database->query( $str1 );
			$database->free_result( $res1 );			
			
		}			
		
		$database->free_result( $res );
		
		$str = "COMMIT";
		$result = $database->query( $str );
		$database->free_result( $result );			
		
		if( $result ){
		
			$successArray["edit"] = "روز مورد نظر با موفقیت کاسته شد !";
			unset( $inputStrArray );
			unset( $inputNumArray );
			
		}
		else{
			
			$errorArray["edit"] = "در کاستن روز مورد نظر خطایی رخ داده است !";
			
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
			<td id="main"><?php include("includes/pages/admin/edit_user_all.php"); ?></td>
		</tr>

		<tr>	
			<td id="bottom"><?php include("includes/boxes/bottom.php"); ?></td>
		</tr>			
		
	</table>

</body>

</html>