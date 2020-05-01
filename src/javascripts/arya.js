/*--------------------------------------------------------------------------
 *
 *  Arya JavaScript framework, version 1.0
 *  (c) aryateams.com
 *
 *--------------------------------------------------------------------------*/

/////////////// adv float ///////////////

function adv_float(){
	
	loadPage('adv_float','includes/boxes/adv_float.php?','','2');
	
}
	
/////////////// change1 ///////////////

function change1( value , target , id , type ){

	if( value == target ){
		
		if( type == "enable" ){
			
			document.getElementById(id).style.display = 'table-row';
			
		}
		else if( type == "disable" ){
			
			document.getElementById(id).style.display = 'none';
			
		}
		
	}
	else{
		
		if( type == "enable" ){
			
			document.getElementById(id).style.display = 'none';
			
		}
		else if( type == "disable" ){
			
			document.getElementById(id).style.display = 'table-row';
			
		}		
		
	}

}

/////////////// change2 ///////////////

function change2( value , target , id , type ){

	if( value == target ){
		
		if( type == "enable" ){
			
			document.getElementById(id).style.display = 'inline';
			
		}
		else if( type == "disable" ){
			
			document.getElementById(id).style.display = 'none';
			
		}
		
	}
	else{
		
		if( type == "enable" ){
			
			document.getElementById(id).style.display = 'none';
			
		}
		else if( type == "disable" ){
			
			document.getElementById(id).style.display = 'inline';
			
		}		
		
	}

}

/////////////// getConfirm1 ///////////////

function getConfirm1( message , url ){

	var status = window.confirm( message );
	
	if( status == true ){
		
		window.location = url;
		
	}	

}

/////////////// getConfirm2 ///////////////

function getConfirm2( message , url ){

	var status = window.confirm( message );
	
	if( status == true ){
		
		window.location = url;
		
	}	

}

/////////////// send form ///////////////

function sendForm( form , id , pageUrl , mainUrl , type , postData ){
	
	if( postData ){
		
		postData += "&";
		
	}
	else{
		
		postData = "";
		
	}
	
	for( i = 0 ; i < form.length ; i++ ){
		
		postData += form[i].name + "=" + form[i].value + "&";
		
	}
	
	postData = postData.substring( 0 , postData.length - 1 );
				
	loadPage( id , pageUrl , mainUrl , type , postData );

}

/////////////// reload ///////////////

function reloadPage( form , id , pageUrl , mainUrl , fields ){
	
	var content = document.getElementById("loading");
	var postData = "";
	
	if( fields == "ALL" ){
		
		for( i = 0 ; i < form.length ; i++ ){
			
			postData += form[i].name + "=" + form[i].value + "&";
			
		}		
		
	}
	else{
	
		var array = fields.split("&");
		
		for( i = 0 ; i < array.length ; i++ ){
		
			postData += array[i] + "=" + ( form.eval( array[i] ).value ).toString() + "&";
			
		}

	}	

	postData = postData.substring( 0 , postData.length - 1 );
	 
    //content.innerHTML = "<img align='middle' alt='در حال بارگذاری' border='0' class='main' src='images/loading3.gif' />";	
	loadPage( id , pageUrl , mainUrl , '1' , postData );

}

/////////////// secure code ///////////////

function secureCode( id ){

	document.getElementById( id ).src = 'includes/boxes/secure_code.php?' + Math.random();

}

/////////////// set cookie ///////////////

function set_cookie( name , value , expires , path , domain , secure ){
	
	path = "/";
	
	/*if( name == "si" ){
		
		domain = ".aryateams.com";
		
	}*/
	
	var today = new Date(); 
	today.setTime( today.getTime() );
	
	if( expires ){ 
		
		expires = expires * 1000; 
		
	}
	
	var expires_date = new Date( today.getTime() + (expires) );
	document.cookie = name + "=" + escape( value ) +  
					 ( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) + 
					 ( ( path ) ? ";path=" + path : "" ) + 
					 ( ( domain ) ? ";domain=" + domain : "" ) + 
					 ( ( secure ) ? ";secure" : "" ); 
	
	return true;

}

/////////////// get cookie ///////////////

function get_cookie( name ){
	
	var start = document.cookie.indexOf( name + "=" );
	var len = start + name.length + 1;
	
	if( ( !start ) && ( name != document.cookie.substring( 0 , name.length ) ) ){ 
	
		return null; 
		
	}
	if ( start == -1 ){
		
		return null; 
		
	}
	
	var end = document.cookie.indexOf( ";" , len );
	
	if( end == -1 ){
		
		end = document.cookie.length;
		
	}
	
	return unescape( document.cookie.substring( len , end ) );

}

/////////////// open window ///////////////

function openWindow( url , name , setting ){
	
	//setting = "toolbar=no,location=no,directories=no,status=no,menubar=no,resizable=yes,width=600,height=480,fullscreen=no";
  	var win = window.open( url , name , setting );
  
  	if( !win ){
  	
    	alert("مرورگر شما اجازه باز شدن پنجره شناور را نمی دهد !");
          
  	}
  	else{
  		
  		win.focus();
  		
  	}
  
}