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
		<a href="accion.php?id=2" target="_blank">Descargar</a>		
	</span>
</div>
<br>
<div class='header'>
	<h5 class='title' align='center'>REPORTE DE PRESUPUESTO DE OBRAS DE INFRAESTRUCTURA</h5>	
</div>

<?php
          $reportes = new Reportes();
          $listaObras = $reportes->listarObrasPagadas();
          if(count($listaObras) > 0){
               foreach ($listaObras as $fila){             
?>

<table class="display table table-bordered table-stripe" cellspacing="0" width="100%">
	<thead>
		 <tr>
		 	<td colspan="7" align="center">
		  			<b>URBANIZACIÓN <?php echo strtoupper($fila->lotizacion); ?></b>
		  	</td>
		 </tr>
		 <tr>	
			<td><b>Lote</b></td>
			<?php
              foreach ($fila->obras as $val){               	
     	  	?>    
	        <td><?php echo $val->obra ?></td>
	        <?php
              }               	
     	 	 ?>     
	     </tr>
     </thead>
     <tbody>
        <tr>
            <td colspan="7" align="center" style='background-color:yellow'><b><?php echo strtoupper($fila->manzana); ?></b></td>
        </tr>    
      	<tr>
     		<td><?php echo $fila->numero_lote ?></td>
     		<?php
              foreach ($fila->obras as $val){               	
     		?>        
     	    <td><?php echo $val->monto_pagado ?></td>
     	    <?php
      	      }        
      	?>                       
        </tr>      	
     </tbody>
</table>      	
<?php
 	}
 }
require_once ("../../template/footer.php");
?>