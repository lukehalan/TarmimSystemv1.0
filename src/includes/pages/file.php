<table cellpadding="0" cellspacing="0" border="0" align="center" width="500" class="main">

	<tr>	
	  <td id="loading" valign="top" align="left" height="15"></td>	  
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
	  <td id="loading" valign="top" align="left" height="15"></td>	  
	</tr>
		
</table>