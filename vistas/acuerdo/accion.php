<?php
	session_start();
	require("../../modulos/AcuerdoModulo.php");
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id= $_GET['id'];
		$acuerdo = new Acuerdo();
		$acuerdo->eliminarAcuerdo($id);
	}
?>