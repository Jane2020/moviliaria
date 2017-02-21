<?php
	require("../../modulos/LoteMultaModulo.php");
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id= $_GET['id'];
		$loteMulta = new LoteMulta();
		$accion =$_GET['accion'];
		if($accion != 2){
			switch ($accion) {
				case 0:
					$opciones = $loteMulta->listarManzanasByLotizacion($id);
					break;
				case 1:
					$opciones = $loteMulta->listarLoteByLManzana($id);
					break;				
			}
			echo '<option value="0">Seleccionar</option>';
			foreach ($opciones as $opcion) {
				echo '<option value="'.$opcion->id.'">'.$opcion->nombre.'</option>';
			}		
		}
		else{
			$resultado = $loteMulta->obtenerValorMulta($id);
			if(count($resultado) >0){
				$resultado = $resultado[0]->valor;
				echo $resultado;
			}			
		}
	}
?>