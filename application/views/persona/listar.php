<div class="container">
	<div class="row"><h2 class="text-center">Personas</h2></div>
	<div id="toolbar" class="row text-right">
		<a id="nuevo" href="<?php echo base_url('persona/nueva'); ?>" class="btn btn-primary">Nueva</a>
		<a id="editar" class="btn btn-primary disabled" >Detalle</a>
		<a id="borrar" href="#" class="btn btn-primary disabled" >Borrar</a>
	</div>
	<div class="row">
		<div class="table-responsive">
			<table id="tabladt" class="table table-striped table-bordered table-hover">
			  <thead>
			    <tr>
			      <th class="text-center">DNI</th>
			      <th class="text-center">Apellido y Nombre</th>
			      <th class="text-center">Telefono</th>
			      <th class="text-center">Correo</th>
			    </tr>
			  </thead>
			  <tbody id="tablebody">
			    <?php foreach ($personas as $persona) { ?>
			    <tr id="<?php echo $persona->id; ?>">
			      <td class="text-center"><?php echo $persona->dni;?></td>
			      <td class="text-center"><?php echo $persona->apellido . ' ' . $persona->nombre;?></td>
			      <td class="text-center"><?php echo $persona->telefonos;?></td>
			      <td class="text-center"><?php echo $persona->email;?></td>
			    </tr>
			    <?php }?>
			  </tbody>
			</table>
		</div> 
	</div>
</div>

<script>
	$(document).ready(function() {
		var filaSeleccionada;
		var table = $('#tabladt').DataTable();
		 
		    $('#tabladt tbody').on( 'click', 'tr', function () {
		        if ( $(this).hasClass('selected') ) {
		            $(this).removeClass('selected');
		            $('#editar').addClass('disabled');
		            $('#borrar').addClass('disabled');
		        }
		        else {
		            table.$('tr.selected').removeClass('selected');
		            $('#editar').removeAttr('href');
		            filaSeleccionada = $(this).attr('id');
		            $(this).addClass('selected');
		            $('#editar').attr('href', '<?php echo base_url("/persona/datos/?id="); ?>' + filaSeleccionada);
		            $('#editar').removeClass('disabled');
		            $('#borrar').removeClass('disabled');

		        }
		    } );
	});
</script>