<table cellpadding="0" cellspacing="0" border="0" align="center" width="500">

	<tr>	
	  <td id="loading" valign="top" align="left" height="15"></td>	  
	</tr>
	
	<tr>
		<td align="right" dir="rtl" class="blue" style="padding-right:22px;">
			<img align="absmiddle" border='0' src='images/arrow-left.jpg' width='15' /> سیستم ترمیم فایل آریا 
			<img align="absmiddle" border='0' src='images/arrow-left.jpg' width='15' /> ویرایش کاربران
		</td>
	</tr>
		
	<tr>
		<td>
		<?php
		
			/////////////// Error Form ///////////////
			
			if( !empty( $errorArray ) ){
			
				echo "<table align='center' border='0' cellpadding='0' cellspacing='0' width='452' >";
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
				foreach( $errorArray as $index => $error ){
							
					echo "<tr>";
					echo "<td>";		
					echo "<div align='justify' class='formerror' dir='rtl'> $error </div>";
					echo "</td>";
					echo "<td align='right' width='10' valign='bottom'>";
					echo "<img align='right' border='0' src='images/pointer_red.gif' >";
					echo "</td>";
					echo "</tr>";
					
				}
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
				echo "</table>";
	
			}	
			
			/////////////// Success Form ///////////////
			
			if( !empty( $successArray ) ){
			
				echo "<table align='center' border='0' cellpadding='0' cellspacing='0' width='452' >";
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
				foreach( $successArray as $index => $success ){
							
					echo "<tr>";
					echo "<td>";		
					echo "<div align='justify' class='formsuccess' dir='rtl'> $success </div>";
					echo "</td>";
					echo "<td align='right' width='10' valign='bottom'>";
					echo "<img align='right' border='0' src='images/pointer_title.gif' >";
					echo "</td>";
					echo "</tr>";
					
				}
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
				echo "</table>";
	
			}				
		
		?>		
		</td>
	</tr>
		
	<tr>	
	  <td valign="middle" height="50">
	  	<div style="padding-right:22px; " class="header3" dir="rtl">&nbsp;</div>
		</td>	  
	</tr>	
	
	<tr>
		<td>
		
		<form method="POST" action="edit_user_all.php">
		
			<table cellpadding="1" cellspacing="1" border="0" align="center">

				<tr>
					<td align="right" valign="top" width="300">
						<input name='max_daily_login' type='text' class='<?php echo $errorArray["max_daily_login"] ? "textfield-wrong" : "textfield" ?>' maxlength='20' tabindex='1' value='<?php echo $inputNumArray["max_daily_login"]; ?>' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						<img src="images/pointer.gif" alt="" />بیشینه ورود روزانه
					</td>
				</tr>				

				<tr>
					<td align="right" valign="top" width="300">
						<input name='max_monthly_login' type='text' class='<?php echo $errorArray["max_monthly_login"] ? "textfield-wrong" : "textfield" ?>' maxlength='20' tabindex='2' value='<?php echo $inputNumArray["max_monthly_login"]; ?>' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						<img src="images/pointer.gif" alt="" />بیشینه ورود ماهانه
					</td>
				</tr>
					
				<tr>
					<td align="right" valign="bottom" width="300" height="30">	
						<input name='submit' type='submit' class='green' tabindex='4' value='ویرایش' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
					</td>
				</tr>	
								
			</table>

		</form>
		
		</td>
	</tr>

	<tr>
		<td align="center" class="title" height="30" valign="middle">
			<img align="absmiddle" border='0' src='images/line.gif' />	
		</td>
	</tr>
		
	<tr>
		<td>
		
		<form method="POST" action="edit_user_all.php">
		
			<table cellpadding="1" cellspacing="1" border="0" align="center">
				
				<tr>
					<td align="right" valign="top" width="300" class="main">
						<select class='<?php echo $errorArray["date1"] ? "select-wrong" : "select" ?>' dir='rtl' name='date1_day' tabindex='5' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >روز</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = 1 ; $i <= 31 ; $i++ ){
									
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $inputStrArray["date1"] , 8 , 2 ) == $i ? "selected='selected'" : "" ) . ">$i</option>";													
									
								}							
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>	
						&nbsp;/&nbsp;
						<select class='<?php echo $errorArray["date1"] ? "select-wrong" : "select" ?>' dir='rtl' name='date1_month' tabindex='6' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >ماه</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = 1 ; $i <= 12 ; $i++ ){
									
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $inputStrArray["date1"] , 5 , 2 ) == $i ? "selected='selected'" : "" ) . ">$monthArray[$i]</option>";												
									
								}
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>
						&nbsp;/&nbsp;
						<select class='<?php echo $errorArray["date1"] ? "select-wrong" : "select" ?>' dir='rtl' name='date1_year' tabindex='7' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >سال</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = substr( sunDate(3) , 0 , 4 ) + 1 ; $i >= substr( sunDate(3) , 0 , 4 ) - 1 ; $i-- ){
			
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $inputStrArray["date1"] , 0 , 4 ) == $i ? "selected='selected'" : "" ) . ">$i</option>";
								}
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>								
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">						
						<img src="images/pointer.gif" alt="" />افزودن روز دانلود			
					</td>
				</tr>

				<tr>
					<td align="right" valign="bottom" width="300" height="30">	
						<input name='submit1' type='submit' class='green' tabindex='8' value='افزودن' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
					</td>
				</tr>
								
			</table>

		</form>
		
		</td>
	</tr>

	<tr>
		<td align="center" class="title" height="30" valign="middle">
			<img align="absmiddle" border='0' src='images/line.gif' />	
		</td>
	</tr>
		
	<tr>
		<td>
		
		<form method="POST" action="edit_user_all.php">
		
			<table cellpadding="1" cellspacing="1" border="0" align="center">
				
				<tr>
					<td align="right" valign="top" width="300" class="main">
						<select class='<?php echo $errorArray["date2"] ? "select-wrong" : "select" ?>' dir='rtl' name='date2_day' tabindex='9' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >روز</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = 1 ; $i <= 31 ; $i++ ){
									
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $inputStrArray["date2"] , 8 , 2 ) == $i ? "selected='selected'" : "" ) . ">$i</option>";													
									
								}							
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>	
						&nbsp;/&nbsp;
						<select class='<?php echo $errorArray["date2"] ? "select-wrong" : "select" ?>' dir='rtl' name='date2_month' tabindex='10' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >ماه</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = 1 ; $i <= 12 ; $i++ ){
									
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $inputStrArray["date2"] , 5 , 2 ) == $i ? "selected='selected'" : "" ) . ">$monthArray[$i]</option>";												
									
								}
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>
						&nbsp;/&nbsp;
						<select class='<?php echo $errorArray["date2"] ? "select-wrong" : "select" ?>' dir='rtl' name='date2_year' tabindex='11' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >سال</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = substr( sunDate(3) , 0 , 4 ) + 1 ; $i >= substr( sunDate(3) , 0 , 4 ) - 1 ; $i-- ){
			
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $inputStrArray["date2"] , 0 , 4 ) == $i ? "selected='selected'" : "" ) . ">$i</option>";
								}
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>								
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">						
						<img src="images/pointer.gif" alt="" />کاستن روز دانلود			
					</td>
				</tr>

				<tr>
					<td align="right" valign="bottom" width="300" height="30">	
						<input name='submit2' type='submit' class='green' tabindex='12' value='کاستن' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
					</td>
				</tr>
								
			</table>

		</form>
		
		</td>
	</tr>
		
	<tr>
		<td align="center" class="title" height="30" valign="middle">
			<img align="absmiddle" border='0' src='images/line.gif' />	
		</td>
	</tr>
		
	<tr>
		<td>
		
			<table cellpadding="1" cellspacing="1" border="0" align="center">

				<tr>
					<td align="right" valign="bottom" width="300" height="30">	
						[ <a href="javascript:getConfirm1('همه روز ها حذف خواهد شد !\nآیا می خواهید ادامه دهید ؟','edit_user_all.php?action=delete&date=all');" class="submenu">حذف همه روز ها</a> ]
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						
					</td>
				</tr>
											
			</table>
		
		</td>
	</tr>
	
	<tr>	
	  <td valign="middle" height="50">
	  	<div style="padding-right:22px; " class="header3" dir="rtl">&nbsp;</div>
		</td>	  
	</tr>	
		
</table>