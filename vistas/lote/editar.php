<?php
require_once ("../../modulos/LoteModulo.php");
$lote = new Lote();
$item= $lote->editarLote();
$title = (($item->id>0)?'Editar ':'Nueva ').'Lote';
require_once ("../../template/header.php");

if (isset($_POST['guardar'])){
	$lotizacion->guardarLote();	
}
?>
<header class="page-header">
					<h1 class="page-title"><?php echo $title; ?></h1>
</header>
<form id="frmLotizacion" method="post" action="">
<div style="overflow: auto;">
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6" >
			<label class="control-label">Nombre del Lote</label>
			<input type='text' name='nombre' class='form-control' value="<?php echo $item->nombre; ?>" id="nombre">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Ubicación</label> 
			<input type='text' name='ubicacion' class='form-control' value="<?php echo $item->ubicacion; ?>" id="ubicacion">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Sector</label> 
			<input type='text'name='sector' class='form-control' value="<?php echo $item->sector; ?>" id="sector">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Referencia</label> 
			<input type='text' name='referencia' class='form-control' value="<?php echo $item->referencia; ?>" id="referencia">
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
</form>



<?php
require_once ("../../template/footer.php");
?>