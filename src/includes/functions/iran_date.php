<?php

	/////////////// taghsim e sahih ra bar migardanad ///////////////

	function div( $a , $b ){
		
	    return (int)( $a / $b );
	    
	}
	
	
	
	
	/////////////// tarikh khorshidi & saat be vaght e tehran ra bar migardanad ///////////////
	
	function sunDate( $format = 1 ){
		
		putenv("TZ=Europe/London");
		
	    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
	    
	    $month_names = array( "فروردین" , "اردیبهشت" , "خرداد" , "تیر" , "امرداد" , "شهریور" , "مهر" , "آبان" , "آذر" , "دی" , "بهمن" , "اسفند" );
	    $day_of_week_names = array(  "یکشنبه" , "دوشنبه" , "سه شنبه" , "چهارشنبه" , "پنجشنبه" , "آدینه" , "شنبه" );
	    
		$g_y = date("Y");
		$g_m = date("m");
	    $g_d = date("d");
	
	    $gy = $g_y - 1600;
	    $gm = $g_m - 1;
	    $gd = $g_d - 1;
	
	    $g_day_no = 365 * $gy + div( $gy + 3 , 4 ) - div( $gy + 99 , 100 ) + div( $gy + 399 , 400 );
	
	    for ( $i = 0 ; $i < $gm ; ++$i ){
	    	
	    	$g_day_no += $g_days_in_month[$i];
	    	
	    }
	    	
	    if ( $gm > 1 && ( ( $gy % 4 == 0 && $gy % 100 != 0 ) || ( $gy % 400 == 0 ) ) ){
	        /* leap and after Feb */
	        $g_day_no++;
	        
	    }
			
	    $g_day_no += $gd;
	
	    $j_day_no = $g_day_no - 79;
	
	    $j_np = div( $j_day_no , 12053 ); /* 12053 = 365*33 + 32/4 */
	    $j_day_no = $j_day_no % 12053;
	
	    $jy = 979 + 33 * $j_np + 4 * div( $j_day_no , 1461 ); /* 1461 = 365*4 + 4/4 */
	
	    $j_day_no %= 1461;
	
	    if( $j_day_no >= 366 ) {
	        $jy += div( $j_day_no - 1 , 365 );
	        $j_day_no = ( $j_day_no - 1 ) % 365;
	    }
	
	    for( $i = 0 ; $i < 11 && $j_day_no >= $j_days_in_month[$i] ; ++$i ){
	    	
	        $j_day_no -= $j_days_in_month[$i];
	        
	    }
			
	    $jm = $i + 1;
	    $jd = $j_day_no + 1;
		
		switch( $format ){	
			
			case 1 :
				
				$date_format = (string)$jy . " / " . (string)$jm . " / " . (string)$jd;
				break;
				
			case 2 :
			case 'full' :
				
				$date_format = $day_of_week_names[date("w")] . " " . $jd . " " . $month_names[$jm - 1] . " سال " . $jy . " هجری خورشیدی ";
				break;
				
			case 3 :
				
				$date_format = sprintf( "%04s" , $jy ) . "/" . sprintf( "%02s" , $jm ) . "/" . sprintf( "%02s" , $jd );
				break;
								
			default :
				
				$date_format = (string)$jy . " / " . (string)$jm . " / " . (string)$jd;
				break;
				
		}			
	
	    return $date_format;
	    
	}

	
	
	
	/////////////// Tehran Clock ///////////////
	
	function tehranClock( $format = 1 ){
		
		$a_noon = array( "am" => "پیش از ظهر" , "pm" => "پس از ظهر" );
		
		putenv("TZ=Asia/Tehran");		
		
		switch( $format ){	
			
			case 1 :
				
				$time_format = date("H:i:s");
				break;
				
			case 2 :
			case 'text' :
				
				$time_format = "ساعت " . date("g") . ( (int)date("i") ? " و " . (int)date("i") . " دقیقه " : " " ) . $a_noon[date(a)];
				break;
			
			case 3 :
				
				$time_format = date("H:i");
				break;
									
			default :
				
				$time_format = date("H:i:s");
				break;
		}			
	
	    return $time_format;
	    
	}			
	
?>