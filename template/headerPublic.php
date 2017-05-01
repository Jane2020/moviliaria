<?php session_start();?>
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
					<div class="navbar-brand">
						<img alt="" src="images/logo.png" style="height: 120px; margin-top: 10px; ">								
					</div>
					<div style="width: 88%; float: right;">
						<div class="head-top">
							<div class="social-icon">
								<a href="https://www.facebook.com/Donovilsa/" target="_blank"><i class="icon"></i></a>
								<a href="https://twitter.com/Donovilsa_SA" target="_blank"><i class="icon1"></i></a>
								<a href="https://www.instagram.com/donovilsa/" target="_blank"><i class="icon2"></i></a>							
							</div>
							<div class="email">
							<form id="form1" name="form1" action="../vistas/seguridad/accion.php" method="post"> 
	                              			<input type="hidden" name="action" id="action" value="">
    	                          		</form>
								<ul>
									<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>Email: <a href="mailto:companiadonovilsa@gmail.com">companiadonovilsa@gmail.com</a> </li>
									<?php if (!isset($_SESSION['SESSION_USER'])): ?>									
									<li><i class="glyphicon glyphicon-log-in" aria-hidden="true"></i><a href="../vistas/seguridad/login.php" >Iniciar Sesión</a></li>
									<?php else: ?>
									
									<li><b> <i class="glyphicon glyphicon-user" aria-hidden="true"></i> Usuario: <?php echo  $_SESSION['SESSION_USER']->nombres; ?> </b>| <i class="glyphicon glyphicon-log-in" aria-hidden="true"></i> <a href="#" onclick="javascript:document.form1.action.value='cerrarSesion'; document.form1.submit();">Cerrar Sesión</a></li>
									<?php endif; ?>
								</ul>
							</div>						
												
						<div class="clearfix"></div>
					</div>
					
					<nav class="navbar navbar-default">						
					<!---Brand and toggle get grouped for better mobile display--->
						<div class="navbar-brand" align="left">
							<h3 style="color:#C6C7C7; font-size: 26px; font-style: italic;" > NUEVO AMANECER DONOVILSA S.A.</h3>
						</div>
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>		
						</div>
						<div class="navbar-brand">							
						</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<?php $url = $_SERVER["REQUEST_URI"];?>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li class="<?php echo (strpos($url, '/index.php'))?'active':'';?>"><a href="index.php">Inicio <span class="sr-only">(current)</span></a></li>									
								<li class="<?php echo (strpos($url, '/info.php'))?'active':'';?>"><a href="info.php">Quienes Somos</a></li>
								<li class="<?php echo (strpos($url, '/galeria.php'))?'active':'';?>"><a href="galeria.php">Galería</a></li>
								<?php if (isset($_SESSION['SESSION_USER'])): ?>
									<li class="<?php echo (strpos($url, '/pagos.php'))?'active':'';?>"><a href="pagos.php">Mis Pagos</a></li>
								<?php endif; ?>
								<li class="<?php echo (strpos($url, '/contactos.php'))?'active':'';?>"><a href="contactos.php">Contactos</a></li>
							</ul>
						
							<div class="clearfix"></div>
						</div>
					</nav>
					</div>
				</div>
			</div>
		<!---header--->