<?php
require("../../modulos/LoteMultaObraModulo.php");

$loteMultaObra = new LoteMultaObraModulo();
$tipo = $_GET['tipo'];
if($tipo ==1){
	$multas = $loteMultaObra->listarMultas();	
}
else{
	$obras = $loteMultaObra->listaObras();
}
$item= $loteMultaObra->editarLoteMultas();
$lotizaciones = $loteMultaObra->listarLotizaciones();
if($item->id>0){
	$manzanas = $loteMultaObra->listarManzanasByLotizacion($item->lotizacion_id);
	$lotes = $loteMultaObra->listarLoteByLManzana($item->manzana_id);		
}
$title = (($item->id>0)?'Editar ':'Nueva ');
$title .= $_GET['tipo']==1?'Multa del Lote':'Obra de Infraestructura en el Lote';
require_once ("../../template/header.php");
if (isset($_POST['guardar'])){
	$loteMultaObra->guardarLoteMultasObras();
}
?>
 <div class="card">
 <div class="content">
<form id="frmLoteMulta" method="post" action="">
<div style="overflow: auto;">
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Nombre del Lotización</label> 
			<select class='form-control border-input' name="lotizacion_id" id="lotizacion_id">
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
			<select class='form-control border-input' name="manzana_id" id="manzana_id" <?php echo $item->id==0? "disabled=disabled ": ''; ?>">
				<option value="" >Seleccione</option>
				<?php foreach ($manzanas as $dato) { ?>
					<option value="<?php echo $dato->id;?>"  <?php if($item->manzana_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
				<?php }?>
			</select>
		</div>
	</div>	
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Lotes</label>
			<div id="lotes">			
			</div>			
		</div>
	</div>	
	<?php if ($tipo ==1){?>
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Nombre de la Multa</label> <?php echo $item->multa_id ?>
			<select class='form-control border-input' name="multa_id" id="multa_id">
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
	<?php }?>
	<?php if ($tipo ==2){?>
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Nombre de la Obra de Infraestructura</label>
			<select class='form-control border-input' name="obra_id" id="obra_id">
				<option value="" >Seleccione</option>
				<?php foreach ($obras as $dato) { ?>
					<option value="<?php echo $dato->id;?>"  <?php if($item->obra_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
				<?php }?>
			</select>
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6">
			<label class="control-label">Valor</label>
			<input type='text' name='valor' id="valor" class='form-control border-input' value="<?php echo $item->valor; ?>" disabled>			
		</div>
	</div>
	<?php }?>
		
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6">
			<label class="control-label">Fecha de Ingreso</label>
			<input type="text" name="fecha_ingreso" id="fecha_ingreso"  class='form-control border-input'  value="<?php echo $item->fecha_ingreso; ?>" size="12" />						
		</div>
	</div>
	<?php if ($tipo ==1){?>
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Descripción</label> 
			<textarea name='descripcion' class='form-control border-input' id="descripcion" rows="5" cols="10"><?php echo isset($item->descripcion)?$item->descripcion:null; ?></textarea>
		</div>
	</div>
	<?php }?>	
	<div class="form-group">
		<div class="form-group col-sm-6">
			<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">		
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
	    $("#lotes").empty();	    
	    
	    jQuery.ajax({
		        type: "GET",
		        dataType: "json",
		        url: "ajax.php",		        
		        data: {
		        	"id": manzana_id,
		        	"accion":1
		        },
		        success:function(data) {
			        console.log(data);		        	
		        	if(typeof data != 'undefined' && data != null){
		        		$("#lotes").empty();
			        	$.each(data, function (i, val) { 
			        		$('#lotes').append('<input type="checkbox" name="lote_id[]" value='+val.id+ '> '+val.nombre+'<br>');		        		
			        	});    		
			        }   
		        	$('#frmLoteMulta').formValidation('addField', 'lote_id[]', {
		                validators: {
		                    notEmpty: {
		                    	message: 'El lote no puede ser vacío.'
		                        }
		                }
		            });     	
		        }
		}).fail(function() {
			$('#lotes').append('<input type="hidden" name="lote_id[]" value="">');	
			$('#frmLoteMulta').formValidation('addField', 'lote_id[]', {
				excluded: false,
                validators: {
                    
                    notEmpty: {
                    	message: 'El lote no puede ser vacío.'
                        }
                }
            });
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

	$('#obra_id').change(function(){
	    var obra_id = jQuery("#obra_id").val();
	    jQuery.ajax({
		        type: "GET",
		        url: "ajax.php",
		        data: {
		        	"id": obra_id,
		        	"accion":3
		        },
		        success:function(response) {			       
			        $('#valor').val(response);    	
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