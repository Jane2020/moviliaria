<?php
	session_start();
	require("../../modulos/LoteMultaModulo.php");
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id= $_GET['id'];
		$loteMulta = new LoteMulta();
		$loteMulta->eliminarLoteMultas($id);
	}
?>