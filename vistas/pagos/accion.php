<?php
	session_start();
	require("../../modulos/PagosModulo.php");
	$pagos = new Pagos();
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id= $_GET['id'];		
		$pagos->eliminarPagos($id);
	}
	else{
		$cedula= $_GET['ced'];
		$pagos->listaPagosClientePdf($cedula);		
	}
?>