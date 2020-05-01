<?php

		
	/////////////// Set Cookie ///////////////
	
	function set_cookie( $name , $value , $expires = null , $path = "/" , $domain = null , $secure = null ){
		
		/*if( $name == "si" ){
			
			$domain = ".aryateams.com";
			
		}*/
		
		if( @setcookie( $name , $value , $expires , $path , $domain , $secure )){
			
			return true;
			
		}
		else{
			
			return false;
			
		}
		
	}		
	
?>