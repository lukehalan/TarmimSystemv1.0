<?php 
	
	include("includes/include_main.php");
	include("includes/modules/show_no_attack.php");	
	include("includes/modules/check_admin_login.php");	

	/////////////// connect database ///////////////
	
	$database = new MySQL( DB_ARYA , DB_ARYA_USER_SUPER , DB_ARYA_PASSWORD_SUPER , MYSQL_SERVER_1 );
	$database->connect();	
	
	/////////////// remove user ///////////////
	
	if( isset( $_GET["action"] ) && $_GET["action"] == "delete" && isset( $_GET["user"] ) ){
	
		$id = sprintf( "%s" , quote_smart( $_GET["user"] , "string" ) );
				
		$str = "DELETE FROM " . DB_ARYA_USER_TBL_USER . " WHERE username = $id AND username <> 'admin'";
		$res = $database->query( $str );
		$database->free_result( $res );
		
		if( $res ){
			
			$successArray["delete"] = "کاربر مورد نظر با موفقیت حذف شد !";
			
		}
		else{
		
			$errorArray["delete"] = "در حذف کاربر مورد نظر خطایی رخ داده است !";	
			
		}
		
	}
		
	/////////////// username ///////////////
			
	if( isset( $_GET["username"] ) && trim( $_GET["username"] ) != "" ){
	
		$set["username"] = stripslashes( htmlentities( $_GET["username"] , ENT_QUOTES , "UTF-8" ) );
		$searchArray = preg_split( '/[^\.a-zA-Z0-9]+/' , $set["username"] );
		$search = "";
		
		for( $i = 0 ; $i < sizeof( $searchArray ) ; $i++ ){
			
			$search .= sprintf( "username LIKE '%%%s%%' OR " , 
								quote_smart( $searchArray[$i] , "order" ) );
			
		}

		$search = substr( $search , 0 , strlen( $search ) - 4 );
		
	}
	else{
	
		$set["username"] = "";
	
	}
			
	/////////////// last_login_date ///////////////
		
	if( isset( $_GET["startdate_year"] ) && isset( $_GET["startdate_month"] ) && isset( $_GET["startdate_day"] ) &&
		trim( $_GET["startdate_year"] ) != "" && trim( $_GET["startdate_month"] ) != "" && trim( $_GET["startdate_day"] ) != "" &&
		isset( $_GET["enddate_year"] ) && isset( $_GET["enddate_month"] ) && isset( $_GET["enddate_day"] ) &&
		trim( $_GET["enddate_year"] ) != "" && trim( $_GET["enddate_month"] ) != "" && trim( $_GET["enddate_day"] ) != "" ){
					
		$startdate_year = sprintf( "%d" , quote_smart( $_GET["startdate_year"] , "number" ) );
		$startdate_month = sprintf( "%d" , quote_smart( $_GET["startdate_month"] , "number" ) );
		$startdate_day = sprintf( "%d" , quote_smart( $_GET["startdate_day"] , "number" ) );
		$set["startdate"] = sprintf( "%04s" , $startdate_year ) . "/" . sprintf( "%02s" , $startdate_month ) . "/" . sprintf( "%02s" , $startdate_day );
		
		$enddate_year = sprintf( "%d" , quote_smart( $_GET["enddate_year"] , "number" ) );
		$enddate_month = sprintf( "%d" , quote_smart( $_GET["enddate_month"] , "number" ) );
		$enddate_day = sprintf( "%d" , quote_smart( $_GET["enddate_day"] , "number" ) );
		$set["enddate"] = sprintf( "%04s" , $enddate_year ) . "/" . sprintf( "%02s" , $enddate_month ) . "/" . sprintf( "%02s" , $enddate_day );		
		
	}
	else{
		
		$set["startdate"] = "";
		$set["enddate"] = "";
		
	}

	/////////////// status ///////////////
	
	if( isset( $_GET["status"] ) ){
		
		$set["status"] = $_GET["status"];			
		
	}
	else{
		
		$set["status"] = "both";
		
	}
		
	/////////////// page ///////////////
	
	if( isset( $_GET["page"] ) ){
		
		$set["page"] = $_GET["page"];
		$query["page"] = sprintf( "%d" , quote_smart( $_GET["page"] , "number" ) );
		
	}
	else{
		
		$set["page"] = "1";
		$query["page"] = "1";
		
	}	

	/////////////// url ///////////////
	
	$url = "";
	
	if( !empty( $set ) ){
		
		foreach( $set as $index => $value ){
		
			$url .= $index . "=" . $value . "&" ;
			
		}
	
	}
	$url = substr( $url , 0 , strlen( $url ) - 1 );
		
	/////////////// search query ///////////////
	
	$sql["search"]  = "SELECT * FROM " . DB_ARYA_USER_TBL_USER . " WHERE ";
		
	if( $set["startdate"] != "" && $set["enddate"] != "" ){
	
		$sql["search"] .= "last_login_date BETWEEN '" . $set["startdate"] . "' AND '" . $set["enddate"] . "' AND "; 
		
	}

	if( $set["status"] == "block" ){
		
		$sql["search"] .= "block = 'yes' AND ";
		
	}
	else if( $set["status"] == "unblock" ){
		
		$sql["search"] .= "block = 'no' AND ";
		
	}
		
	if( $search != "" ){
	
		$sql["search"] .= "$search AND "; 
		
	}
		
	$sql["search"] .= "username IS NOT NULL LIMIT " . ( $query["page"] - 1 ) * 5 . ",5";

	$result["search"] = $database->query( $sql["search"] );
	
	/////////////// startdate ///////////////
	
	$str = "SELECT MIN(last_login_date) FROM " . DB_ARYA_USER_TBL_USER;
	$res = $database->query( $str );
	$row = $database->fetch_array( $res );
	$database->free_result( $res );
	
	if( $row["MIN(last_login_date)"] != "" ){
		
		$startdate = $row["MIN(last_login_date)"];
		
	}
	else{
		
		$startdate = sunDate(3);
		
	}
	
	if( $set["startdate"] == "" ){
		
		$set["startdate"] = $startdate;
		
	}
		
	/////////////// enddate ///////////////

	$str = "SELECT MAX(last_login_date) FROM " . DB_ARYA_USER_TBL_USER;
	$res = $database->query( $str );
	$row = $database->fetch_array( $res );
	$database->free_result( $res );
	
	if( $row["MAX(last_login_date)"] != "" ){
		
		$enddate = $row["MAX(last_login_date)"];
		
	}
	else{
		
		$enddate = sunDate(3);
		
	}
		
	if( $set["enddate"] == "" ){
		
		$set["enddate"] = $enddate;
		
	}
	
	/////////////// count ///////////////
	
	$str = str_replace( "*" , "COUNT(*)" , $sql["search"] );
	$str = str_replace( strchr( $sql["search"] , "LIMIT" ) , "" , $str );
	$res = $database->query( $str );
	$row = $database->fetch_array( $res );
	$countRecord = $row["COUNT(*)"];
	$database->free_result( $res );

	/////////////// paging ///////////////
	
	$start = $set["page"] - 5 < 1 ? 1 : $set["page"] - 5;
	$end = $start + 9 > ( $countRecord + 4 ) / 5 ? ( $countRecord + 4 ) / 5 : $start + 9;
	$start = $end - 9 < $start ? 1 : $end - 9;
		
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
			<td id="main"><?php include("includes/pages/admin/edit_user.php"); ?></td>
		</tr>

		<tr>	
			<td id="bottom"><?php include("includes/boxes/bottom.php"); ?></td>
		</tr>			
		
	</table>

</body>

</html>