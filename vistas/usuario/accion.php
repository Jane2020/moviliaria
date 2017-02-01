<?php
require("../../modulos/UsuarioModulo.php");
if(isset($_GET['d'])){
	$persona = new Personal();
	$persona->delete($_GET["d"]);
}
?>
