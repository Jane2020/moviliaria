<?php	
require("../../modulos/LoteMultaModulo.php");

$loteMulta = new LoteMulta();
$item= $loteMulta->editarLoteMultas();
$lotizaciones = $loteMulta->listarLotizaciones();
$multas = $loteMulta->listarMultas();
if($item->id>0){	
	$lectura = $loteMulta->obtenerLoteMultaLectura($item->lote_id);
	$manzanas = $loteMulta->listarManzanasByLotizacion($item->lotizacion_id);
	$lotes = $loteMulta->listarLoteByLManzana($item->manzana_id);		
}
$title = (($item->id>0)?'Editar ':'Nueva ').'Multa del Lote';
require_once ("../../template/header.php");
if (isset($_POST['guardar'])){
	$loteMulta->guardarLoteMultas();
}
?>
 <div class="card">
 <div class="content">
<form id="frmLoteMulta" method="post" action="">
<div style="overflow: auto;">
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Nombre del Lotización</label> 
			<select class='form-control border-input' name="lotizacion_id" id="lotizacion_id" <?php if($lectura==2):echo "disabled"; endif;?>>
				<option value="" >Seleccione</option>
				<?php foreach ($lotizaciones as $dato) { ?>
					<option value="<?php echo $dato->id;?>"  <?php if($item->lotizacion_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
				<?php }?>
			</select>
		</div>
	</div>
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Nombre de la Manzana</label> 			
			<select class='form-control border-input' name="manzana_id" id="manzana_id" <?php if($lectura==2):echo "disabled"; endif;?>>
				<option value="" >Seleccione</option>
				<?php foreach ($manzanas as $dato) { ?>
					<option value="<?php echo $dato->id;?>"  <?php if($item->manzana_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
				<?php }?>
			</select>
		</div>
	</div>	
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Nombre del Lote</label> 
			<select class='form-control border-input' name="lote_id" id="lote_id" <?php if($lectura==2):echo "disabled"; endif;?>>
				<option value="" >Seleccione</option>
				<?php foreach ($lotes as $dato) { ?>
					<option value="<?php echo $dato->id;?>"  <?php if($item->lote_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
				<?php }?>
			</select>
		</div>
	</div>	
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Nombre de la Multa</label>
			<select class='form-control border-input' name="multa_id" id="multa_id" <?php if($lectura==2):echo "disabled"; endif;?>>
				<option value="" >Seleccione</option>
				<?php foreach ($multas as $dato) { ?>
					<option value="<?php echo $dato->id;?>"  <?php if($item->multa_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
				<?php }?>
			</select>
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6">
			<label class="control-label">Valor</label>
			<input type='text' name='valor_multa' id="valor_multa" class='form-control border-input' value="<?php echo $item->valor_multa; ?>" disabled>			
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6">
			<label class="control-label">Fecha de Ingreso de Multa</label>
			<input type="text" name="fecha_ingreso" id="fecha_ingreso"  class='form-control border-input'  value="<?php echo $item->fecha_ingreso; ?>" size="12" <?php if($lectura==2):echo "disabled"; endif;?>/>						
		</div>
	</div>
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Descripción</label> 
			<textarea name='descripcion' class='form-control border-input' id="descripcion" rows="5" cols="10" <?php if($lectura==2):echo "disabled"; endif;?>><?php echo isset($item->descripcion)?$item->descripcion:null; ?></textarea>
		</div>
	</div>
	<?php if($lectura==1){?>	
	<div class="form-group">
		<div class="form-group col-sm-6">
			<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">		
			<input type='hidden' name='guardar' value="1">
			<button type="submit" name="boton" class="btn btn-success btn-sm">Guardar</button>		
			<a href="listar.php" class="btn btn-info btn-sm">Cancelar</a>
		</div>		
	</div>
	<?php }?>
</div>
</form>
</div>
</div>
<?php
require_once ("../../template/footer.php");
?>
<script type="text/javascript">
$(document).ready(function() {
//	$("#fecha_ingreso").datepicker();

	jQuery( "#fecha_ingreso" ).datepicker({  
		dateFormat: "yy-mm-dd",
		onClose: function( selectedDate ) {
	        $('#frmLoteMulta').formValidation('revalidateField', 'fecha_ingreso');
	      }  		
	});  
	
	$('#lotizacion_id').change(function(){
	    var lotizacion_id = jQuery("#lotizacion_id").val();
	    jQuery.ajax({
		        type: "GET",
		        url: "ajax.php",
		        data: {
		        	"id": lotizacion_id,
		        	"accion":0
		        },
		        success:function(response) {
			      $('#manzana_id').html(response);
			        $("#manzana_id").prop('disabled', false);			        		        				    			           	
		        }
		});	    
	});

	$('#manzana_id').change(function(){
	    var manzana_id = jQuery("#manzana_id").val();
	    jQuery.ajax({
		        type: "GET",
		        url: "ajax.php",
		        data: {
		        	"id": manzana_id,
		        	"accion":1
		        },
		        success:function(response) {
			      $('#lote_id').html(response);
			        $("#lote_id").prop('disabled', false);			        		        				    			           	
		        }
		});	    
	});

	$('#multa_id').change(function(){
	    var multa_id = jQuery("#multa_id").val();
	    jQuery.ajax({
		        type: "GET",
		        url: "ajax.php",
		        data: {
		        	"id": multa_id,
		        	"accion":2
		        },
		        success:function(response) {			       
			        $('#valor_multa').val(response);    	
		        }
		});	    
	});

	
	$('#frmLoteMulta').formValidation({    	    
			message: 'This value is not valid',

			fields: {
				lotizacion_id: {
					message: 'La lotización no es válida',
					validators: {
						notEmpty: {
							message: 'La lotización no puede ser vacía.'
						}
					}
				},
				manzana_id: {
					message: 'La manzana no es válida',
					validators: {
						notEmpty: {
							message: 'La manzana no puede ser vacía.'
						}
					}
				},
				lote_id: {
					message: 'El lote no es válido',
					validators: {
						notEmpty: {
							message: 'El lote no puede ser vacío.'
						}
					}
				},
				multa_id: {
					message: 'La multa no es válida',
					validators: {
						notEmpty: {
							message: 'El multa no puede ser vacía.'
						}
					}
				},
				fecha_ingreso: {
					message: 'La fecha de ingreso no es válida',
					 validators: {
						 notEmpty: {
							 message: 'La fecha de ingreso es requerida y no puede ser vacía'
						 },
						 date:{	 
							    format: 'YYYY-MM-DD',
			                    message: 'La fecha de ingreso no es válida.'				                    
						 }						 							 
					 }
				 },
				descripcion: {
					message: 'La descripción no es válida',
					validators: {
						regexp: {
								regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
								message: 'Ingrese una descripción válida.'
						}
					}
				}
			}
		});
    });
</script>