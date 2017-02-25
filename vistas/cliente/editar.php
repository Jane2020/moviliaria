<?php
require_once ("../../modulos/ClienteModulo.php");
$cliente = new Cliente();
$item= $cliente->editarCliente();

$title = (($item->id>0)?'Editar ':'Nuevo ').'Cliente';
require_once ("../../template/header.php");

if (isset($_POST['guardar'])){
	$cliente->guardarCliente();	
}
?>
 <div class="card">
 <div class="content">
<form id="frmUsuario" method="post" action="">
<div style="overflow: auto;">
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6" >
			<label class="control-label ">Identificación</label>
		<input type='text' name='cedula' class='form-control border-input'
			value="<?php echo $item->cedula; ?>" id="cedula">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Nombres</label> <input type='text'
			name='nombres' class='form-control border-input' 
			value="<?php echo $item->nombres; ?>" id="nombres">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Apellidos</label> <input type='text'
			name='apellidos' class='form-control border-input' 
			value="<?php echo $item->apellidos; ?>" id="apellidos">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Email</label> <input type='text'
			name='email' class='form-control border-input'
			value="<?php echo $item->email; ?>" id="email">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Celular</label> <input type='text'
			name='celular' class='form-control border-input'
			value="<?php echo $item->celular; ?>" id="celular">	
		</div>
	</div>
	
	<div class="form-group">
		<div class="form-group col-sm-6">
			<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">		
			<input type='hidden' name='guardar' value="1">
			<button type="submit" name="boton" class="btn btn-success btn-sm">Guardar</button>		
			<a href="listar.php" class="btn btn-info btn-sm">Cancelar</a>
		</div>
	</div>
</div>
</form>
</div>
</div>
<?php
require_once ("../../template/footer.php");
?>
<script type="text/javascript">
$(document).ready(function() {
    $('#frmUsuario').formValidation({    	    
			message: 'This value is not valid',
			fields: {
				cedula: {
					message: 'La Cédula no es válida',
					validators: {
								notEmpty: {
									message: 'El Número de Cédula no puede ser vacío.'
								},					
								regexp: {
									regexp: /^(?:\+)?\d{10}$/,
									message: 'Ingrese un Número de Cédula válido.'
								},
					
								callback: {
						                message: 'El Número de Cédula no es válido.',
	                         				callback: function (value, validator, $field) {
									    var cedula = value;
									    try {
									        array = cedula.split("");
									    }
									    catch (e) {
									        //array = null;
									    }
									    num = array.length;
									    if (num === 10) {
									        total = 0;
									        digito = (array[9] * 1);
									        for (i = 0; i < (num - 1); i++) {
									            mult = 0;
									            if ((i % 2) !== 0) {
									                total = total + (array[i] * 1);
									            } else {
									                mult = array[i] * 2;
									                if (mult > 9)
									                    total = total + (mult - 9);
									                else
									                    total = total + mult;
									            }
									        }
									        decena = total / 10;
									        decena = Math.floor(decena);
									        decena = (decena + 1) * 10;
									        final = (decena - total);
									        if ((final === 10 && digito === 0) || (final === digito)) {
									
									            return true;
									        } else {
									
									            return false;
									        }
									    } else {
									
									        return false;
									    }
									}
									}
							}
						},
				nombres: {
					message: 'El nombre no es válido',
					validators: {
						notEmpty: {
							message: 'El Nombre no puede ser vacío.'
						},					
						regexp: {
							regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/,
							message: 'Ingrese un Nombre válido.'
						}
					}
				},
				apellidos: {
					message: 'El apellido no es válido',
					validators: {
						notEmpty: {
							message: 'El Apellido no puede ser vacío.'
						},					
						regexp: {
							regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/,
							message: 'Ingrese un Apellido válido.'
						}
					}
				},
				
				celular: {
					message: 'El Celular de Teléfono no es válido',
					validators: {
								notEmpty: {
									message: 'El Número de Celular no puede ser vacío.'
								},					
								regexp: {
									regexp: /^(?:\+)?\d{10}$/,
									message: 'Ingrese un Número de Celular válido.'
								}
							}
					
				},	
				email: {
					message: 'El email no es válida',
					validators: {
						notEmpty: {
							message: 'El Email no puede ser vacío.'
						},	
						regexp: {
							regexp: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
							message: 'Ingrese un email válido.'
						}
					}
				},
				
										
			}
		});
    });
</script>