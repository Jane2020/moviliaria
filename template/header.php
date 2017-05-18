<?php
 ob_start();
 session_start();
 
 if (!isset($_SESSION['SESSION_USER'])){
 	$url = $_SERVER["REQUEST_URI"];
 	header ( "Location: ../seguridad/login.php" );
 }
 
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?php echo $title; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="<?php echo PATH_CSS; ?>/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo PATH_CSS; ?>/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="<?php echo PATH_CSS; ?>/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo PATH_CSS; ?>/demo.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo PATH_CSS; ?>/font-awesome.min.css">    
    <link href="<?php echo PATH_CSS; ?>/themify-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>/dataTables.bootstrap.css">
      <link rel="stylesheet" href="<?php echo PATH_CSS; ?>/main.css">	
	<link rel="stylesheet" href="<?php echo PATH_CSS; ?>/jquery-ui.min.css">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="../seguridad/inicio.php" class="simple-text">
                    DonoVilsa S.A.
                </a>
            </div>
			<?php $url = $_SERVER["REQUEST_URI"];?>
            <ul class="nav" >
                <li class="<?php echo (strpos($url, '/seguridad/'))?'active':'';?>">
                    <a href="../seguridad/inicio.php">
                        <i class="ti-panel"></i>
                        <p>Inicio</p>
                    </a>
                </li>                
           <li class="<?php echo ((strpos($url, '/cliente/'))||(strpos($url, '/usuario/')))?'active':'';?>">
               <a data-toggle="collapse" href="#formsUsers">
                	<i class="ti-user"></i>
                     <p>Personas  &nbsp;<b class="caret"></b></p> 
              </a>
                  <div class="collapse" id="formsUsers">
                     <ul class="nav" style="margin-top: 0px; margin-left: 30px">

                         <li>
                          <a href="../usuario/listar.php"><p>Usuarios</p></a>
                          </li>                         
                     </ul>
                  </div>
            </li>
            <li class="<?php echo ((strpos($url, '/lotizacion/'))||(strpos($url, '/manzana/'))||(strpos($url, '/lote/')))?'active':'';?>">
               <a data-toggle="collapse" href="#formsPredios">
                	<i class="ti-map"></i>
                     <p>Predios  &nbsp;<b class="caret"></b></p> 
              </a>
                  <div class="collapse" id="formsPredios">
                     <ul class="nav" style="margin-top: 0px; margin-left: 30px">
                         <li>
                          </i><a href="../lotizacion/listar.php"><p>Lotización</p></a>
                          </li>
                         <li>
                          <a href="../manzana/listar.php"><p>Manzana</p></a>
                          </li>  
                          <li>
                          <a href="../lote/listar.php"><p>Lote</p></a>
                          </li>    
                                              
                     </ul>
                  </div>
            </li>            
            <li class="<?php echo ((strpos($url, '/multa/'))||(strpos($url, '/lote_multa/')))?'active':'';?>">
               <a data-toggle="collapse" href="#formsMulta">
                	<i class="ti-bell"></i>
                     <p>Multas  &nbsp;<b class="caret"></b></p> 
              </a>
                  <div class="collapse" id="formsMulta">
                     <ul class="nav" style="margin-top: 0px; margin-left: 30px">
                         <li>
                          </i><a href="../multa/listar.php"><p>Multa</p></a>
                          </li>
                         <li>
                          <a href="../lote_multa/listar.php"><p>Multas Lotes</p></a>
                          </li>                    
                                              
                     </ul>
                  </div>
            </li>            
            <li class="<?php echo ((strpos($url, '/obras/'))||(strpos($url, '/lote_obra/')))?'active':'';?>">
               <a data-toggle="collapse" href="#formsObra">
                	<i class="ti-direction-alt"></i>
                     <p>Obras&nbsp;<b class="caret"></b></p> 
              </a>
                  <div class="collapse" id="formsObra">
                     <ul class="nav" style="margin-top: 0px; margin-left: 30px">
                         <li>
                          </i><a href="../obras/listar.php"><p>Obras</p></a>
                          </li>
                         <li>
                          <a href="../lote_obra/listar.php"><p>Obras Lotes</p></a>
                          </li>                
                     </ul>
                  </div>
            </li>
            <li class="<?php echo ((strpos($url, '/pagos/'))||(strpos($url, '/acuerdo/')))?'active':'';?>">
               <a data-toggle="collapse" href="#formsPagos1">
                	<i class="ti-money"></i>
                     <p>Pagos  &nbsp;<b class="caret"></b></p> 
              </a>
               <div class="collapse" id="formsPagos1">
                     <ul class="nav" style="margin-top: 0px; margin-left: 30px">
                         <li>
                          </i><a href="../acuerdo/listar.php"><p>Acuerdo</p></a>
                          </li>
                          <li>
                          <a href="../traspaso/editar.php"><p>Traspaso</p></a>
                          </li> 
                         <li>
                          <a href="../pagos/listar.php"><p>Pagos</p></a>
                          </li>                    
                                              
                     </ul>
                  </div>
            </li>				
            <li class="<?php echo ((strpos($url, '/reportes/'))||(strpos($url, '/reportes/')))?'active':'';?>">
               <a data-toggle="collapse" href="#formsPagos2">
                	<i class="ti-view-list-alt"></i>
                     <p>Reportes  &nbsp;<b class="caret"></b></p> 
              </a>
               <div class="collapse" id="formsPagos2">
                     <ul class="nav" style="margin-top: 0px; margin-left: 30px">
                         <li>
                          </i><a href="../reportes/listar.php"><p>Reporte de Lotes</p></a>
                          </li>
                          <li><a href="../reportes/listar_obras.php"><p>Reporte de Obras</p></a>
                          </li>         
                     </ul>
                  </div>
            </li>
            </ul>
    	</div>
    </div>

       <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php echo $title;?></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-user"></i>
                                    
									<p><?php echo  $_SESSION['SESSION_USER']->nombres; ?></p>
									<b class="caret"></b>
                              </a>
                              <form id="form1" name="form1" action="../seguridad/accion.php" method="post"> 
                              <input type="hidden" name="action" id="action" value="">
                              </form>
                              <ul class="dropdown-menu">
                                <li><a href="#" onclick="javascript:document.form1.action.value='cambiarContrasena'; document.form1.submit();">Cambiar Contraseña</a></li>
                                <li><a href="#" onclick="javascript:document.form1.action.value='cerrarSesion'; document.form1.submit();">Cerrar Sesión</a></li>
                          
                              </ul>
                        </li>
						
                    </ul>

                </div>
            </div>
        </nav>
        <div class="content">
        
