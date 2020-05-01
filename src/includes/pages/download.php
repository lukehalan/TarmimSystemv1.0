<table cellpadding="0" cellspacing="0" border="0" align="center" width="500" class="main">

	<tr>	
	  <td id="loading" valign="top" align="left" height="15"></td>	  
	</tr>
	
	<tr>
		<td align="right" dir="rtl" class="blue" style="padding-right:22px;">
			<img align="absmiddle" border='0' src='images/arrow-left.jpg' width='15' /> سیستم ترمیم فایل آریا 
			<img align="absmiddle" border='0' src='images/arrow-left.jpg' width='15' /> دانلود های در دسترس			
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
	
	<?php
		
		for( $i = 0 ; $i < sizeof( $dateArray ) ; $i++ ){
			
			$line = 0;
			
			if( $dateArray[$i] ){
				
				$day = substr( $dateArray[$i] , 0 , 4 ) . " / " . substr( $dateArray[$i] , 4 , 2 ) . " / " . substr( $dateArray[$i] , 6 , 2 );
	
	?>
	
	<tr>	
	  <td valign="middle" height="50">
	  	<div style="padding-right:22px; " class="header" dir="rtl"><img src="images/pointer_title.gif" alt="" />دانلود های <span dir="ltr"><?php echo $day; ?></span></div>
		</td>	  
	</tr>
		
	<tr>
		<td>

			<table cellpadding="1" cellspacing="1" border="0" align="center" class="main">
				
			<?php
			
				if( $dh = @opendir( DOWNLOAD_PATH . "/$dateArray[$i]" ) ){

					while( ( $file = @readdir( $dh ) ) !== false ){
						
						if( $file != "." && $file != ".." && $file != ".htaccess" && $file != "index.html" ){

							$line++;
							
										
			?>
			
				<tr>
				
					<td align="right" valign="top" width="50">	
						<?php echo number_format( ceil( filesize(DOWNLOAD_PATH."/$dateArray[$i]/$file") / 1024 ) ); ?> KB
					</td>
					<td align="right" valign="top" width="350">	
						<strong><a target="_blank" href="file.php?date=<?php echo base64_encode( $dateArray[$i] ); ?>&file=<?php echo base64_encode( $file ); ?>" class="blue"><?php echo $file; ?></a></strong>
					</td>
					<td align="right" dir="rtl" valign="middle" width="50" class="main">
						<?php echo $line; ?>
					</td>
				</tr>
				
			<?php
			
						}
						
					}
					
				}
			
			?>
							
			</table>
		
		</td>
	</tr>

	<?php
	
			}
			
		}
	
	?>
		
	<tr>	
	  <td valign="middle" height="50">
	  	<div style="padding-right:22px; " class="header" dir="rtl">&nbsp;</div>
		</td>	  
	</tr>
		
</table>