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
		$manzanas = $this->mysqli->query("SELECT distinct(m.id) as manzana_id,lt.nombre as lotizacion,
				    m.nombre as manzana, null as lotes
					FROM acuerdo a
					INNER JOIN lote l ON a.lote_id=l.id
					INNER JOIN manzana m ON l.manzana_id=m.id
					INNER JOIN lotizacion lt ON lt.id=m.lotizacion_id				
				    WHERE a.estado=1");
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
		if(isset($data1)){
			return $data1;
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
					<center><label style='font-size:13px'><b>Listado de Clientes</b></label></center><br>
							</td>
						</tr>					
								
					</table>";
				if(count($data1) > 0){
               foreach ($data1 as $fila){          
			   $html .="<table width= 100%>
						<thead>
			   				<tr>
		  						<td colspan='7' align='center'>
		  							<b>URBANIZACIÓN ".strtoupper($fila->lotizacion)."</b>
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
					     <tbody>				
          		         <tr>
            						<td colspan='7' align='center' style='background-color:yellow'><b>".strtoupper($fila->manzana)."</b></td>
        						</tr>";
              foreach ($fila->lotes as $lote){               	
              	$html .="    	<tr>
					            	<td>".$lote->id."</td>
						            <td>".$lote->nombres."</td>
						            <td>".$lote->apellidos."</td>
						            <td>".$lote->cedula."</td>
						            <td>". $lote->numero_lote."</td>
						            <td>".$lote->valor_total."</td>            
						            <td>".$lote->cod_promesa."</td>
	        					</tr>";
      	
              }
              $html .="</tbody></table>";
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
		$resultado = $this->mysqli->query("SELECT distinct(m.id) as manzana_id, m.nombre as manzana, lo.id as lotizacion_id, lo.nombre as lotizacion, l.numero_lote
											FROM lote_infraestructura li
											INNER JOIN obras_infraestructura oi ON oi.id=li.infraestructura_id
											INNER JOIN pago p ON p.id_obra_multa = li.id
											INNER JOIN lote l on l.id=li.lote_id
											INNER JOIN manzana m on m.id=l.manzana_id
											INNER JOIN lotizacion lo on lo.id=m.lotizacion_id
											WHERE lo.eliminado=0");
		if($resultado != null){
			while( $fila = $resultado->fetch_object() ){
				$data=[];
				$obras = $this->mysqli->query("SELECT oi.id,oi.nombre as obra, p.monto_pagado
												FROM lote_infraestructura li
												INNER JOIN obras_infraestructura oi ON oi.id=li.infraestructura_id
												INNER JOIN pago p ON p.id_obra_multa = li.id
												INNER JOIN lote l on l.id=li.lote_id
												INNER JOIN manzana m on m.id=l.manzana_id
												INNER JOIN lotizacion lo on lo.id=m.lotizacion_id
												where lo.id=".$fila->lotizacion_id);
				if($obras != null){
					while( $fila1 = $obras->fetch_object() ){
						$data[]= $fila1;
					}
				}
				$fila->obras = $data;
				$data1[] = $fila;
			}
		}
		if(isset($data1)){
			return $data1;
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
			foreach ($listaObras as $fila){
				$html .="<table width= 100%>
						<thead>
							 <tr>
							 	<td colspan=4 align=center>
							  			<b>URBANIZACIÓN".strtoupper($fila->lotizacion)."</b>
							  	</td>
							 </tr>
							 <tr>
								<td align=center><b>Lote</b></td>";
				foreach ($fila->obras as $val){
					$html .="<td align=center><b>".$val->obra."</b></td>";
				}
				$html .="</tr>
					     </thead>
					     <tbody>
					        <tr>
					            <td colspan=4 align=center style='background-color:yellow'><b>".strtoupper($fila->manzana)."</b></td>
					        </tr>
					      	<tr>
					     		<td>".$fila->numero_lote."</td>";
				foreach ($fila->obras as $val){
					$html .="<td>".$val->monto_pagado."</td>";
				}
				$html .="
					        </tr>
					     </tbody>
					</table>";
			}
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