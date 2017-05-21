<?php
use Dompdf\Options;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;
require_once 'Conexion.php';
require_once 'lib/dompdf/autoload.inc.php';
require_once 'lib/dompdf/src/FontMetrics.php';


class Reportes extends Conexion {
	private $mysqli;
	private $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Lotes por Manzanas
	 */
	public function listarLotesByManzana(){
		$lotizaciones = $this->mysqli->query("SELECT distinct(lt.id) as lotizacion_id,lt.nombre as lotizacion,
				    null as manzanas
					FROM acuerdo a
					INNER JOIN lote l ON a.lote_id=l.id
					INNER JOIN manzana m ON l.manzana_id=m.id
					INNER JOIN lotizacion lt ON lt.id=m.lotizacion_id
				    WHERE a.estado=1");
		if($lotizaciones != null){
			$data=[];
			while( $fila = $lotizaciones->fetch_object() ){		
				$manzanas = $this->mysqli->query("SELECT distinct(m.id) as manzana_id,m.nombre as manzana, null as lotes
							FROM acuerdo a
							INNER JOIN lote l ON a.lote_id=l.id
							INNER JOIN manzana m ON l.manzana_id=m.id
							INNER JOIN lotizacion lt ON lt.id=m.lotizacion_id				
						    WHERE a.estado=1 and lt.id=".$fila->lotizacion_id);
				if($manzanas != null){
					$data1=[];
					while( $fila1 = $manzanas->fetch_object() ){
						$lotes = $this->mysqli->query("SELECT a.id , u.nombres, u.apellidos,u.cedula,l.numero_lote, a.valor_total,a.cod_promesa
															FROM acuerdo a
															INNER JOIN usuario u ON a.usuario_id=u.id
															INNER JOIN lote l ON a.lote_id=l.id
															INNER JOIN manzana m ON l.manzana_id=m.id
															WHERE a.estado=1 and m.id=".$fila1->manzana_id);
						if($lotes != null){
							$data2 = []; 
							while( $fila2 = $lotes->fetch_object() ){
								$data2[]= $fila2;
							}
						}
						$fila1->lotes = $data2;
						$data1[]= $fila1;
					}					
					$fila->manzanas = $data1;
					$data[] = $fila;
				}
			}
		}
		if(isset($data)){
			return $data;
		}
	}	
	
	/**
	 * Función que obtiene el Pdf de Lotes por Manzanas
	 */
	public function pdfLotesByManzana(){
		$data1 =self::listarLotesByManzana();
		$html = "<html>
				<head>				
					<link href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'/>
					<style>
						body {
							margin: 20px 20px 20px 50px; 
						}				
						table{
						   border-collapse: collapse; width: 100%;
						}
						
						td{
						   border:1px solid #ccc; padding:1px;
						   font-size:9pt;
						}
					</style>
				</head>
				<body>
				<table width= 100% border=0 >
						<tr>
							<td width= 10% align='center'>
								<img src='".PATH_FILES."/images/logo.jpg' style='height: 80px; margin-bottom: 5px;'>
								
							</td>
							<td>
										<h3 class='title' align='center'>COMPAÑÍA NUEVO AMANECER DONOVILSA S.A</h3>
					<center><label style='font-size:13px'><b>REPORTE DE CLIENTES</b></label></center><br>
							</td>
						</tr>					
								
					</table>";
				if(count($data1) > 0){
               foreach ($data1 as $fila){       
               	
               	
			   $html .="<table width= 100%>
						<thead>
			   				<tr>
		  						<td colspan='7' align='center'>
		  							<b>Urbanizaci&oacute;n ".($fila->lotizacion)."</b>
		  						</td>
		  					</tr>
							<tr>
			   		               <td><b>N°</b></td>
					               <td><b>NOMBRE</b></td>
					               <td><b>APELLIDO</b></td>
					               <td><b>C.C.N</b></td>
					               <td><b>LOTE N°</b></td>
					               <td><b>VALOR</b></td>
					               <td><b>COD. PROMESA</b></td>               
					          </tr>
					     </thead>
					     <tbody>";
              			foreach ($fila->manzanas as $manz){               	
     	  		       $html .="  <tr>
            						<td colspan='7' align='center' style='background-color:yellow'><b>".($manz->manzana)."</b></td>
        						</tr>";
              				foreach ($manz->lotes as $lote){               	
              		   $html .="   	<tr>
					            	<td>".$lote->id."</td>
						            <td>".$lote->nombres."</td>
						            <td>".$lote->apellidos."</td>
						            <td>".$lote->cedula."</td>
						            <td>". $lote->numero_lote."</td>
						            <td>".$lote->valor_total."</td>            
						            <td>".$lote->cod_promesa."</td>
	        					</tr>";
              				}
              }
              $html .="</tbody></table><br><br>";
            }
        }
        $html .="</body></html>";

        
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf($options);		
		$dompdf->load_html($html);
		
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		// $font = FontMetrics::getFont("helvetica", "bold");
		$canvas->page_text(550, 750, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0)); //header
		$canvas->page_text(270, 770, "Copyright © 2017", $font, 6, array(0,0,0)); //footer			
		$dompdf->stream('general', array("Attachment"=>false));
	}
	
	/**
	 * Función que obtiene el Listado de Clientes
	 */
	public function listarClientesLotización(){
		$manzanas = $this->mysqli->query("SELECT distinct(m.id) as manzana_id, m.nombre as manzana, null as lotes
					FROM acuerdo a
					INNER JOIN lote l ON a.lote_id=l.id
					INNER JOIN manzana m ON l.manzana_id=m.id WHERE a.estado=1");
		if($manzanas != null){
			while( $fila = $manzanas->fetch_object() ){
				$data=[];
				$lotes = $this->mysqli->query("SELECT a.id , u.nombres, u.apellidos,u.cedula,l.numero_lote, a.valor_total,a.cod_promesa
													FROM acuerdo a
													INNER JOIN usuario u ON a.usuario_id=u.id
													INNER JOIN lote l ON a.lote_id=l.id
													INNER JOIN manzana m ON l.manzana_id=m.id
													WHERE a.estado=1 and m.id=".$fila->manzana_id);
				if($lotes != null){
					while( $fila1 = $lotes->fetch_object() ){
						$data[]= $fila1;
					}
				}
				$fila->lotes = $data;
				$data1[] = $fila;
			}
		}
		return $data1;
	}
	
	/**
	 * Función que obtiene el Listado de Obras Pagadas
	 */
	public function listarObrasPagadas(){
		$resultado = $this->mysqli->query("SELECT distinct(m.id) as manzana_id, m.nombre as manzana, lo.id as lotizacion_id, lo.nombre as lotizacion, l.numero_lote, oi.id, p.monto_pagado
						
			FROM lote_infraestructura li
			INNER JOIN obras_infraestructura oi ON oi.id=li.infraestructura_id
			INNER JOIN pago p ON p.id_obra_multa = li.id and p.id_item = 2
			INNER JOIN lote l on l.id=li.lote_id
			INNER JOIN manzana m on m.id=l.manzana_id
			INNER JOIN lotizacion lo on lo.id=m.lotizacion_id
		WHERE lo.eliminado=0
        order by manzana_id, lotizacion_id, numero_lote, oi.id");
	
		$obras = $this->mysqli->query("SELECT * FROM moviliaria.obras_infraestructura where eliminado=0 order by id");
		$obrasArray = array();
		$sumatoria[] = array();
		while( $obra = $obras->fetch_object() ){
			$obrasArray[] = $obra;
			$sumatoria[$obra->id] = 0;
		}
	
		if($resultado != null){
			$data = [];
			$i = 0;
			
			while( $fila = $resultado->fetch_object() ){
	
				if($i == 0){
					$manzana = $fila->manzana_id;
					$lote = $fila->numero_lote;
					$lotizacion = $fila->lotizacion_id;
					array_push ( $data , array('lotizacion' => $fila->lotizacion));
					array_push ( $data , array('manzana' => $fila->manzana));
					array_push ( $data , array('obras'=> $obrasArray));
					$row = array(0 => $fila->numero_lote,$fila->id => $fila->monto_pagado);
					$sumatoria[0] = 'Total';
					$sumatoria[$fila->id] = $sumatoria[$fila->id] + $fila->monto_pagado;
					$i = $i + 1;
				}
	
				if($lotizacion != $fila->lotizacion_id){
					array_push ( $data , array('lote'=> $row));
					array_push ( $data , array('lotizacion'=> $fila->lotizacion));
					array_push ( $data , array('manzana'=> $fila->manzana));
					array_push ( $data , array('obras', $obrasArray));
						
					$row = array(0 => $fila->numero_lote,$fila->id => $fila->monto_pagado);
					$sumatoria[$fila->id] = $sumatoria[$fila->id] + $fila->monto_pagado;
					$manzana = $fila->manzana_id;
					$lote = $fila->numero_lote;
					$lotizacion = $fila->lotizacion_id;
						
				} else {
					if($manzana != $fila->manzana_id){
						array_push ( $data , array('lote'=> $row));
						array_push ( $data , array('manzana'=> $fila->manzana));
						array_push ( $data , array('obras' => $obrasArray));
	
						$row = array(0 => $fila->numero_lote,$fila->id => $fila->monto_pagado);
						$sumatoria[$fila->id] = $sumatoria[$fila->id] + $fila->monto_pagado;
						$manzana = $fila->manzana_id;
						$lote = $fila->numero_lote;
					} else {
						if($lote != $fila->numero_lote){
							array_push ( $data , array('lote'=> $row));
							$row = array(0 => $fila->numero_lote,$fila->id => $fila->monto_pagado);
							$sumatoria[$fila->id] = $sumatoria[$fila->id] + $fila->monto_pagado;
							$lote = $fila->numero_lote;
						} else  {
							$row[$fila->id] = $fila->monto_pagado;
							$sumatoria[$fila->id] = $sumatoria[$fila->id] + $fila->monto_pagado;
						}
					}
				}
			}
			array_push ( $data , array('lote'=> $row));
			array_push ( $data , array('total'=> $sumatoria));
		}
		if(isset($data)){
	
			return $data;
		}
	}
	
	/**
	 * Función que obtiene el Listado de Obras Pagadas
	 */
	public function pdfObrasPagadas(){
		$listaObras =self::listarObrasPagadas();
		$html = "<html>
					<head>
						<link href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'/>
						<style>
						body {
						margin: 20px 20px 20px 50px;
						}
						table{
						border-collapse: collapse; width: 100%;
						}
	
						td{
						border:1px solid #ccc; padding:1px;
						font-size:9pt;
						}
						</style>
					</head>
				<body>
					<table width= 100% border=0 >
						<tr>
							<td width= 10% align='center'>
								<img src='".PATH_FILES."/images/logo.jpg' style='height: 80px; margin-bottom: 5px;'>
								
							</td>
							<td>
										<h3 class='title' align='center'>COMPAÑÍA NUEVO AMANECER DONOVILSA S.A</h3>
					
							</td>
						</tr>					
								
					</table>";
		if(count($listaObras) > 0){
			
			$html .="<table class='display table table-bordered table-stripe' cellspacing='0' width='100%'>";
				
				foreach ($listaObras as $fila){
						
					if(array_key_exists ( 'lotizacion' , $fila )):
						
					$html .="<tr>
							 	<td colspan='5' align='center'>
							  			<b>Urbanizaci&oacute;n ".($fila["lotizacion"])."</b>
							  	</td>
							 </tr>";							
					
							endif;
							if(array_key_exists ( 'manzana' , $fila )):
						
							$html .="<tr>
								            <td colspan='5' align='center' style='background-color:yellow'><b>MANZANA ".($fila["manzana"])."</b></td>
								        </tr> ";
										
										
						endif;
						
						if(array_key_exists ( 'obras' , $fila )):
						$obras = $fila["obras"];
						
						$html .= "<tr>
							<td align=center><b>Lote</b></td>";
							
				              foreach ($fila["obras"] as $val){               	
				     		
				              	$html .= "<td align=center><b>".$val->nombre."</b></td>";				     	    
				      	      }        
				      	      $html .= "</tr>";
				      	      		
						endif;
								
								if(array_key_exists ( 'lote' , $fila )):
						
								$html .= "<tr>
								<td>".$fila["lote"][0]."</td>";
							
				              foreach ($obras as $val){  
				              	$lote = 0;
				              	if(isset($fila["lote"][$val->id])){
				              		$lote = $fila["lote"][$val->id];
				              	}
				              	$html .= "
								<td>".$lote ."</td>";
				     	    
				      	      }        
				      	      $html .= "</tr>";
				      	      		
								endif;
								
								if(array_key_exists ( 'total' , $fila )):
								
								$html .= "<tr>
											<td>". $fila["total"][0]."</td>";
															

								 foreach ($obras as $val){     
								 	$total = 0;
								 	if(isset($fila["total"][$val->id])){
								 		$total = $fila["total"][$val->id];
								 	}
								 	$html .= "
									<td>".$total ."</td>";
								 }
								 $html .= "</tr>";
									
							endif;
								
								
				}
								
					
				$html .= "</table><label style=font-size:11px><br><b>Fecha:</b>".date("d/m/Y")."<br><b>Realizado por:</b>Lcdo. Luis Donoso<br><b>Responsable:</b>Gerente General";     	
				
				
		}
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf($options);
		$dompdf->load_html($html);
	
		$dompdf->render();
		$canvas = $dompdf->getCanvas();
		//$font = FontMetrics::getFont("helvetica", "bold");
		$canvas->page_text(550, 750, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0)); //header
		$canvas->page_text(270, 770, "Copyright © 2017", $font, 6, array(0,0,0)); //footer
		$dompdf->stream('clientes', array("Attachment"=>false));
	}
}