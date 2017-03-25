<?php
require_once ("../../modulos/LoteModulo.php");
$lote = new Lote();
$manzanas = $lote->listarManzanas();
$item= $lote->editarLote();

$title = (($item->id>0)?'Editar ':'Nuevo ').'Lote';
require_once ("../../template/header.php");

if (isset($_POST['guardar'])){
	$lote->guardarLote();	
}
?>
 <div class="card">
 <div class="content">
<form id="frmLote" method="post" action="">
<div style="overflow: auto;">
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6" >
			<label class="control-label">Nombre del Lote</label>
			<input type='text' name="nombre" class='form-control border-input' value="<?php echo $item->nombre; ?>" id="nombre">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Ubicación</label> 
			<input type='text' name="ubicacion" class="form-control border-input" value="<?php echo $item->ubicacion; ?>" id="ubicacion">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Dimensión</label> 
			<input type='text'name="dimension" class="form-control border-input" value="<?php echo $item->dimension; ?>" id="dimension">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Número de Lote</label> 
			<input type='text' name='numero_lote' class='form-control border-input' value="<?php echo $item->numero_lote; ?>" id="numero_lote">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Disponible</label>			
			<div class="radios">		
			<input type="radio" name='disponible' value="1" id="disponible" <?php echo ($item->disponible)?'checked':'';?> 
				<?php echo ($item->disponible ==0) && ($item->id>0)? 'disabled':'';?> > SI &nbsp; &nbsp;
			<input type="radio" name='disponible' value="0" id="disponible" <?php echo (!$item->disponible)?'checked':'';?> 
			<?php echo ($item->disponible ==0) && ($item->id>0)? 'disabled':'';?>> NO
			</div>	
		</div>
	</div>
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Manzana</label> 
			<select class='form-control border-input' name="manzana_id" id="manzana_id">
				<option value="" >Seleccione</option>
				<?php foreach ($manzanas as $dato) { ?>
					<option value="<?php echo $dato->id;?>"  <?php if($item->manzana_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
				<?php }?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<div class="form-group col-sm-6">
			<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">		
			<input type='hidden' name='guardar' value="1">
			<button type="submit" name="boton" class="btn btn-success btn-sm">Guardar</button>		
			<a href="listar.php" class="btn btn-info btn-sm">Cancelar</a>
		</div>
	</div>
</div>
</div>
</div>
</form>
<?php
require_once ("../../template/footer.php");
?>
<script type="text/javascript">
$(document).ready(function() {
    $('#frmLote').formValidation({    	    
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
				ubicacion: {
					message: 'La ubicación no es válida',
					validators: {
						notEmpty: {
							message: 'La ubicación no puede ser vacía.'
						},					
						regexp: {
							regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
							message: 'Ingrese una ubicación válido.'
						}
					}
				},
				dimension: {
					message: 'La dimensión no es válida',
					validators: {
						notEmpty: {
							message: 'La dimensión no puede ser vacía.'
						},					
						regexp: {
							regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
							message: 'Ingrese una dimension válida.'
						}
					}
				},		 
				numero_lote: {
					message: 'El número de lote  no es válido',
					validators: {
						notEmpty: {
							message: 'El número de lote no puede ser vacío.'
						},						
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Ingrese un número de lote válido.'
						}
					}
				},
				disponible: {
					message: 'La disponibilidad de lote  no es válida',
					validators: {
						notEmpty: {
							message: 'La disponibilidad de lote no puede ser vacía.'
						}
					}
				},
				manzana_id: {
					message: 'La manzana  no es válida',
					validators: {
						notEmpty: {
							message: 'Escoja una manzan válida.'
						}
					}
				}							
			}
		});
    });
</script>