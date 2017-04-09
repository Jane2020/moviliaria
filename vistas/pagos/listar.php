<?php
$title = 'Pagos';
require_once ("../../modulos/PagosModulo.php");
require_once ("../../template/header.php");
?>
<div style="overflow: auto;">
		<div class="form-group col-sm-12">
			<div class="form-group col-sm-3" >
				<label class="control-label">Ingrese la Cédula del Cliente</label>
				<input type='text' name="cedula" class='form-control border-input' value="" id="cedula">
			</div>
			<div class="form-group col-sm-3" >
				<label class="control-label">Escoja el número de Lote</label>
				<select class='form-control border-input' name="lote_numero" id="lote_numero" disabled>
					<option value="" >Seleccione</option>
					<?php foreach ($lote as $dato) { ?>
						<option value="<?php echo $dato->id;?>"><?php echo $dato->numero_lote;?></option>
					<?php }?>
				</select>
			</div>
			<div class="form-group col-sm-3" >
				<br>
				<button type="submit" name="guardar" id="guardar" class="btn btn-success btn-sm" disabled>Buscar</button>
			</div>		
		</div>	
</div>

<div class="col-md-12" id="pagados">    
</div>

<?php
require_once ("../../template/footer.php");
?>
<script type="text/javascript">
$(document).ready(function() {
	$('#cedula').change(function(){
	    var cedula = jQuery("#cedula").val();
	    if(typeof cedula != 'undefined' &&  cedula != ''){
		    jQuery.ajax({
			        type: "GET",
			        url: "ajax.php",
			        data: {
			        	"id": cedula,
			        	"accion":0
			        },
			        success:function(response) {
			        	  $('#lote_numero').html(response);		        		        				  
			        	  $("#lote_numero").prop('disabled', false);  			           	
			        	  $("#guardar").prop('disabled', false);
			        }
			});	    
	    }
	    else{
	    	$("#lote_numero").prop('disabled', true);  			           	
       	  	$("#guardar").prop('disabled', true);
		}
	});

	$('#guardar').click(function(){	
		  var cedula = jQuery("#cedula").val();
		  var lote_id = jQuery("#lote_numero").val();
		  jQuery.ajax({
		        type: "GET",
		        url: "ajax.php",		        
		        data: {
		        	"cedula": cedula,
		        	"lote_id":lote_id,
		        	"accion":1
		        },
		        success:function(response) {
		        	jQuery("#pagados").html('');
		        	jQuery("#pagados").html(response);		        	  
		        }
		});
	});
	
	
});	
</script>