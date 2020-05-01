<?php
		
	function sendFileStream( $path , $file ){
		
	  global $HTTP_SERVER_VARS, $HTTP_ENV_VARS;
	
	  $download_file = $path . '/' . $file;
	  
	  if( ( $download_file == '' ) || !file_exists( $download_file ) ){
	  	
	    header("HTTP/1.1 404 Not Found");
	    return false;
	    
	  } 
    
	  $fdate = gmdate( "D, d M Y H:i:s" , filemtime( $download_file ) );
	  $size  = filesize( $download_file );
	  $start = 0;
	  $end   = $size-1;
	  $range = '';
	
	  if( isset( $_SERVER['HTTP_RANGE'] ) ){
	  	
	  	$range = $_SERVER['HTTP_RANGE'];
	  	
	  }
	  else if( isset( $HTTP_SERVER_VARS['HTTP_RANGE'] ) ){
	  	
	  	$range = $HTTP_SERVER_VARS['HTTP_RANGE'];
	  	
	  }
	  else if( isset( $_ENV['HTTP_RANGE'] ) ){
	  	
	  	$range = $_ENV['HTTP_RANGE'];
	  	
	  }
	  else if( isset( $HTTP_ENV_VARS['HTTP_RANGE'] ) ){
	  	
	  	$range = $HTTP_ENV_VARS['HTTP_RANGE'];
	  	
	  }
	
	  if( ( $range != '' ) && preg_match( '/^bytes=(\d+)-(\d*)/' , $range , $matches ) ){
	  	
	    $start = $matches[1];
	    $end = ( $matches[2] ) ? $matches[2] : $end;
	    
	  }
	
	  if( ( $start > $end ) || ( $start >= $size ) ){
	  	
	    header("HTTP/1.1 416 Requested Range Not Satisfiable");
	    header("Content-Length: 0");
	    header("Last-Modified: $fdate");
	    return false;
	    
	  }
	
	  if( !( $fp = @fopen( $download_file , "r" ) ) ){
	  	
	    header("HTTP/1.1 404 Not Found");
	    return false;
	    
	  }
	
	  if( ( $start == 0 ) && ( $end == $size-1 ) ){
	  	
	    header("HTTP/1.1 200 OK");
	    
	  }
	  else{
	  	
	    header("HTTP/1.1 206 Partial Content");
	    header("Content-Range: $start-$end/$size");
	    
	  }
	
	  $left = $end - $start + 1;
	
	  header('Content-Disposition: attachment; filename="' . $file . '"');
	  header("Cache-Control: public");
	  header("Last-Modified: " . $fdate);
	  header("Expires: " . gmdate( "D, d M Y H:i:s" , time()+31536000 ) );
	  header("Content-type: application/octet-stream");
	  header("Accept-Ranges: bytes");
	  header("Content-Length: $left");
	
	  @fseek( $fp , $start );
	  
	  while( $left > 0 ){
	  	
	    $bytes = ( $left > 8192 ) ? 8192 : $left;
	    echo @fread( $fp , $bytes );
	    $left -= $bytes;
	  }
	  
	  @fclose( $fp );
	  
	} 	
	
?>