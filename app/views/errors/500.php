<!DOCTYPE html>
<html>
<head>
	<title> 500 Page </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
	<style>
		/*/@import url('https://fonts.googleapis.com/css?family=Roboto+Mono:300,500');*/

	html, body {
	    width: 100%;
	    height: 100%;
	}

	body {
		background-color: grey;
	    background-size: cover;
	    background-repeat: no-repeat;
	    min-height: 100vh;
	    min-width: 100vw;
	    font-family: "Roboto Mono", "Liberation Mono", Consolas, monospace;
	    color: rgba(255,255,255,.87);
	}

	.mx-auto {
	    margin-left: auto;
	    margin-right: auto;
	}

	.container,
	.container > .row,
	.container > .row > div {
	    height: 100%;
	}

	#countUp {
	    display: flex;
	    flex-direction: column;
	    justify-content: center;
	    align-items: center;
	    height: 100%;
	    
	    .number {
	        font-size: 4rem;
	        font-weight: 500;
	        
	        + .text {
	            margin: 0 0 1rem;
	        }
	    }
	    
	    .text {
	        font-weight: 300;
	        text-align: center;
	    }
	}
	</style>

</head>
<body>
	<div class="container">
    <div class="row">
        <div class="xs-12 md-6 mx-auto">
            <div id="countUp">
                <img src="/public/kayphplogo.png" width="200px;">

                <div class="text">Internal Server Error</div>
                <p class="cookie_value" style="margin-right:200px; margin-left: 200px;">  </p>
                <div class="text">Back to <a style="color: white !important;" href="/">homepage</a>.</div>
            </div>
        </div>
    </div>
</div>  

<script>
	window.addEventListener('load',()=>{
		document.querySelector('.cookie_value').innerHTML = getCookie('error');
	});	

	function getCookie(name) {
	    // Split cookie string and get all individual name=value pairs in an array
	    var cookieArr = document.cookie.split(";");
	    
	    // Loop through the array elements
	    for(var i = 0; i < cookieArr.length; i++) {
	        var cookiePair = cookieArr[i].split("=");
	        
	        /* Removing whitespace at the beginning of the cookie name
	        and compare it with the given string */
	        if(name == cookiePair[0].trim()) {
	            // Decode the cookie value and return
	            var data =  decodeURIComponent(cookiePair[1]);
	            //Make the string clean
	            var str = data.split('+').join(' ');
	            
	            return str;
	        }
	    }
	    
	    return null;
	}
</script>
</body>
</html>