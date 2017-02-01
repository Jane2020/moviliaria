<?php
require("../../modulos/UsuarioModulo.php");
require("../../modulos/paises.php");
require("../../modulos/cargos.php");
include "../../template/header.php";
if(isset($_GET['u'])){
	if(isset($_POST['bts'])){
		$per = new Personal();
		$per->update();
	}


	$obj = new Personal();
	$persona = $obj->personalPorId($_GET["u"]);
	?>
	<a href="index.php" class="btn btn-success btn-md"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar</a>
	<p><br/></p>
	<div class="panel panel-default">
		<div class="panel-body">

			<form role="form" method="post">
				<input type="hidden" value="<?php echo $persona[0]['id']; ?>" name="id"/>
				<div class="form-group">
					<label for="nm">Nombre</label>
					<input type="text" class="form-control" name="nm" id="nm" value="<?php echo $persona[0]['nombre']; ?>">
				</div>
				<div class="form-group">
					<label for="gd">Sexo</label>
					<select class="form-control" id="gd" name="gd">
						<?php
						if($persona[0]['sexo'] == "Hombre"){
							?>
							<option value="Hombre" selected="selected">Hombre</option>
							<?php
						}else{
							?>
							<option value="Hombre">Hombre</option>
							<?php
						}

						if($persona[0]['sexo'] == "Mujer"){
							?>
							<option value="Mujer" selected="selected">Mujer</option>
							<?php
						}else{
							?>
							<option value="Mujer">Mujer</option>
							<?php
						}
						?>

					</select>
				</div>
				<div class="form-group">
					<label for="tl">Telefono</label>
					<input type="text" class="form-control" name="tl" id="tl" value="<?php echo $persona[0]['telefono']; ?>">
				</div>
				<div class="form-group">
					<label for="ar">Direccion</label>
					<textarea class="form-control" name="ar" id="ar" rows="3"><?php echo $persona[0]['direccion']; ?></textarea>
				</div>
				<div class="form-group">
					<label for="email">Correo</label>
					<input type="email" class="form-control" name="email" id="email" value="<?php echo $persona[0]['correo']; ?>">
				</div>

				<div class="form-group">
					<label for="pais">Pais</label>
					<select class="form-control" name="pais">
						<?php
						$objPaises = new Paises();
						$paises = $objPaises->paises();
						foreach ($paises as $pais) {
							if($persona[0]["idpais"] == $pais["id"]){
								?>
								<option  value="<?php echo $pais["id"]; ?>" selected="selected"><?php echo $pais["pais"]; ?></option>
								<?php
							}else{
								?>
								<option value="<?php echo $pais["id"]; ?>"><?php echo $pais["pais"]; ?></option>
								<?php
							}
							
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
						if($persona[0]["idcargo"] == $cargo["id"]){
								?>
						<option value="<?php echo $cargo["id"]; ?>" selected="selected"><?php echo $cargo["cargo"]; ?></option>
						<?php
							}else{
								?>
						<option value="<?php echo $cargo["id"]; ?>"><?php echo $cargo["cargo"]; ?></option>
						<?php
							}

						
					}
					?>
				</select>
			</div>
				<button type="submit" name="bts" class="btn btn-default">Actualizar</button>
			</form>
			<?php
		}
		include "../../template/footer.php";
		?>
