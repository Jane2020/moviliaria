<?php
$title = 'Manzana';
require("../../modulos/ManzanaModulo.php");
require_once ("../../template/header.php");
?>
<header class="page-header">
					<h1 class="page-title"><?php echo $title; ?></h1>
</header>
<p>
   <a href="editar.php" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Multa</a><br/>
</p>
<table id="ghatable" class="display table table-bordered table-stripe" cellspacing="0" width="100%">
	<thead>
          <tr>
               <th>ID</th>
               <th>NOMBRE</th>
               <th>Descripción</th>
               <th>VALOR</th>
               <th>MODIFICAR</th>
               <th>ELIMINAR</th>
          </tr>
     </thead>
     <tbody>
     <?php
          $manzana = new Manzana();
          $listaManzana = $manzana->listarManzanas();
          if(count($listaManzana) > 0){
               foreach ($listaManzana as $row){
     ?>
     	<tr>
            <td><?php echo $row->id ?></td>
            <td><?php echo $row->nombre ?></td>
            <td><?php echo $row->descripcion ?></td>
            <td><?php echo $row->lotizacion ?></td>
            <td>
                <a href="editar.php?id=<?php echo $row->id ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a>
            </td>
            <td>
                <a onclick="return confirm('Desea eliminar el registro')" href="accion.php?id=<?php echo $row->id ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
            </td>
          </tr>
      <?php
               }
          }
      ?>
     </tbody>
</table>	    
<?php
include "../../template/footer.php";
?>