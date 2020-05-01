<form method="GET" action="edit_user.php">

<table cellpadding="0" cellspacing="0" border="0" align="center" width="500">

	<tr>	
	  <td id="loading" valign="top" align="left" height="15"></td>	  
	</tr>
	
	<tr>
		<td align="right" dir="rtl" class="blue" style="padding-right:22px;">
			<img align="absmiddle" border='0' src='images/arrow-left.jpg' width='15' /> سیستم ترمیم فایل آریا 
			<img align="absmiddle" border='0' src='images/arrow-left.jpg' width='15' /> ویرایش کاربر
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
		<td align="center" class="title" height="30" valign="middle">
			<img align="absmiddle" border='0' src='images/line.gif' />	
		</td>
	</tr>
	
	<tr>
		<td>
		
			<table cellpadding="1" cellspacing="1" border="0" align="center">

				<tr>
					<td align="right" valign="top" width="350">				
						<input name='username' type='text' class='textfield' maxlength='50' tabindex='1' value='<?php echo $set["username"]; ?>' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
						<img src="images/pointer.gif" alt="" />کاربر
					</td>
				</tr>
					
				<tr>
					<td align="right" valign="top" width="350" class="main">
						<select class='select' dir='rtl' name='status' tabindex='2'>
							<?php	

								echo "<option class='main' dir='rtl' value='both' " . ( $set["status"] == 'both' ? "selected='selected'" : "" ) . ">تمام کاربران</option>";								
								echo "<option class='main' dir='rtl' disabled='disabled' > </option>";
								echo "<option class='main' dir='rtl' value='block' " . ( $set["status"] == 'block' ? "selected='selected'" : "" ) . ">کاربران مسدود</option>";
								echo "<option class='main' dir='rtl' value='unblock' " . ( $set["status"] == 'unblock' ? "selected='selected'" : "" ) . ">کاربران غیر مسدود</option>";	
								echo "<option class='main' dir='rtl' disabled='disabled' > </option>";
								
							?>
						</select>														
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
						<img src="images/pointer.gif" alt="" />وضعیت
					</td>
				</tr>
										
				<tr>
					<td align="right" valign="top" width="350" class="main">
						<select class='select' dir='rtl' name='startdate_day' tabindex='3' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >روز</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = 1 ; $i <= 31 ; $i++ ){
									
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $set["startdate"] , 8 , 2 ) == $i ? "selected='selected'" : "" ) . ">$i</option>";													
									
								}							
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>	
						&nbsp;/&nbsp;
						<select class='select' dir='rtl' name='startdate_month' tabindex='4' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >ماه</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = 1 ; $i <= 12 ; $i++ ){
									
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $set["startdate"] , 5 , 2 ) == $i ? "selected='selected'" : "" ) . ">$monthArray[$i]</option>";												
									
								}
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>
						&nbsp;/&nbsp;
						<select class='select' dir='rtl' name='startdate_year' tabindex='5' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >سال</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = substr( $enddate , 0 , 4 ) ; $i >= substr( $startdate , 0 , 4 ) ; $i-- ){
			
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $set["startdate"] , 0 , 4 ) == $i ? "selected='selected'" : "" ) . ">$i</option>";
								}
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>								
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">						
						<img src="images/pointer.gif" alt="" />آخرین ورود
						<span class="special">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;از : </span>						
					</td>
				</tr>

				<tr>
					<td align="right" valign="top" width="350" class="main">											
						<select class='select' dir='rtl' name='enddate_day' tabindex='6' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >روز</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = 1 ; $i <= 31 ; $i++ ){
									
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $set["enddate"] , 8 , 2 ) == $i ? "selected='selected'" : "" ) . ">$i</option>";													
									
								}							
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>	
						&nbsp;/&nbsp;
						<select class='select' dir='rtl' name='enddate_month' tabindex='7' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >ماه</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = 1 ; $i <= 12 ; $i++ ){
									
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $set["enddate"] , 5 , 2 ) == $i ? "selected='selected'" : "" ) . ">$monthArray[$i]</option>";												
									
								}
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>
						&nbsp;/&nbsp;
						<select class='select' dir='rtl' name='enddate_year' tabindex='8' >
							<option class='green' dir='rtl' disabled='disabled' selected='selected' value='' >سال</option>
							<option class='main' dir='rtl' disabled='disabled'> </option>
							<?php	
						
								for( $i = substr( $enddate , 0 , 4 ) ; $i >= substr( $startdate , 0 , 4 ) ; $i-- ){
			
									echo "<option class='main' dir='rtl'  value='$i' " . ( substr( $set["enddate"] , 0 , 4 ) == $i ? "selected='selected'" : "" ) . ">$i</option>";
								}
								
							?>
							<option class='main' dir='rtl' disabled='disabled'> </option>
						</select>							
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
						<span class="special">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;تا : </span>
					</td>
				</tr>							
				
				<tr>
					<td align="right" valign="bottom" width="350" height="30">	
						<input name='submit' type='submit' class='green' tabindex='9' value='نمایش کاربران' />
					</td>
					<td align="right" dir="rtl" valign="middle" width="100" class="main">
					</td>
				</tr>	
								
			</table>

		</td>
	</tr>
		
	<tr>
		<td align="center" class="title" height="30" valign="middle">
			<img align="absmiddle" border='0' src='images/line.gif' />	
		</td>
	</tr>

	<tr>
		<td align="center" class="title">
		<?php 
			
			if( $countRecord ){
				
				echo "یافته های " . ( $set["page"] * 5 - 4 ) . " تا " . ( $countRecord - ( $set["page"] - 1 ) *  5 < 5 ? $countRecord : $set["page"] * 5 ) . " از حدود " . $countRecord . " یافته"; 

			}
			else{
				
				echo "رکوردی برای نمایش یافت نشد";
				
			}
		?>			
		</td>
	</tr>
		
	<tr>
		<td>
		<?php 
		
			while( $row = $database->fetch_object( $result["search"] ) ){		

				$dateArray = explode( ";" , $row->active_date );
				
		?>

			<table cellpadding="2" cellspacing="3" border="0"  align="center" width="400" dir="ltr" style="line-height:15px; ">

				<tr>
					<td height="30"></td>
				</tr>
							
          		<tr>
            		<td valign="middle">                        			
						<div class="green" dir="rtl">
							<strong dir="ltr"><?php echo $row->username; ?></strong>
						</div>
						<br>
						<div align="justify" dir="rtl" class="main">
							<span  class="special">وضعیت : </span>
							<strong>
							<?php 
							
								if( $row->block == "yes" ){
									
									echo "مسدود";
									
								}							
								else if( $row->block == "no" ){
									
									echo "غیر مسدود";
									
								}																
							
							?>
							</strong>
							<br>						
							<span  class="special">زمان آخرین ورود : </span><span dir="ltr"><?php echo $row->last_login_date; ?> :: <?php echo $row->last_login_clock; ?></span> 
							<br>
							<span  class="special">نشان اینترنتی : </span><span dir="ltr"><?php echo $row->last_login_ip; ?></span> 
							<br>
							<span  class="special">میزبان : </span><span dir="ltr"><?php echo $row->last_login_host; ?></span> 
							<br>
							<span  class="special">بیشینه ورود روزانه : </span><span dir="ltr"><?php echo number_format( $row->max_daily_login ); ?></span>
							<br>
							<span  class="special">بیشینه ورود ماهانه : </span><span dir="ltr"><?php echo number_format( $row->max_monthly_login ); ?></span>
							<br>
							<span  class="special">شمار ورود در آخرین روز  ورود : </span><span dir="ltr"><?php echo number_format( $row->max_daily_login - $row->allow_daily_login ); ?></span>
							<br>
							<span  class="special">شمار ورود در آخرین ماه ورود : </span><span dir="ltr"><?php echo number_format( $row->max_monthly_login - $row->allow_monthly_login ); ?></span>
							<br>
							<span  class="special">اجازه دانلود در روز های : </span><span dir="ltr">
							<?php  
							
								$day = "";
							
								for( $i = 0 ; $i < sizeof( $dateArray ) ; $i++ ){
																	
									if( $dateArray[$i] ){
										
										$day .= "<strong>" . substr( $dateArray[$i] , 0 , 4 ) . " / " . substr( $dateArray[$i] , 4 , 2 ) . " / " . substr( $dateArray[$i] , 6 , 2 ) . "</strong> , ";	
										
									}
									
								}						
							
								echo substr( $day , 0 , strlen( $day ) - 3 );
								
							?>
							</span>
						</div>
						<div align="justify" dir="rtl" class="main">
							<br>
							[ <a href="edit_user_info.php?username=<?php echo $row->username; ?>" class="submenu" target="_blank">ویرایش</a> ]
							<?php
							
								if( $row->username != "admin" ){
							
							?>		
							&nbsp;
							[ <a href="javascript:getConfirm1('کاربر مورد نظر حذف خواهد شد !\nآیا می خواهید ادامه دهید ؟','edit_user.php?<?php echo $url . "&action=delete&user=$row->username"; ?>');" class="submenu">حذف</a> ]	
							<?php
							
								}
							
							?>																				
            			</div>             			           			
					</td>
          		</tr>        		
          		
        	</table>
        	
		<?php 
		
			}
			
			$database->free_result( $result["search"] );
			$database->close_db();

		?>				
		</td>		
	</tr>

	<tr>
		<td valign="top" height="30"></td>
	</tr>
	
	<tr>
		<td>
			<table align="center" border="0" cellpadding="2" cellspacing="3" >
			
				<tr>
				<?php 
				
					if( $set["page"] - 1 >= 1 ){
						
						echo "<td><a class='main' href=\"edit_user.php?" . str_replace( "page=".$set["page"] , "page=".($set["page"]-1) , $url ) . "\" ><img alt='برگ پیشین' border='0' class='main' src='images/btnLeft.png' title='برگ پیشین' ></a></td>";
						
					}
				
					for( $i = $start ; $i <= $end ; $i++ ){
						
						if( $set["page"] == $i ){
							
							echo "<td class='title'>$i</td>";
							
						}
						else{
							
							echo "<td valign='bottom'><a class='main' href=\"edit_user.php?" . str_replace( "page=".$set["page"] , "page=$i" , $url ) . "\" title='$i' >$i</a></td>";
							
						}
						
					}
					
					if( $set["page"] + 1 <= ( $countRecord + 4 ) / 5 ){
						
						echo "<td><a class='main' href=\"edit_user.php?" . str_replace( "page=".$set["page"] , "page=".($set["page"]+1) , $url ) . "\" ><img alt='برگ پسین' border='0' class='title' src='images/btnRight.png' title='برگ پسین' ></a></td>";
						
					}
										
				?>		
				</tr>	

			</table>
		</td>		
	</tr>
		
</table>

</form>