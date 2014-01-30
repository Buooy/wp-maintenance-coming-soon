<?php

	$site_name 		= 	get_bloginfo( 'name' );
	$admin_email	=	get_bloginfo( 'admin_email' );
	$image_url 		=	plugins_url('',__FILE__)."/assets/img/clock.jpg";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $site_name; ?></title>
	
	<link rel="icon" type="image/ico" href="favicon.png" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<style type="text/css">
	
		body {
			background: rgb(28, 168, 158);
			font-family: "Open Sans", helvetica;
			font-weight: 300;
			font-size: 19px;
			color: #f1f1f1;
			letter-spacing: 1px;
		}
		a{
			color:#f3f3f3;
		}
		hr{
			margin: 30px auto;
			width: 90%;
			border-color: #f3f3f3;
		}
		#page {
			width: 640px;
			margin: 60px auto;
			text-align: center;
		}
		#logo {
			width: 300px;
		}

		@media all and (max-width: 767px) {
			#page {
				width: 480px;
			}
		}
		@media all and (max-width: 480px) {
			#page {
				width: 360px;
			}
		}
		@media all and (max-width: 320px) {
			#page {
				width: 280px;
			}
			#logo {
				width: 280px;
			}
		}

	</style>

</head>
<body>
	<div id="page">
		<img src="<?php echo $image_url; ?>" alt="Lamb Cupcakery" id="logo" />
		
		<hr/>

		<p>This website is currently undergoing scheduled maintenance.</p>
		<p><b>Sorry for the inconvenience!</b></p>
		<p>If you need to contact us urgently, please email us at <a href="mailto:<?php echo $admin_email; ?>"><?php echo $admin_email; ?></a></p>
	</div>
</body>
</html>