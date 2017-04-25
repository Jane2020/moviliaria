<?php
	require("../../modulos/TraspasoModulo.php");
	$accion =$_GET['accion'];
	$traspaso = new Traspaso();
	if($accion != 2){
		if($accion==10){
			if(isset($_GET['id']) && $_GET['id'] >0){
				$id= $_GET['id'];
				$resultado = $traspaso->getUserBylote($id);
				echo json_encode($resultado[0]);	
			}
		} else {
			if(isset($_GET['id']) && $_GET['id'] >0){
				$id= $_GET['id'];
				switch ($accion) {
					case 0:
						$opciones = $traspaso->listarManzanasByLotizacion($id);
						break;
					case 1:
						$opciones = $traspaso->listarLoteByLManzana($id);
						break;
				}
				echo '<option value="0">Seleccionar</option>';
				foreach ($opciones as $opcion) {
					echo '<option value="'.$opcion->id.'">'.$opcion->nombre.'</option>';
				}
			}
		}
	}
	else{
		if(isset($_GET['cedula']) && $_GET['cedula'] >0){
			$cedula = $_GET['cedula'];				
			$resultado = $traspaso->obtenerCedula($cedula);
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