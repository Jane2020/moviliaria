<?php
	session_start();
	require("../../modulos/ManzanaModulo.php");
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id= $_GET['id'];
		$manzana = new Manzana();
		$manzana->eliminarManzana($id);
	}
?>