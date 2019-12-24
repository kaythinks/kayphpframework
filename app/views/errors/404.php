<!DOCTYPE html>
<html>
<head>
	<title> 404 Page </title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	   	background:#0d1d24;
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
                <div class="text">Page not found</div>
                <div class="text">Back to <a style="color: white !important;" href="/">homepage</a>.</div>
                <div class="text">What are you looking for mate ?</div>
            </div>
        </div>
    </div>
</div>         

</body>
</html>