<?php
$title = 'Reportes';
require_once ("../../modulos/ReportesModulo.php");
require_once ("../../template/header.php");
?>
<div class="card">
<div class="header">
<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
		<div class="alert alert-success fade in alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
	</div>
<?php endif;?>

<div class="icon-container">
	<span class="ti-download"></span><span class="icon-name">
		<a href="accion.php?id=1" target="_blank">Descargar</a>
	</span>
</div>
<br>
<div class='header'>
	<h5 class='title' align='center'>REPORTE DE CLIENTES</h5>
</div>
<?php
          $reportes = new Reportes();
          $contador = 1;
          $listaLotes = $reportes->listarLotesByManzana();
          if(count($listaLotes) > 0){
               foreach ($listaLotes as $fila){             
?>
<table class="display table table-bordered table-stripe" cellspacing="0" width="100%">
	<thead>
		  <tr>
		  		<td colspan="7" align="center">
		  			<b>URBANIZACIÓN <?php echo strtoupper($fila->lotizacion); ?></b>
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
            <td colspan="7" align="center" style='background-color:yellow'><b><?php echo strtoupper($fila->manzana); ?></b></td>
        </tr>
        <?php
              foreach ($fila->lotes as $lote){               	
     	?>    
     	<tr>
            <td><?php echo $contador ?></td>
            <td><?php echo $lote->nombres ?></td>
            <td><?php echo $lote->apellidos ?></td>
            <td><?php echo $lote->cedula?></td>
            <td><?php echo $lote->numero_lote ?></td>
            <td><?php echo $lote->valor_total ?></td>            
            <td><?php echo $lote->cod_promesa ?></td>
        </tr>
      	<?php
      			$contador++;
              }        
      ?>
     </tbody>
</table>
<?php
      	}
	}
?>	
 </div>    
 </div>
<?php
require_once ("../../template/footer.php");
?>