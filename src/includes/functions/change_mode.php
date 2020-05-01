<?php

		
	/////////////// Change Mode ///////////////
	
	function changeMode( $dir , $file , $mode ){
		
		if( !$dh = @opendir( $dir ) ){

			return;
			
		}
		else{
			
			if( @chmod( $dir.'/'.$file , $mode ) ){
				
				return true;
				
			}
			else{
				
				return false;
				
			}
			
		}
	
	}		
	
?>