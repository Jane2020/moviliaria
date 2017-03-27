<?php
$title = 'Multa en los Lotes';
require("../../modulos/LoteMultaModulo.php");
require_once ("../../template/header.php");
?>
 <div class="card">
 <div class="header">
<p>
<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
		<div class="alert alert-success fade in alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
		</div>
<?php endif;?>
</p>
<p>
   <a href="../generica/editar.php?tipo=1" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true" title="Nuevo"></span></a><br/>
</p>
<table id="dataTables-example" class="display table table-bordered table-stripe" cellspacing="0" width="100%">
	<thead>
          <tr>
               <th>ID</th>
               <th>Nombre del Lote</th>
               <th>Nombre de la Multa</th>
               <th>Valor de la Multa</th>
               <th>Descripción</th>               
               <th>Acción</th>               
          </tr>
     </thead>
     <tbody>
     <?php
          $lote_multa = new LoteMulta();
          $listaLoteMultas = $lote_multa->listarLoteMultas();
          if(count($listaLoteMultas) > 0){
               foreach ($listaLoteMultas as $row){
     ?>
     	<tr>
            <td><?php echo $row->id ?></td>
            <td><?php echo $row->lote ?></td>
            <td><?php echo $row->multa ?></td>
            <td><?php echo $row->valor ?></td>
            <td><?php echo $row->descripcion ?></td>
            <td style="text-align: center;">
                <a title="Editar" href="editar.php?id=<?php echo $row->id ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>
                <a title="Eliminar" class="btn btn-danger btn-sm" onclick="return confirm('Desea eliminar el registro')" href="accion.php?id=<?php echo $row->id ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            </td>
          </tr>
      <?php
               }
          }
      ?>
     </tbody>
</table>	
</div>
</div>    
<?php
include "../../template/footer.php";
?>