<?php
	require("../../modulos/PagosModulo.php");
	$accion =$_GET['accion'];
	$pagos = new Pagos();
	if($accion != 2){
			if(isset($_GET['id']) && $_GET['id'] >0){
				$id= $_GET['id'];
				switch ($accion) {
					case 0:
						$opciones = $pagos->listarManzanasByLotizacion($id);
						break;
					case 1:
						$opciones = $pagos->listarLoteByLManzana($id);
						break;
				}
				echo '<option value="0">Seleccionar</option>';
				foreach ($opciones as $opcion) {
					echo '<option value="'.$opcion->id.'">'.$opcion->nombre.'</option>';
				}
			}
	}
	else{
		if(isset($_GET['cedula']) && $_GET['cedula'] >0){
			$cedula = $_GET['cedula'];				
			$resultado = $pagos->obtenerCedula($cedula);
			if(count($resultado) >0){
				$resultado = json_encode($resultado[0]);			
			}
			else{
				$resultado = -1;
			}
			echo $resultado;			
		}
	}
?>