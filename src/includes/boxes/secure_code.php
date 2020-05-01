<?php	

	$size_x = 170;
	$size_y = 50;
	
	$charArray = array( "a" , "b" , "c" , "d" , "e" , "g" , "k" , "m" , "n" , "p" , "q" , "s" , "u" , "v" , "w" , "x" , "y" , "z" ,
						"A" , "B" , "C" , "D" , "E" , "F" , "G" , "H" , "I" , "J" , "K" , "M" , "N" , "P" , "Q" , "R" , "S" , "T" , "U" , "V" , "W" , "X" , "Y" , "Z" ,
						"1" , "2" , "3" , "4" , "5" , "6" , "7" , "8" , "9" );
						
	$code = "";
	for( $i = 0 ; $i < 5 ; $i++ ){
		
		$code .= $charArray[ rand( 0 , sizeof( $charArray ) - 1 ) ];
		
	}
	
	setcookie( "sc" , base64_encode( md5( strtolower( $code ) ) ) , time() + 5*60 , "/" );
	$space_per_char = $size_x / ( strlen( $code ) + 1 );
	
	$image = imagecreatetruecolor( $size_x , $size_y );
	
	/////////////// Allocate Colors ///////////////
	
	$background = imagecolorallocate( $image , 255 , 255 , 245 );
	$border = imagecolorallocate( $image , 128 , 128 , 128 );
	
	$colors[] = imagecolorallocate( $image , 50 , 100 , 150 );
	$colors[] = imagecolorallocate( $image , 150 , 50 , 100 );
	$colors[] = imagecolorallocate( $image , 100 , 150 , 50 );
	
	/////////////// Fill Background ///////////////
	
	imagefilledrectangle( $image , 1 , 1 , $size_x - 2  , $size_y - 2 , $background );
	
	/////////////// Draw Text ///////////////
	
	for( $i = 0 ; $i < strlen( $code ) ; $i++ ){
		
		$color = $colors[ $i % count( $colors ) ];
		imagestring( $image , 5 , ( $i + 0.7 ) * $space_per_char , 15 + rand( 0 , 10 ) , $code{$i} , $color );
		/*imagefttext(
					$image ,
					  30 - rand( 0 , 8 ) ,
					  -20 + rand( 0 , 40 ) ,
					  ( $i + 0.3 ) * $space_per_char ,
					  30 + rand( 0 , 10 ) ,
					  $color ,
					  "Arial.ttf" ,
					  $code{$i}	
		);*/
		/*imagettftext(
					  $image ,
					  30 - rand( 0 , 8 ) ,
					  -20 + rand( 0 , 40 ) ,
					  ( $i + 0.3 ) * $space_per_char ,
					  30 + rand( 0 , 10 ) ,
					  $color ,
					  "Arial.ttf" ,
					  $code{$i}					   
		);*/
		
	}
	
	/////////////// Adding some random Distortions ///////////////
	
	imageantialias( $image , true );
	
	/*for( $i = 0 ; $i < 500 ; $i++ ){
		
		$x1 = rand( 5 , $size_x - 5 );
		$y1 = rand( 5 , $size_y - 5 );
		$x2 = $x1 - 4 + rand( 0 , 8 );
		$y2 = $y1 - 4 + rand( 0 , 8 );
		 
		imageline( $image , $x1 , $y1 , $x2 , $y2 , $colors[ rand( 0 , count( $colors ) - 1 ) ] );
		
	}*/
	
	/////////////// Output to Browser ///////////////
	
	header("content-type: image/jpeg");
	imagejpeg( $image );
	imagedestroy( $image );

?>