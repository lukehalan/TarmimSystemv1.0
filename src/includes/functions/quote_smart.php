<?php

		
	/////////////// Quote Smart ///////////////
	
	function quote_smart( $value , $type ){
		
	    // Stripslashes
	    
	    if( get_magic_quotes_gpc() ){
	    	
	        $value = stripslashes( $value );
	        
	    }
	    
	    $value = str_replace( "ي" , "ی" , $value );
	    
	    // Quote if not integer
	    
	    if( $type == "string" ){
	    	
	        $value = "'" . mysql_escape_string( $value ) . "'";
	        
	    }
	    else if( $type == "order" ){
	    	
	        $value = mysql_escape_string( $value );
	        
	    }	    
	    else if( $type == "number" ){
	    	
	    	$value = mysql_escape_string( $value );
	    	
	    }
	    else{
	    	
	    	$value = "'" . mysql_escape_string( $value ) . "'";
	    	
	    }
	    
	    return $value;
	    
	}		
	
?>