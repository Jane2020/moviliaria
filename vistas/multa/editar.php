<?php
require("../../modulos/MultaModulo.php");

$multa = new Multa();
$item= $multa->editarMulta();
$title = (($item->id>0)?'Editar ':'Nueva ').'Multa';
require_once ("../../template/header.php");
if (isset($_POST['guardar'])){
	$multa->guardarMulta();	
}
?>
 <div class="card">
 <div class="content">

<form id="frmMulta" method="post" action="">
<div style="overflow: auto;">
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6">
			<label class="control-label">Nombre</label>
			<input type='text' name='nombre' class='form-control border-input' value="<?php echo $item->nombre; ?>" id="nombre">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6">
			<label class="control-label">Descripción</label> 
			<textarea name='descripcion' class='form-control border-input' rows="5" cols="10"><?php echo isset($item->descripcion)?$item->descripcion:null; ?></textarea>
		</div>
	</div>	
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Valor</label> 
			<input type='text' name='valor' class='form-control border-input' value="<?php echo $item->valor; ?>" id="valor">
		</div>
	</div>	
	<div class="form-group">
		<div class="form-group col-sm-6">
			<input type='hidden' name='id' class='form-control ' value="<?php echo $item->id; ?>">		
			<input type='hidden' name='guardar' value="1">
			<button type="submit" name="boton" class="btn btn-success btn-sm">Guardar</button>		
			<a href="listar.php" class="btn btn-info btn-sm">Cancelar</a>
		</div>
	</div>
</div>
</form>
</div>
</div>
<?php
require_once ("../../template/footer.php");
?>
<script type="text/javascript">
$(document).ready(function() {
    $('#frmMulta').formValidation({    	    
			message: 'This value is not valid',

			fields: {
				nombre: {
					message: 'El nombre no es válido',
					validators: {
						notEmpty: {
							message: 'El Nombre no puede ser vacío.'
						},					
						regexp: {
							regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
							message: 'Ingrese un Nombre válido.'
						}
					}
				},
				descripcion: {
					message: 'La descripción no es válida',
					validators: {
						regexp: {
							regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
							message: 'Ingrese una descripción válido.'
						}
					}
				},
				valor: {
					message: 'El valor no es válida',
					validators: {						
						notEmpty: {
							message: 'El valor no puede ser vacío.'
						},
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Ingrese un valor válido.'
						}
					}
				}							
			}
		});
    });
</script>