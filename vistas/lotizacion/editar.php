<?php
require("../../modulos/LotizacionModulo.php");
include "../../template/header.php";

$lotizacion = new Lotizacion();
$item= $lotizacion->editarLotizacion();

if (isset($_POST['guardar'])){
	$lotizacion->guardarLotizacion();	
}
?>
<form id="frmLotizacion" method="post" action="">
<div style="overflow: auto;">
	<div class="form-group col-sm-6">
		<label class="control-label">Lotización</label>
		<input type='text' name='nombre' class='form-control' value="<?php echo $item->nombre; ?>" id="nombre">
	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Ciudad</label> 
		<input type='text' name='ciudad' class='form-control' value="<?php echo $item->ciudad; ?>" id="ciudad">
	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Sector</label> 
		<input type='text'name='sector' class='form-control' value="<?php echo $item->sector; ?>" id="sector">
	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Referencia</label> 
		<input type='text' name='referencia' class='form-control' value="<?php echo $item->referencia; ?>" id="referencia">
	</div>
	<div class="form-group">
		<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">		
		<input type='hidden' name='guardar' value="1">
		<button type="submit" name="boton" class="btn btn-default">Guardar</button>		
	</div>
</div>
</form>