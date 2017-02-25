<?php
$title = 'Cambio Contraseña';
require ("../../modulos/SeguridadModulo.php");
require_once ("../../template/header.php");
if (isset ( $_POST ['guardar'] )) {
	$seguridad = new Seguridad ();
	$seguridad->cambiarContraseñaDatos ();
} else {

?>

<div class="row">


	<div class="col-md-12">
		<div class="card">
			<div class="header">
			
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
</div>
<?php
include "../../template/footer.php";
?>

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
<?php } ?>