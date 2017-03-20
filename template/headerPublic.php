<!DOCTYPE HTML>
<html>
<head>
<title>Moviliaria </title>
<!---css--->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!---css--->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Real Space Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!---js--->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>
<!---js--->
<!---fonts-->
<link rel="stylesheet" href="css/font-awesome.min.css">   
<!---fonts-->

</head>
<body>
		<!---header--->
			<div class="header-section">
				<div class="container">
					<div class="head-top">
						<div class="social-icon">
							<a href="#"><i class="icon"></i></a>
							<a href="#"><i class="icon1"></i></a>
							<a href="#"><i class="icon2"></i></a>
							
						</div>
						<div class="email">
						<ul>
							<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>Email: <a href="mailto:info@example.com">info@example.com</a> </li>
							<li><i class="glyphicon glyphicon-log-in" aria-hidden="true"></i><a href="../vistas/seguridad/login.php" >Iniciar Sesión</a></li>
							
						</ul>
						</div>
						<div class="clearfix"></div>
					</div>
					<nav class="navbar navbar-default">
					<!---Brand and toggle get grouped for better mobile display--->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>				  
							<div class="navbar-brand">
								<h1><a href="index.html"><span>Real </span>Space</a></h1>
							</div>
						</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<?php $url = $_SERVER["REQUEST_URI"];?>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li class="<?php echo (strpos($url, '/index.php'))?'active':'';?>"><a href="index.php">Inicio <span class="sr-only">(current)</span></a></li>									
								<li class="<?php echo (strpos($url, '/info.php'))?'active':'';?>"><a href="info.php">Quienes Somos</a></li>
								<li class="<?php echo (strpos($url, '/galeria.php'))?'active':'';?>"><a href="galeria.php">Galeria</a></li>
								<li class="<?php echo (strpos($url, '/pagos/'))?'active':'';?>"><a href="../pagos/listar.php">Mis Pagos</a></li>
								<li class="<?php echo (strpos($url, '/contactos.php'))?'active':'';?>"><a href="contactos.php">Contactos</a></li>
							</ul>
						
							<div class="clearfix"></div>
						</div>
					</nav>
				</div>
			</div>
		<!---header--->