<?php
require("../../modulos/UsuarioModulo.php");
require("../../modulos/paises.php");
require("../../modulos/cargos.php");
include "../../template/header.php";
?>
<a href="index.php" class="btn btn-success btn-md"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar</a>
<?php
if(isset($_POST['bts'])){
	if($_POST['nm']!=null && $_POST['gd']!=null && $_POST['tl']!=null  && $_POST['ar']!=null){
		$paginas = new Personal();
		$paginas->add();
		?>
		<p></p>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<strong>Listo!</strong> Registro guardado con exito... <a href="index.php">Home</a>.
		</div>
		<?php

	} else{
		?>
		<p></p>
		<div class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<strong>Error!</strong> Formulario vacio.
		</div>
		<?php
	}
}
?>

<p><br/></p>
<div class="panel panel-default">
	<div class="panel-body">

		<form role="form" method="post">
			<div class="form-group">
				<label for="nm">Nombre</label>
				<input type="text" class="form-control" name="nm" id="nm" placeholder="Nombre completo">
			</div>
			<div class="form-group">
				<label for="gd">Sexo</label>
				<select class="form-control" id="gd" name="gd">
					<option value="0">-- seleccionar sexo --</option>
					<option value="Hombre">Hombre</option>
					<option value="Mujer">Mujer</option>
				</select>
			</div>
			<div class="form-group">
				<label for="tl">Telefono</label>
				<input type="text" class="form-control" name="tl" id="tl" placeholder="Telefono">
			</div>
			<div class="form-group">
				<label for="ar">Dirección</label>
				<textarea class="form-control" name="ar" id="ar" rows="3"></textarea>
			</div>
			<div class="form-group">
				<label for="email">Correo</label>
				<input type="email" class="form-control" name="email" id="email" placeholder="Correo electronico">
			</div>
			<div class="form-group">
			<label for="pais">Pais</label>
				<select class="form-control" name="pais">
				<option value="0">-- seleccionar pais --</option>
					<?php
					$objPaises = new Paises();
					$paises = $objPaises->paises();
					foreach ($paises as $pais) {
						?>
						<option value="<?php echo $pais["id"]; ?>"><?php echo $pais["pais"]; ?></option>
						<?php
					}
					?>
				</select>
			</div>

			<div class="form-group">
			<label for="cargo">Cargo</label>
				<select class="form-control" name="cargo">
				<option value="0">-- seleccionar cargo --</option>
					<?php
					$objC = new Cargos();
					$cargos = $objC->cargos();
					foreach ($cargos as $cargo) {
						?>
						<option value="<?php echo $cargo["id"]; ?>"><?php echo $cargo["cargo"]; ?></option>
						<?php
					}
					?>
				</select>
			</div>
			<button type="submit" name="bts" class="btn btn-default">Guardar</button>
		</form>
		<?php
		include "../../template/footer.php";
		?>