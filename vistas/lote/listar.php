<?php
$title = 'Lote';
require_once ("../../modulos/LoteModulo.php");
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
</p>
<p>
   <a href="editar.php" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true" title="Nuevo"></span></a><br/>
</p>
<table id="dataTables-example" class="display table table-bordered table-stripe" cellspacing="0" width="100%">
	<thead>
          <tr>
               <th>ID</th>
               <th>Nombre</th>
               <th>Ubicación</th>
               <th>Dimensión</th>
               <th>Número de Lote</th>
               <th>Disponibilidad</th>
               <th>Manzana</th>
               <th style="width: 15%">Acci&oacute;n</th>
          </tr>
     </thead>
     <tbody>
     <?php
          $lote = new Lote();
          $listaLote = $lote->listarLotes();
          if(count($listaLote) > 0){
               foreach ($listaLote as $row){
     ?>
     	<tr>
            <td><?php echo $row->id ?></td>
            <td><?php echo $row->nombre ?></td>
            <td><?php echo $row->ubicacion ?></td>
            <td><?php echo $row->dimension?></td>
            <td><?php echo $row->numero_lote ?></td>
            <td><?php echo ($row->disponible)?"Disponible":"No Disponible" ?></td>
            <td><?php echo $row->manzana_nombre ?></td>
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
require_once ("../../template/footer.php");
?>