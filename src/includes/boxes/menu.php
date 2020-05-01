<table cellpadding="0" cellspacing="0" border="0" dir="rtl">

	<tr>
		<td valign="middle" width="700" align="center" height="30">
			
		<?php 
		
			if( $rowUser["username"] == "admin" ){ 
				
		?>
			
			<a href="download.php" class="red">دانلود</a>
			&nbsp;|&nbsp;		
			<a href="new_user.php" class="red">تعریف کاربر</a>
			&nbsp;|&nbsp;			
			<a href="edit_user_all.php" class="red">ویرایش کاربران</a>
			&nbsp;|&nbsp;			
			<a href="edit_user.php" class="red">ویرایش کاربر</a>
			&nbsp;|&nbsp;
						

		<?php 
		
			}
			  	
		?>
		
			<a href="logout.php" class="red">خروج</a>
							
		</td>
	</tr>
		
</table>