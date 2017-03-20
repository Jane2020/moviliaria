<?php
require_once ("../../modulos/PagosModulo.php");
$pagos = new Pagos();
$item= $pagos->editarPagos();
$lotizaciones = $pagos->listarLotizaciones();
if($item->id>0){
	$manzanas = $acuerdo->listarManzanasByLotizacion($item->lotizacion_id);
	$lotes = $acuerdo->listarLoteByLManzana($item->manzana_id);
}
$title = (($item->id>0)?'Editar ':'Nuevo ').'Pago';
require_once ("../../template/header.php");

if (isset($_POST['guardar'])){
	$acuerdo->guardarAcuerdo();	
}
?>
 <div class="card">
 <div class="content">
<form id="frmPagos" method="post" action="">
<div style="overflow: auto;">
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6" >
			<label class="control-label">Nombre del Cliente</label>
			<input type='text' name="usuario" class='form-control border-input' value="<?php echo $item->usuario; ?>" id="usuario">
			<input type="hidden" name="usuario_id" class='form-control border-input' value="<?php echo $item->usuario_id; ?>" id="usuario_id">
		</div>
	</div>
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Nombre del Lotización</label> 
			<select class='form-control border-input' name="lotizacion_id" id="lotizacion_id" <?php echo $item->id>0? "disabled=disabled ": ''; ?>">
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
			<select class='form-control border-input' name="manzana_id" id="manzana_id" disabled="disabled">
				<option value="" >Seleccione</option>
				<?php foreach ($manzanas as $dato) { ?>
					<option value="<?php echo $dato->id;?>"  <?php if($item->manzana_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
				<?php }?>
			</select>
		</div>
	</div>	
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Número del Lote</label> 
			<select class='form-control border-input' name="lote_id" id="lote_id" disabled="disabled">
				<option value="" >Seleccione</option>
				<?php foreach ($lotes as $dato) { ?>
					<option value="<?php echo $dato->id;?>"  <?php if($item->lote_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
				<?php }?>
			</select>
		</div>
	</div>	
		
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6">
			<label class="control-label">Fecha de Ingreso</label>
			<input type="text" name="fecha_ingreso" id="fecha_ingreso"  class='form-control border-input'  value="<?php echo $item->fecha_ingreso; ?>" size="12" />						
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Valor de Ingreso</label> 
			<input type='text' name="valor_ingreso" class="form-control border-input" value="<?php echo $item->valor_ingreso; ?>" id="valor_ingreso">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Valor de Venta</label> 
			<input type='text'name="valor_venta" class="form-control border-input" value="<?php echo $item->valor_venta; ?>" id="valor_venta">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Código de Promesa</label> 
			<input type='text' name='cod_promesa' class='form-control border-input' value="<?php echo $item->cod_promesa; ?>" id="cod_promesa">
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
	
	jQuery( "#fecha_ingreso" ).datepicker({  
		dateFormat: "yy-mm-dd",
		onClose: function( selectedDate ) {
	        $('#frmAcuerdo').formValidation('revalidateField', 'fecha_ingreso');
	      }  		
	});

	$('#usuario').change(function(){
	    var usuario_id = jQuery("#usuario").val();
	    if(usuario_id.length == 10){
		    jQuery.ajax({
			        type: "GET",
			        dataType: "json",
			        url: "ajax.php",			        
			        data: {
			        	"cedula": usuario_id,
			        	"accion":2
			        },
			        success:function(data) {
				        if(data != -1){
					         jQuery("#usuario").val(data.nombre);
						     jQuery("#usuario_id").val(data.usuario_id);			        	
				        }		
				        else{
					        alert('El cliente no existe, ingrese en la administración de clientes para continuar.');
					        
					    }
				        $('#frmAcuerdo').formValidation('revalidateField', 'usuario');		       
			        }
			});	    
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
	
	$('#frmPagos').formValidation({    	    
			message: 'This value is not valid',
			fields: {
				usuario: {
					message: 'El Nombre del Cliente no es válido',
					validators: {
						notEmpty: {
							message: 'El Nombre del Cliente no puede ser vacío.'
						},					
						regexp: {
							regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ \s]+$/,
							message: 'Ingrese un Nombre del Cliente válido.'
						}
					}
				},
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
				valor_ingreso: {
					message: 'El valor de ingreso no es válida',
					validators: {
						notEmpty: {
							message: 'La valor de ingreso no puede ser vacía.'
						},					
						regexp: {
							regexp: /^([0-9])*[.]?[0-9]*$/,
							message: 'Ingrese un valor de ingreso válido.'
						}
					}
				},		 
				valor_venta: {
					message: 'El valor de venta no es válido',
					validators: {
						notEmpty: {
							message: 'El valor de venta no puede ser vacío.'
						},						
						regexp: {
							regexp: /^([0-9])*[.]?[0-9]*$/,
							message: 'Ingrese un valor de venta válido.'
						}
					}
				},
				cod_promesa: {
					message: 'El código de promesa no es válido',
					validators: {
						notEmpty: {
							message: 'El código de promesa  no puede ser vacío.'
						}
					}
				}						
			}
		});
    });
</script>