<?php
	session_start();
	require("../../modulos/UsuarioModulo.php");
	$usuario = new Usuario();
	$usuario->eliminarUsuario($id);
	
?>