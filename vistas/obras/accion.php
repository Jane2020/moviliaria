<?php
	session_start();
	require("../../modulos/ObrasModulo.php");
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id= $_GET['id'];
		$obra = new Obras();
		$obra->eliminarObra($id);
	}
?>