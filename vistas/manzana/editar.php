<?php
require("../../modulos/ManzanaModulo.php");

$manzana = new Manzana();
$item= $manzana->editarManzana();
$lotizaciones = $manzana->listarLotizacion();

$title = (($item->id>0)?'Editar ':'Nueva ').'Manzana';
require_once ("../../template/header.php");

if (isset($_POST['guardar'])){
	$manzana->guardarManzana();
}
?>
<header class="page-header">
	<h1 class="page-title"><?php echo $title; ?></h1>
</header>
<form id="frmLotizacion" method="post" action="">
<div style="overflow: auto;">
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6">
			<label class="control-label">Nombre</label>
			<input type='text' name='nombre' class='form-control' value="<?php echo $item->nombre; ?>" id="nombre">
		</div>
	</div>	
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Descripción</label> 
			<textarea name='descripcion' class='form-control' id="descripcion" rows="5" cols="10">
				<?php echo isset($item->descripcion)?$item->descripcion:null; ?>
			</textarea>
		</div>
	</div>	
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6">
			<label class="control-label">Lotización</label> 
			<select class='form-control' name="lotizacion_id">
				<option value="" >Seleccione</option>
				<?php foreach ($lotizaciones as $dato) { ?>
					<option value="<?php echo $dato->id;?>"  <?php if($item->lotizacion_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
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
</form>