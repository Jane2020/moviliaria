<?php 
ob_start();


require_once ("../template/headerPublic.php");
require ("../modulos/SeguridadModulo.php");

if (isset ( $_POST ['guardar'] )) {
	$seguridad = new Seguridad ();
	$seguridad->cambiarContraseñaDatos (false);
}

?>
<link rel="stylesheet" href="css/swipebox.css">
			<script src="js/jquery.swipebox.min.js"></script> 
			    <script type="text/javascript">
					jQuery(function($) {
						$(".swipebox").swipebox();
					});
				</script>


		<!---banner--->
		<div class="banner-section">
			<div class="container">
				<h2>Cambio de Contraseña</h2>
			</div>
		</div>
		<!---banner--->
		<div class="content">
			<div class="gallery-section">
				<div class="container">
					 <?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
					<div class="alert alert-success fade in alert-dismissable">
					<button type="button" class="close" data-dismiss="alert"
						aria-hidden="true">&times;</button>
								  <?php echo $_SESSION['message'];$_SESSION['message'] = '';?>
								</div>
				<?php endif;?>
			
				<form method="post" action="#" id="frmUsuario" name="frmUsuario">


					<div class="form-group col-sm-12 rows">
						<div class="form-group col-sm-4">
							<label class="control-label">Contraseña Actual</label> <input
								type="password" name='passwordAnterior'
								class='form-control border-input' value="">
						</div>
						<div class="form-group col-sm-4">
							<label class="control-label">Nueva Contraseña</label> <input
								type="password" name='password'
								class='form-control border-input' value="">

						</div>
						<div class="form-group col-sm-4">
							<label class="control-label">Repetir Contraseña</label> <input
								type="password" name='password1'
								class='form-control border-input' value="">
						</div>
					</div>

					<div class="form-group rowBottom">
						<input type='hidden' name='guardar' value="1">
						<button type="submit" class="btn btn-info">Cambiar Contraseña</button>
					</div>

				</form>
				</div>
			</div>
		</div>

<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>	
<script src="<?php echo PATH_JS; ?>/validation/bootstrap.js"></script>
		
<script type="text/javascript">

$(document).ready(function() {
    $('#frmUsuario').formValidation({
    	message: 'This value is not valid',
		fields: {			
			passwordAnterior: {
				message: 'La Contraseña Anterior no es válida',
				validators: {
					notEmpty: {
						message: 'La Contraseña Anterior no puede ser vacía.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9-_ \.]+$/,
						message: 'Ingrese una Contraseña Anterior válida.'
					}
				}
			},
			password: {
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
			password1: {
				validators: {
					notEmpty: {
						message: 'La contraseña no puede ser vacia.'
					},
					identical: {
						field: 'password',
						message: 'La contraseña debe ser la misma'
					}
				}
			},
			
		}
	});

});
</script>

<?php
require_once ("../template/footerPublic.php");
?>	

