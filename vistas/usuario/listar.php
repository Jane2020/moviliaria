<?php
$title = 'Usuario';
require_once ("../../modulos/UsuarioModulo.php");
require_once ("../../template/header.php");

?>
<header class="page-header">
		<h1 class="page-title"><?php echo $title; ?></h1>
</header>
<p>
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
               <th>Cédula</th>
               <th>Nombres</th>
               <th>Apellidos</th>
               <th>Email</th>
               <th>Celular</th>
               <th>Tipo Usuario</th>
               <th style="width: 15%">Acci&oacute;n</th>
          </tr>
     </thead>
     <tbody>
     <?php
          $usuario = new Usuario();
          $listado = $usuario->listarUsuarios();
          if(count($listado) > 0){
               foreach ($listado as $row){
     ?>
     	<tr>
            <td><?php echo $row->id ?></td>
            <td><?php echo $row->cedula ?></td>
            <td><?php echo $row->nombres ?></td>
            <td><?php echo $row->apellidos?></td>
            <td><?php echo $row->email ?></td>
            <td><?php echo $row->celular ?></td>
            <td><?php echo $row->tipo ?></td>
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
<?php
require_once ("../../template/footer.php");
?>