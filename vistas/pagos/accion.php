<?php
	session_start();
	require("../../modulos/PagosModulo.php");
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id= $_GET['id'];
		$pagos = new Pagos();
		$pagos->eliminarPagos($id);
	}
?>