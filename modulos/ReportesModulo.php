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
		$manzanas = $this->mysqli->query("SELECT distinct(m.id) as manzana_id, m.nombre as manzana, null as lotes
					FROM acuerdo a
					INNER JOIN lote l ON a.lote_id=l.id
					INNER JOIN manzana m ON l.manzana_id=m.id");
		if($manzanas != null){
			while( $fila = $manzanas->fetch_object() ){
				$data=[];					
				$lotes = $this->mysqli->query("SELECT a.id , u.nombres, u.apellidos,u.cedula,l.numero_lote, a.valor_total,a.cod_promesa
													FROM acuerdo a
													INNER JOIN usuario u ON a.usuario_id=u.id
													INNER JOIN lote l ON a.lote_id=l.id
													INNER JOIN manzana m ON l.manzana_id=m.id
													WHERE m.id=".$fila->manzana_id);		
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
	 * Función que obtiene el Pdf de Lotes por Manzanas
	 */
	public function pdfLotesByManzana(){
		$manzanas = $this->mysqli->query("SELECT distinct(m.id) as manzana_id, m.nombre as manzana, null as lotes
					FROM acuerdo a
					INNER JOIN lote l ON a.lote_id=l.id
					INNER JOIN manzana m ON l.manzana_id=m.id");
		if($manzanas != null){
			while( $fila = $manzanas->fetch_object() ){
				$data=[];
				$lotes = $this->mysqli->query("SELECT a.id , u.nombres, u.apellidos,u.cedula,l.numero_lote, a.valor_total,a.cod_promesa
													FROM acuerdo a
													INNER JOIN usuario u ON a.usuario_id=u.id
													INNER JOIN lote l ON a.lote_id=l.id
													INNER JOIN manzana m ON l.manzana_id=m.id
													WHERE m.id=".$fila->manzana_id);
				if($lotes != null){
					while( $fila1 = $lotes->fetch_object() ){
						$data[]= $fila1;
					}
				}
				$fila->lotes = $data;
				$data1[] = $fila;
			}
		}
		//return $data1;
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
					<h5 class='title' align='center'>COMPAÑÍA NUEVO AMANECER DONOVILSA S.A</h5>
					<center><label style='font-size:10px'><b>Urbanización DONOVILSA I</b></label></center><br>
					<center><label style='font-size:10px'><b>Listado de Clientes</b></label></center><br>
					<table width= 100%>
						<thead>
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
          if(count($data1) > 0){
               foreach ($data1 as $fila){             
					$html .="    <tr>
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
            }
        }
      
		$html .="    	</tbody>										
					</table>
				</body>
				</html>";
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf($options);		
		$dompdf->load_html($html);
		
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		$font = FontMetrics::getFont("helvetica", "bold");
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
					INNER JOIN manzana m ON l.manzana_id=m.id");
		if($manzanas != null){
			while( $fila = $manzanas->fetch_object() ){
				$data=[];
				$lotes = $this->mysqli->query("SELECT a.id , u.nombres, u.apellidos,u.cedula,l.numero_lote, a.valor_total,a.cod_promesa
													FROM acuerdo a
													INNER JOIN usuario u ON a.usuario_id=u.id
													INNER JOIN lote l ON a.lote_id=l.id
													INNER JOIN manzana m ON l.manzana_id=m.id
													WHERE m.id=".$fila->manzana_id);
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
}