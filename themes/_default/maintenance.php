<?php

	/* Plugin options */
	$plugin_url = plugins_url( '' , dirname(__FILE__) ).'/_default';

	/* title */
	$title = get_bloginfo('wp_title');

?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600' rel='stylesheet' type='text/css'>
		
		<title><?php echo $title; ?></title>

		<!-- Bootstrap core CSS -->
		<link href="<?php echo $plugin_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">

		<!-- 503 specific styles -->
		<style>
			*{	text-transform: uppercase;	}
			.full-width{
				width: 100%;
			}
			body{
				background: url('<?php echo $plugin_url; ?>/assets/img/bg.jpg') repeat;
				font-family: 'Montserrat', sans-serif;
			}
			
			h1,h2,h3,h4,h5,h6{
				font-family: lato, sans-serif;
			}
			h1{
				font-size: 64px;
				color: #333;
			}
			h2{
				font-family: 'Raleway', sans-serif;
				font-size: 24px;
				color: #555;
			}

			#header{
				padding-top: 100px;
			}
			
		</style>

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
	</head>

  	<body>

  		<section class="full-width" id="header">
	    	<div class="container">
	    		<div class="col-md-12">
					<div class="row">
						<div class="col-md-12 text-center">
							<h1><?php echo $title; ?></h1>
						</div>
					</div>
				</div>
	    	</div>
    	</section>

    	<section class="full-width" id="body">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-8 col-md-offset-2 text-center">
    					<h2>We are currently undergoing scheduled maintenance.</h2>
    					<h2>Check back soon.</h2>
    				</div>
    			</div>
    		</div>
    	</section>

    </body>

</html>