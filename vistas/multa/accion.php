<?php
	session_start();
	require("../../modulos/MultaModulo.php");
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id= $_GET['id'];
		$multa = new Multa();
		$multa->eliminarMulta($id);
	}
?>