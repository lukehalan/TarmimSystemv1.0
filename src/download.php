<?php 
	
	include("includes/include_main.php");
	include("includes/modules/show_no_attack.php");	
	include("includes/modules/check_main_login.php");	
	
	/////////////// connect database ///////////////
	
	$database = new MySQL( DB_ARYA , DB_ARYA_USER_SUPER , DB_ARYA_PASSWORD_SUPER , MYSQL_SERVER_1 );
	$database->connect();

	/////////////// get info ///////////////
	
	$str = "SELECT active_date,block FROM " . DB_ARYA_USER_TBL_USER . " WHERE username = '" . $rowUser["username"] . "'";
	$res = $database->query( $str );
	$rowAccount = $database->fetch_object( $res );
	$database->free_result( $res );	
	
	$dateArray = explode( ";" , $rowAccount->active_date );
	
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
			<td id="main"><?php include("includes/pages/download.php"); ?></td>
		</tr>

		<tr>	
			<td id="bottom"><?php include("includes/boxes/bottom.php"); ?></td>
		</tr>			
		
	</table>

</body>

</html>