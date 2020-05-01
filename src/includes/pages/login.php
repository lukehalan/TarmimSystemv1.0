<form method="POST" action="index.php">

<table cellpadding="0" cellspacing="0" border="0" align="center" width="500">

	<tr>	
	  <td id="loading" valign="top" align="left" height="15"></td>	  
	</tr>
	
	<tr>
		<td align="right" dir="rtl" class="blue" style="padding-right:22px;">
			<img align="absmiddle" border='0' src='images/arrow-left.jpg' width='15' /> سیستم ترمیم فایل آریا 
			<img align="absmiddle" border='0' src='images/arrow-left.jpg' width='15' /> ورود به سایت			
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
						<input name='username' type='text' class='<?php echo $errorArray["username"] ? "textfield-wrong" : "textfield" ?>' maxlength='50' tabindex='1' value='' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
						<img src="images/pointer.gif" alt="" />نام کاربری *
					</td>
				</tr>
				
				<tr>
					<td align="right" valign="top" width="350">	
						<input name='password' type='password' class='<?php echo $errorArray["password"] ? "textfield-wrong" : "textfield" ?>' maxlength='100' tabindex='2' value='' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
						<img src="images/pointer.gif" alt="" />رمز عبور *
					</td>
				</tr>

				<tr>
					<td align="right" valign="top" width="350" height="50">	
						<a href="javascript:scureCode('securecode');" class="secure" title="برای تغییر کد امنیتی کلیک نمایید">
							<img alt="کد امنیتی" border="0" id="securecode" src='<?php echo "includes/boxes/secure_code.php?rand=" . time() ; ?>' title='برای تغییر کد امنیتی کلیک نمایید' onclick="javascript:secureCode(this.id);">
						</a>
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
					</td>
				</tr>
								
				<tr>
					<td align="right" valign="top" width="350">	
						<input name='securecode' type='text' class='<?php echo $errorArray["securecode"] ? "secure-textfield-wrong" : "secure-textfield" ?>' maxlength='5' tabindex='3' value='' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
						<img src="images/pointer.gif" alt="" />کد امنیتی *
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
						<input name='submit' type='submit' class='green' tabindex='4' value='ورود به سایت' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
					</td>
				</tr>						
				
			</table>

		</td>
	</tr>
		
</table>

</form>