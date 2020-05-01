<table cellpadding="0" cellspacing="0" border="0" align="center" width="500">

	<tr>	
	  <td id="loading" valign="top" align="left" height="15"></td>	  
	</tr>
	
	<tr>
		<td align="right" dir="rtl" class="blue" style="padding-right:22px;">
			<img align="absmiddle" border='0' src='images/arrow-left.jpg' width='15' /> سیستم ترمیم فایل آریا 
			<img align="absmiddle" border='0' src='images/arrow-left.jpg' width='15' /> ویرایش اطلاعات کاربر
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
		
		<form method="POST" action="edit_user_info.php?username=<?php echo $username; ?>">
		
			<table cellpadding="1" cellspacing="1" border="0" align="center">

				<tr>
					<td align="right" valign="top" width="300" class="blue">				
						<strong><?php echo $rowInfo->username; ?></strong>
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						<img src="images/pointer.gif" alt="" />نام کاربری
					</td>
				</tr>

				<tr>
					<td align="right" valign="top" width="300" class="blue">				
						<span dir="ltr"><?php echo $rowInfo->last_login_date; ?> :: <?php echo $rowInfo->last_login_clock; ?></span>
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						<img src="images/pointer.gif" alt="" />زمان آخرین ورود
					</td>
				</tr>

				<tr>
					<td align="right" valign="top" width="300" class="blue">				
						<span dir="ltr"><?php echo $rowInfo->last_login_ip; ?></span>
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						<img src="images/pointer.gif" alt="" />نشان اینترتنی
					</td>
				</tr>

				<tr>
					<td align="right" valign="top" width="300" class="blue">				
						<span dir="ltr"><?php echo $rowInfo->last_login_host; ?></span>
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						<img src="images/pointer.gif" alt="" />میزبان
					</td>
				</tr>

				<tr>
					<td align="right" valign="top" width="300" class="blue">				
						<span dir="ltr"><?php echo number_format( $rowInfo->max_daily_login - $rowInfo->allow_daily_login ); ?></span>
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						<img src="images/pointer.gif" alt="" />شمار ورود در آخرین روز  ورود
					</td>
				</tr>

				<tr>
					<td align="right" valign="top" width="300" class="blue">				
						<span dir="ltr"><?php echo number_format( $rowInfo->max_monthly_login - $rowInfo->allow_monthly_login ); ?></span>
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						<img src="images/pointer.gif" alt="" />شمار ورود در آخرین ماه ورود
					</td>
				</tr>

				<tr>
					<td align="right" valign="top" width="300">	
						<input name='password1' type='password' class='<?php echo $errorArray["password"] ? "textfield-wrong" : "textfield" ?>' maxlength='100' tabindex='1' value='' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						<img src="images/pointer.gif" alt="" />رمز عبور
					</td>
				</tr>
				
				<tr>
					<td align="right" valign="top" width="300">	
						<input name='password2' type='password' class='<?php echo $errorArray["password"] ? "textfield-wrong" : "textfield" ?>' maxlength='100' tabindex='2' value='' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						<img src="images/pointer.gif" alt="" />تکرار رمز عبور
					</td>
				</tr>
								
				<tr>
					<td align="right" valign="top" width="300">
						<input name='max_daily_login' type='text' class='<?php echo $errorArray["max_daily_login"] ? "textfield-wrong" : "textfield" ?>' maxlength='20' tabindex='3' value='<?php echo $inputNumArray["max_daily_login"]; ?>' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						<img src="images/pointer.gif" alt="" />بیشینه ورود روزانه
					</td>
				</tr>				

				<tr>
					<td align="right" valign="top" width="300">
						<input name='max_monthly_login' type='text' class='<?php echo $errorArray["max_monthly_login"] ? "textfield-wrong" : "textfield" ?>' maxlength='20' tabindex='4' value='<?php echo $inputNumArray["max_monthly_login"]; ?>' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						<img src="images/pointer.gif" alt="" />بیشینه ورود ماهانه
					</td>
				</tr>
											
				<tr>
					<td align="right" valign="top" width="300" class="main">
						<select class='select' dir='rtl' name='status' tabindex='5'>
							<?php	

								echo "<option class='main' dir='rtl' value='block' " . ( $rowInfo->block == 'yes' ? "selected='selected'" : "" ) . ">مسدود</option>";
								echo "<option class='main' dir='rtl' value='unblock' " . ( $rowInfo->block == 'no' ? "selected='selected'" : "" ) . ">غیر مسدود</option>";	
								
							?>
						</select>														
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						<img src="images/pointer.gif" alt="" />وضعیت کاربر
					</td>
				</tr>
										
				<tr>
					<td align="right" valign="bottom" width="300" height="30">	
						<input name='submit' type='submit' class='green' tabindex='6' value='ویرایش' />
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
		
		<form method="POST" action="edit_user_info.php?username=<?php echo $username; ?>">
		
			<table cellpadding="1" cellspacing="1" border="0" align="center">
				
				<tr>
					<td align="right" valign="top" width="300" class="main">
						<select class='<?php echo $errorArray["date"] ? "select-wrong" : "select" ?>' dir='rtl' name='date_day' tabindex='7' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >روز</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = 1 ; $i <= 31 ; $i++ ){
									
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $inputStrArray["date"] , 8 , 2 ) == $i ? "selected='selected'" : "" ) . ">$i</option>";													
									
								}							
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>	
						&nbsp;/&nbsp;
						<select class='<?php echo $errorArray["date"] ? "select-wrong" : "select" ?>' dir='rtl' name='date_month' tabindex='8' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >ماه</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = 1 ; $i <= 12 ; $i++ ){
									
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $inputStrArray["date"] , 5 , 2 ) == $i ? "selected='selected'" : "" ) . ">$monthArray[$i]</option>";												
									
								}
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>
						&nbsp;/&nbsp;
						<select class='<?php echo $errorArray["date"] ? "select-wrong" : "select" ?>' dir='rtl' name='date_year' tabindex='9' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >سال</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = substr( sunDate(3) , 0 , 4 ) + 1 ; $i >= substr( sunDate(3) , 0 , 4 ) - 1 ; $i-- ){
			
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $inputStrArray["date"] , 0 , 4 ) == $i ? "selected='selected'" : "" ) . ">$i</option>";
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
						<input name='submit1' type='submit' class='green' tabindex='10' value='افزودن' />
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
						[ <a href="javascript:getConfirm1('همه روز ها حذف خواهد شد !\nآیا می خواهید ادامه دهید ؟','edit_user_info.php?username=<?php echo $username; ?>&action=delete&date=all');" class="submenu">حذف همه روز ها</a> ]
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						اجازه دانلود در روز های
					</td>
				</tr>
				
				<tr>
					<td align="right" valign="bottom" width="300" height="30">	
						
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
						
					</td>
				</tr>
								
				<?php
				
					$dateArray = explode( ";" , $rowInfo->active_date );
				
					for( $i = 0 ; $i < sizeof( $dateArray ) ; $i++ ){
														
						if( $dateArray[$i] ){
							
							$day = "<strong>" . substr( $dateArray[$i] , 0 , 4 ) . " / " . substr( $dateArray[$i] , 4 , 2 ) . " / " . substr( $dateArray[$i] , 6 , 2 ) . "</strong> " . " [ <a href=\"javascript:getConfirm1('روز مورد نظر حذف خواهد شد !\nآیا می خواهید ادامه دهید ؟','edit_user_info.php?username=$username&action=delete&date=$dateArray[$i]');\" class=\"submenu\">حذف</a> ]";															
				
				?>
					
				<tr>
					<td align="right" valign="bottom" width="300" class="green">	
						<?php
						
							echo $day;
						
						?>
					</td>
					<td align="right" dir="rtl" valign="middle" width="150" class="main">
					</td>
				</tr>				

				<?php
				
						}
						
					}
				
				?>
											
			</table>
		
		</td>
	</tr>
	
	<tr>	
	  <td valign="middle" height="50">
	  	<div style="padding-right:22px; " class="header3" dir="rtl">&nbsp;</div>
		</td>	  
	</tr>	
		
</table>