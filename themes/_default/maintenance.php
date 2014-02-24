<?php

	/* Plugin options */
	$plugin_url = plugins_url( '' , dirname(__FILE__) ).'/_default';

	$title = get_bloginfo( 'name' );
	$url = get_bloginfo( 'wpurl' );
	$email = get_bloginfo( 'admin_email' );
	$deadline = get_option('wp_mcs_deadline');

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $plugin_url."/";?>assets/img/favicon.png">

    <title><?php echo $title;?></title>

    <!-- Bootstrap -->
    <link href="<?php echo $plugin_url."/";?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $plugin_url."/";?>assets/css/bootstrap-theme.css" rel="stylesheet">

    <!-- siimple style -->
    <link href="<?php echo $plugin_url."/";?>assets/css/style.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

	<div id="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<h1><?php echo $title;?></h1>
					<h2 class="subtitle">We're currently undergoing scheduled maintenance. We will be right back.</h2>
					<div id="countdown"></div>
					<h2 class="subtitle">In the meantime, you can contact us at <a href="<?php echo $email; ?>"><?php echo $email; ?></a></h2>
				</div>
				
			</div>
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
						<p class="copyright">Copyright &copy; 2014 - <a href="<?php echo $url;?>"><?php echo $title;?></a></p>
				</div>
			</div>		
		</div>
	</div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="<?php echo $plugin_url."/";?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo $plugin_url."/";?>assets/js/jquery.countdown.min.js"></script>
	<script type="text/javascript">
		$('#countdown').countdown('<?php echo $deadline; ?>', function(event) {
			$(this).html(event.strftime('%w weeks %d days <br /> %H hr %M mins %S secs'));
		});
	</script>
  </body>
</html>
