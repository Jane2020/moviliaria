<?php
	session_start();
	require("../../modulos/LoteObraModulo.php");
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id= $_GET['id'];
		$loteinfra = new InfraestructuraLote();
		$loteinfra->eliminarLoteInfra($id);
	}
?>