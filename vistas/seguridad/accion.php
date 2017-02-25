<?php
	session_start();
	require("../../modulos/SeguridadModulo.php");	
	$seguridad = new Seguridad();
	$accion = $_POST['action'];
	$seguridad->$accion();
	
?>