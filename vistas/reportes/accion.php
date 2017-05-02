<?php
	session_start();
	require("../../modulos/ReportesModulo.php");	
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id = $_GET['id'];
		$reportes = new Reportes();
		if($id==1){
			$reportes->pdfLotesByManzana();	
		}		
		if($id==2){
			$reportes->pdfLotesByCliente();
		}
	}
?>