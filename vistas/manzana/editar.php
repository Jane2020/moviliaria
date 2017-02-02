<?php
require("../../modulos/ManzanaModulo.php");
include "../../template/header.php";

$manzana = new Manzana();
$item= $manzana->editarManzana();

if (isset($_POST['guardar'])){
	$multa->guardarMulta();	
}
?>
<form id="frmLotizacion" method="post" action="">
<div style="overflow: auto;">
	<div class="form-group col-sm-6">
		<label class="control-label">Nombre</label>
		<input type='text' name='nombre' class='form-control' value="<?php echo $item->nombre; ?>" id="nombre">
	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Descripción</label> 
		<textarea name='descripcion' class='form-control' id="descripcion" rows="5" cols="10">
			<?php echo $item->descripcion; ?>
		</textarea>
	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Valor</label> 
		<input type='text' name='valor' class='form-control' value="<?php echo $item->valor; ?>" id="valor">
	</div>
	<div class="form-group">
		<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">		
		<input type='hidden' name='guardar' value="1">
		<button type="submit" name="boton" class="btn btn-default">Guardar</button>		
	</div>
</div>
</form>