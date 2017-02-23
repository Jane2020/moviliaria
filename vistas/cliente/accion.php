<?php
	session_start();
	require("../../modulos/ClienteModulo.php");
	$cliente = new Cliente();
	$cliente->eliminarCliente();
	
?>