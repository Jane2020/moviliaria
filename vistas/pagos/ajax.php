<?php
	require("../../modulos/PagosModulo.php");
	$accion =$_GET['accion'];
	$pagos = new Pagos();
	if($accion == 0){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$opciones = $pagos->listarLoteByCedula($id);			
		}
		echo '<option value="0">Seleccionar</option>';
		foreach ($opciones as $opcion) {
			echo '<option value="'.$opcion->id.'">'.$opcion->numero_lote.'</option>';
		}
	}
	if($accion == 1){
		if(isset($_GET['cedula']) && $_GET['cedula'] >0){
			$cedula= $_GET['cedula'];
			$lote_id = $_GET['lote_id'];
			$resultado = $pagos->listarPagos($cedula, $lote_id);
			if(count($resultado) >0){
				$resultado = $resultado[0].$resultado[1];				
				echo $resultado;
			}
		}
	}
?>