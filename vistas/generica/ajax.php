<?php
	require("../../modulos/LoteMultaObraModulo.php");
	if(isset($_GET['id']) && $_GET['id'] >0){
		$id= $_GET['id'];
		
		$loteMultaObra = new LoteMultaObraModulo();
		
		$accion =$_GET['accion'];
		if($accion != 0){
			switch ($accion) {
				case 1:
					$opciones = $loteMultaObra->listarLoteByLManzana($id);
					break;	
				case 2:
					$opciones = $loteMultaObra->obtenerValorMulta($id);
					break;
				case 3:
					$opciones = $loteMultaObra->obtenerValorObra($id);
					break;
			}
			
			if(count($opciones) >0){				
				if($accion == 1){
					$resultado = json_encode($opciones);					
				}else{
					$resultado = $opciones[0]->valor;					
				}
			}		
			else{
				$resultado =-1;
			}
			echo $resultado;
		}
		else{
			$opciones = $loteMultaObra->listarManzanasByLotizacion($id);
			echo '<option value="0">Seleccionar</option>';
			foreach ($opciones as $opcion) {
				echo '<option value="'.$opcion->id.'">'.$opcion->nombre.'</option>';
			}			
		}
	}
?>