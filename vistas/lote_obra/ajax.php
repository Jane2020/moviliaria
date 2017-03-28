<?php
	require("../../modulos/LoteObraModulo.php");
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id= $_GET['id'];
		$loteInfra = new InfraestructuraLote();
		$accion =$_GET['accion'];
		if($accion != 2){
			switch ($accion) {
				case 0:
					$opciones = $loteInfra->listarManzanasByLotizacion($id);
					break;
				case 1:
					$opciones = $loteInfra->listarLoteByLManzana($id);
					break;				
			}
			echo '<option value="0">Seleccionar</option>';
			foreach ($opciones as $opcion) {
				echo '<option value="'.$opcion->id.'">'.$opcion->nombre.'</option>';
			}		
		}
		else{
			$resultado = $loteInfra->obtenerValorObra($id);
			if(count($resultado) >0){
				$resultado = $resultado[0]->valor;
				echo $resultado;
			}			
		}
	}
?>