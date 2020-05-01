<form method="POST" action="new_user.php">

<table cellpadding="0" cellspacing="0" border="0" align="center" width="500">

	<tr>	
	  <td id="loading" valign="top" align="left" height="15"></td>	  
	</tr>
	
	<tr>
		<td align="right" dir="rtl" class="blue" style="padding-right:22px;">
			<img align="absmiddle" border='0' src='images/arrow-left.jpg' width='15' /> سیستم ترمیم فایل آریا 
			<img align="absmiddle" border='0' src='images/arrow-left.jpg' width='15' /> تعریف کاربر جدید			
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
		
			<table cellpadding="1" cellspacing="1" border="0" align="center">
				
				<tr>
					<td align="right" valign="top" width="350">	
						<span class='blue'>( شامل حروف لاتین ، اعداد و نقطه )</span>
						<input name='username' type='text' class='<?php echo $errorArray["username"] ? "textfield-wrong" : "textfield"; ?>' maxlength='50' tabindex='1' value='<?php echo $inputStrArray["username"]; ?>' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
						<img src="images/pointer.gif" alt="" />نام کاربری *
					</td>
				</tr>							
				
				<tr>
					<td align="right" valign="top" width="350">
						<span class='blue'>( بیش از 6 حرف و کمتر از 100 حرف )</span>	
						<input name='password1' type='password' class='<?php echo $errorArray["password"] ? "textfield-wrong" : "textfield" ?>' maxlength='100' tabindex='2' value='' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
						<img src="images/pointer.gif" alt="" />رمز عبور *
					</td>
				</tr>
				
				<tr>
					<td align="right" valign="top" width="350">	
						<input name='password2' type='password' class='<?php echo $errorArray["password"] ? "textfield-wrong" : "textfield" ?>' maxlength='100' tabindex='3' value='' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
						<img src="images/pointer.gif" alt="" />تکرار رمز عبور *
					</td>
				</tr>
								
				<tr>
					<td align="right" valign="top" width="350">
						<input name='max_daily_login' type='text' class='<?php echo $errorArray["max_daily_login"] ? "textfield-wrong" : "textfield" ?>' maxlength='20' tabindex='4' value='<?php echo $inputNumArray["max_daily_login"]; ?>' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
						<img src="images/pointer.gif" alt="" />ورود روزانه *
					</td>
				</tr>				

				<tr>
					<td align="right" valign="top" width="350">
						<input name='max_monthly_login' type='text' class='<?php echo $errorArray["max_monthly_login"] ? "textfield-wrong" : "textfield" ?>' maxlength='20' tabindex='5' value='<?php echo $inputNumArray["max_monthly_login"]; ?>' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
						<img src="images/pointer.gif" alt="" />ورود ماهانه *
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
		
	<tr>
		<td>
		
			<table cellpadding="1" cellspacing="1" border="0" align="center" class="main">
									
				<tr>
					<td align="right" valign="bottom" width="350" height="30">
						<input name='reset' type='reset' class='green' tabindex='7' value='پاک کردن' />	
						<input name='submit' type='submit' class='green' tabindex='6' value='تعریف کاربر' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
					</td>
				</tr>						
				
			</table>

		</td>
	</tr>
		
</table>

</form>