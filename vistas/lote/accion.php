<?php
	require("../../modulos/LoteModulo.php");
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id= $_GET['id'];
		$lote = new Lote();
		$lote->eliminarLote($id);
	}
?>