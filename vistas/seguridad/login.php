<?php 
define("PATH_ROOT", __DIR__);
require_once(PATH_ROOT . "/../../config/config.inc");
session_start();
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login, registration forms">
    <meta name="author" content="Seong Lee">

    <title>Login</title>

    <!-- Stylesheets -->
    <link href="<?php echo PATH_CSS; ?>/bootstrap.css" rel="stylesheet">
	<link href="<?php echo PATH_CSS; ?>/animation.css" rel="stylesheet">
	<link href="<?php echo PATH_CSS; ?>/authenty.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo PATH_CSS; ?>/jquery-ui.min.css">

	<!-- Font Awesome CDN -->
	<link href="<?php echo PATH_CSS; ?>/font-awesome.min.css" rel="stylesheet">
	
	

    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="authenty password-recovery" > 
		
			<section id="password_recovery" >
				<div class="section-content">
					<div class="wrap">
						<div class="container">
							<div class="form-wrap">
								<div class="row">
									<div class="col-xs-12 col-sm-3 brand animated fadeInUp" data-animation="fadeInUp">
										<h2>COMPAÑÍA</h2>
										<p>NUEVO AMANECER DONOVILSA S.A.</p>
									</div>
									<div class="col-sm-1 hidden-xs">
										<div class="horizontal-divider"></div>
									</div>
									<div class="col-xs-12 col-sm-8 main animated fadeInLeft" data-animation="fadeInLeft" data-animation-delay=".5s" style="animation-delay: 0.5s;">
										<h3>Iniciar Sesión</h3>
								<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
										<div class="alert alert-danger fade in alert-dismissable" style="padding: 6px;" id="mensajeContenedor">
								  <span id="mensajeLogin"><?php echo $_SESSION['message'];$_SESSION['message'] = ''?></span>
								</div>
								<?php endif;?>
										<?php $url = $_SERVER["REQUEST_URI"];?>
                        <form action="accion.php" id="frmLogin" method="post">
                            <fieldset>
                            <div class="alert alert-danger fade in alert-dismissable" style="display: none; padding: 6px;" id="mensajeContenedor">
								  <span id="mensajeLogin"></span>
								</div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="usuario" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="contrasena" type="password" value="">
                                </div>
                                <input name="action" type="hidden" value="validar">
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-success " type="submit" id="btnSubmit">
                                <i class="fa fa-sign-in "></i>&nbsp;Ingresar</button>
                            </fieldset>
                        </form>
									</div>
								</div>
									
							</div>
						</div>
					</div>
				</div>
			</section>
	<script src="<?php echo PATH_JS; ?>/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>	
	<script src="<?php echo PATH_JS; ?>/validation/bootstrap.js"></script>
	<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet"></link>
    <script type="text/javascript">
						$(document).ready(function(){
							$('#frmLogin').formValidation({ 
						    	message: 'This value is not valid',
								feedbackIcons: {
									validating: 'glyphicon glyphicon-refresh'
								},
								fields: {			
									usuario: {
										message: 'El Usuario no es válido',
										validators: {
													notEmpty: {
														message: 'El Usuario no puede ser vacío.'
													},					
													regexp: {
														regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9-_ \.]+$/,
														message: 'Ingrese un Usuario válido.'
													}
												}
											},	
									contrasena: {
										message: 'La Contraseña no es válida',
										validators: {
											notEmpty: {
												message: 'La Contraseña no puede ser vacía.'
											},					
											regexp: {
												regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9-_ \.]+$/,
												message: 'Ingrese una Contraseña válida.'
											}
										}
									},
													
									
								},
								 submitHandler: function(validator, form, submitButton) {
									 $.post(form.attr('action'), form.serialize(), function(result) {
										 var obj = JSON.parse(JSON.stringify(result));
										 if( obj.band === 1 ){											
											 $("#mensajeLogin").html(obj.data);
									     	 $("#mensajeContenedor").css('display','block');	
										 } else {
											 window.location = obj.data;
										      return false;
										 }
									 }, 'json');					   
								 }
							});


						
						});		
						</script>		
		
	</body></html>