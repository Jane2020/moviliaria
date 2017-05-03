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
	 * Función que obtiene el Listado de Lotes por cada cliente
	 */
	public function listarLotesByCliente(){
		$resultado = $this->mysqli->query("SELECT u.id, nombres,apellidos,cedula,telefono,direccion,email,celular,
											l.id as lote_id,numero_lote,lo.nombre as urbanizacion
											FROM usuario as u
											INNER JOIN acuerdo a ON u.id=a.usuario_id
											INNER JOIN lote l ON l.id=a.lote_id
											INNER JOIN manzana m ON m.id=l.manzana_id
											INNER JOIN lotizacion lo ON lo.id=m.lotizacion_id
											where tipo_usuario_id=3 and a.estado=1");
		
		if($resultado != null){
			while( $fila = $resultado->fetch_object() ){
				$data=[];
				$obras = $this->mysqli->query("SELECT li.id, nombre,li.valor
												FROM lote_infraestructura li
												INNER JOIN obras_infraestructura o on o.id= li.infraestructura_id
												where li.eliminado = 0 and lote_id=".$fila->lote_id);
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
	 * Función que obtiene el Listado de Lotes por cada cliente
	 */
	public function pdfLotesByCliente(){
		$listaClientes =self::listarLotesByCliente();
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
					<table class='display table table-stripe' cellspacing='0' width= 100%>
					<tbody>";
					$contador = 0;
					if(count($listaClientes) > 0){
						foreach ($listaClientes as $lote){						
		     				if ($contador == 0){
		     					$html .= "<tr>";
		     				}
		           		$html .= "<td colspan='7' align='center' width='50%' height='100px'>
		            	<table border=1>
		            		<tr><td colspan='2' align='center' style='background-color:#FF00FF'><b>DATOS DEL CLIENTE N°".$lote->id."</b></td></tr>
		            		<tr><td>NOMBRES</td><td>". $lote->nombres."</tr>
				            <tr><td>APELLIDOS</td> <td>". $lote->apellidos."</td></tr>
				            <tr><td>CÉDULA</td><td>". $lote->cedula."</td></tr>
				            <tr><td>TELÉFONO</td><td>". $lote->telefono."</tr>
				            <tr><td>CELULAR</td><td>". $lote->celular."</tr>
				            <tr><td>DIRECCIÓN</td><td>". $lote->direccion."</tr>            
				            <tr><td>EMAIL</td><td>".$lote->email."</tr>
				            <tr><td colspan='2' align='center' style='background-color:#FF00FF'><b>DATOS DEL TERRENO</b></td></tr>
				            <tr><td>URBANIZACIÓN</td><td>". $lote->urbanizacion."</tr>
				            <tr><td>NÚMERO DE LOTE</td><td>". $lote->numero_lote."</tr>";
								foreach ($lote->obras as $obra){               				
		     				$html .= "<tr><td>".strtoupper($obra->nombre)."</td><td>".$obra->valor."</tr>";
		     					}		      				
		            	$html .= "</table><br><br></td>";            
		         if ($contador == 1){
		         	$html .= "</tr>";     
		         }
		        else
			     {
			      	$contador = 0;
			     }
		        $contador++;
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
		$dompdf->stream('clientes', array("Attachment"=>false));
	}
}