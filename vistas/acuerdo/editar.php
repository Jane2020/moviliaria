<?php
require_once ("../../modulos/AcuerdoModulo.php");
$acuerdo = new Acuerdo();
$item= $acuerdo->editarAcuerdo();
$lotizaciones = $acuerdo->listarLotizaciones();
$tipos_pago = $acuerdo->listarTipoPago();
if($item->id>0){
	$manzanas = $acuerdo->listarManzanasByLotizacion($item->lotizacion_id);
	$lotes = $acuerdo->listarLoteByLManzana($item->manzana_id);
}
$title = (($item->id>0)?'Editar ':'Nuevo ').'Acuerdo';
require_once ("../../template/header.php");



if (isset($_POST['guardar'])){
	$acuerdo->guardarAcuerdo();	
}
?>
 <div class="card">
 <div class="content">
<form id="frmAcuerdo" method="post" action="">
<div style="overflow: auto;">
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6" >
			<label class="control-label">Nombre del Cliente</label>
			<input type='text' name="usuario" class='form-control border-input' value="<?php echo $item->usuario; ?>" id="usuario" <?php echo $item->id>0? "disabled ": ''; ?>>
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
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Código de Promesa</label> 
			<input type='text' name='cod_promesa' class='form-control border-input' value="<?php echo $item->cod_promesa; ?>" id="cod_promesa" <?php echo $item->id>0? "disabled ": ''; ?>>
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Valor Total del Terreno</label> 
			<input type='text' name="valor_total" class="form-control border-input" value="<?php echo $item->valor_total; ?>" id="valor_total" <?php echo $item->id>0? "disabled ": ''; ?>>
		</div>
	</div>
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Tipo de Pago</label> 
			<select class='form-control border-input' name="pago_id" id="pago_id" <?php echo $item->id>0? "disabled=disabled ": ''; ?>>
				<option value="" >Seleccione</option>
				<?php foreach ($tipos_pago as $dato) { ?>
					<option value="<?php echo $dato->id;?>"  <?php if($item->pago_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
				<?php }?>
			</select>
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Valor de Pagar</label> 
			<input type='text'name="valor_inicial" class="form-control border-input" value="<?php echo $item->valor_inicial; ?>" id="valor_inicial" <?php echo $item->id>0? "disabled ": ''; ?>>
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Número de Cuotas</label> 
			<input type='text'name="num_cuotas" class="form-control border-input" value="<?php echo $item->num_cuotas; ?>" id="num_cuotas" <?php echo $item->id>0? "disabled ": ''; ?>>
		</div>
	</div>
		
	<div class="form-group">
		<div class="form-group col-sm-6">
			<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">
		<?php if($item->id==0){?>			
			<input type='hidden' name='guardar' value="1">
			<button type="submit" name="boton" class="btn btn-success btn-sm">Guardar</button>		
			<a href="listar.php" class="btn btn-info btn-sm">Cancelar</a>
		<?php }else{?>
			<a href="listar.php" class="btn btn-info btn-sm">Regresar</a>
		<?php }?>
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

	$('#pago_id').change(function(){
	    var pago_id = jQuery("#pago_id").val();
	    if(pago_id == 1){
		    var valor_total = jQuery("#valor_total").val();
		    jQuery("#valor_inicial").val(valor_total);
		    $("#valor_inicial").prop('disabled', true);
		    jQuery("#num_cuotas").val(1);
		    $("#num_cuotas").prop('disabled', true);
		}
	    else{
	    	jQuery("#valor_inicial").val(null);
	    	 $("#valor_inicial").prop('disabled', false);
			 jQuery("#num_cuotas").val(null);
			 $("#num_cuotas").prop('disabled', false);
		}
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
	
	$('#frmAcuerdo').formValidation({    	    
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
				valor_total: {
					message: 'El valor total del terreno no es válida',
					validators: {
						notEmpty: {
							message: 'La valor total del terreno no puede ser vacío.'
						},					
						regexp: {
							regexp: /^([0-9])*[.]?[0-9]*$/,
							message: 'Ingrese un valor de ingreso válido.'
						}
					}
				},		 
				valor_inicial: {
					message: 'El valor inicial no es válido',
					validators: {
						notEmpty: {
							message: 'El valor inicial no puede ser vacío.'
						},						
						regexp: {
							regexp: /^([0-9])*[.]?[0-9]*$/,
							message: 'Ingrese un valor de venta válido.'
						},
						between: {
                            min: 0,
                            max: 'valor_total',
                            message: 'El valor inicial no puede ser mayor que el valor total del terreno'
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
				},
				pago_id: {
					message: 'El pago no es válido',
					validators: {
						notEmpty: {
							message: 'El pago no puede ser vacío.'
						}
					}
				},						
				num_cuotas:{
					message: 'El número de cuotas no es válido',
					validators: {
						notEmpty: {
							message: 'El número de cuotas no puede ser vacías.'
						},
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Ingrese un número de cuotas válido.'
						}
					}
				},	
			}
		});
    });
</script>