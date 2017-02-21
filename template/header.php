
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title><?php echo $title; ?></title>

	<link rel="shortcut icon" href="images/gt_favicon.png">
	
	
	<link rel="stylesheet" href="<?php echo PATH_CSS; ?>/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo PATH_CSS; ?>/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo PATH_CSS; ?>/dataTables.bootstrap.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="<?php echo PATH_CSS; ?>/bootstrap-theme.css" media="screen" >
	<link href="<?php echo PATH_CSS; ?>/dataTables.bootstrap.css" rel="stylesheet">
	
	<link rel="stylesheet" href="<?php echo PATH_CSS; ?>/main.css">	
	<link rel="stylesheet" href="<?php echo PATH_CSS; ?>/jquery-ui.min.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.html"><img src="assets/images/logo.png" alt="Progressus HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right" style="padding-top: 25px; font-size: 18px;">
					<li>
						<a href="index.html">Home</a></li>
					<!--  <li class="active">
						<a href="about.html">About</a></li>-->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Predios <b class="caret"></b></a>
						<ul class="dropdown-menu" style="font-size: 16px;">
							<li><a href="../lotizacion/listar.php">Lotizaci&oacute;n</a></li>
							<li><a href="../manzana/listar.php">Manzana</a></li>
							<li><a href="../lote/listar.php">Predio</a></li>
						</ul>
					</li>
					<li><a href="../multa/listar.php">Multa</a></li>
					<!-- <li><a class="btn" href="">SIGN IN / SIGN UP</a></li>  -->
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active"><?php echo $title;?></li>
		</ol>
<?php session_start();?>