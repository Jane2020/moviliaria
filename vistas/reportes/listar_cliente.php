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
<a href="accion.php?id=1" target="_blank">Descargar</a>
<div class='header'>
	<h5 class='title' align='center'>Listado de Clientes</h5>	
</div>
<table class="display table table-bordered table-stripe" cellspacing="0" width="100%">
	<thead>
		  <tr>
               <th>N°</th>
               <th>NOMBRE</th>
               <th>APELLIDO</th>
               <th>C.C.N</th>
               <th>LOTE N°</th>
               <th>VALOR</th>
               <th>COD. PROMESA</th>               
          </tr>
     </thead>
     <tbody>
     <?php
          $reportes = new Reportes();
          $listaLotes = $reportes->listarLotesByManzana();
          if(count($listaLotes) > 0){
               foreach ($listaLotes as $fila){             
     ?>
     	<tr>
            <td colspan="7" align="center"><b><?php echo strtoupper($fila->manzana); ?></b></td>
        </tr>
        <?php
              foreach ($fila->lotes as $lote){               	
     	?>    
     	<tr>
            <td><?php echo $lote->id ?></td>
            <td><?php echo $lote->nombres ?></td>
            <td><?php echo $lote->apellidos ?></td>
            <td><?php echo $lote->cedula?></td>
            <td><?php echo $lote->numero_lote ?></td>
            <td><?php echo $lote->valor_total ?></td>            
            <td><?php echo $lote->cod_promesa ?></td>
        </tr>
      	<?php
              }
            }
        }
      ?>
     </tbody>
</table>	
 </div>    
 </div>
<?php
require_once ("../../template/footer.php");
?>