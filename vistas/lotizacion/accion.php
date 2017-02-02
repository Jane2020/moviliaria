<?php
	require("../../modulos/LotizacionModulo.php");
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id= $_GET['id'];
		$lotizacion = new Lotizacion();
		$lotizacion->eliminarLotizacion($id);
	}
?>