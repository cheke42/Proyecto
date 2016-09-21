<?php $ciudades = $this->ciudad_model->get(); ?>
<div class="container">
	<div class="row">
		<h2 class="text-center">Lista de Ciudades</h2>
	</div>
	<br>
	<br>
	<div class="row">
		<div class="hidden-xs col-sm-11 col-md-2 col-lg-3"></div>
		<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
			<div id="toolbar" class="row text-right">
				<a id="nuevo" href="#" class="btn btn-primary" data-toggle="modal" data-target="#accion">Nueva</a>
				<a id="editar" href="#" class="btn btn-primary disabled" data-toggle="modal" data-target="#accion">Editar</a>
				<a id="borrar" href="#" class="btn btn-primary disabled" data-toggle="modal" data-target="#accion">Borrar</a>
			</div>
			<div class="row">
				<div class="table-responsive">
					<table id="ciudades" class="table table-striped table-bordered table-hover dataTable">
					  <thead>
					    <tr>
					      <th class="text-center">Nombre de Ciudad</th>
					    </tr>
					  </thead>
					  <tbody id="tablebody">
					    <?php foreach ($ciudades as $ciudad) { ?>
					    <tr>
					      <td class="text-center"><?php echo $ciudad->ciudad_nombre?></td>
					    </tr>
					    <?php }?>
					  </tbody>
					</table>
				</div> 
			</div>
		</div>
		<div class="hidden-xs col-sm-11 col-md-2 col-lg-3"></div>
	</div>
</div>

<div id="accion" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 id="modalTitle" class="modal-title text-center"></h4>
      </div>
      <div id="modalContent" class="modal-body">
      <select name="provincia" id="provincia">
      	<option value="">Juan</option>
      </select>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="guardar" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

<script>
	$(document).ready(function () {
		$('select').select2();
		var table = $('#ciudades').DataTable();
		 
		    $('#ciudades tbody').on( 'click', 'tr', function () {
		        if ( $(this).hasClass('selected') ) {
		            $(this).removeClass('selected');
		            $('#editar').addClass('disabled');
		            $('#borrar').addClass('disabled');
		        }
		        else {
		            table.$('tr.selected').removeClass('selected');
		            $(this).addClass('selected');
		            $('#editar').removeClass('disabled');
		            $('#borrar').removeClass('disabled');

		        }
		    } );

		    $('#accion').on('shown.bs.modal', function () {
		        $('#nombre').focus();
		    })  

		    $('#nuevo, #editar, #borrar').unbind().click(function(event) {
    			$('#modalTitle').text($(this).text() + ' Ciudad');
    			switch($(this).text()){
    				case 'Nueva':
    					var a = ["nombre"];
    					nuevoFormulario('#modalContent',a);
    					$('#nombre').focusin(function(event) {
    						$('#form-group-nombre').removeClass('has-error');
    						$('.mensaje-error').remove();
    					});
    					break;
    				case 'Editar':
    					console.log('Editar');
    					break;
    				case 'Borrar':
    					console.log('Borrar');
    					break;
    			}
		    });

		    $('#guardar').unbind().click(function(event) {
		    	chequearCiudad($('#nombre').val());
		    });

		    function chequearCiudad(ciudad){
		    	$.ajax({
		    			type: "post",
		    			url: "<?php echo base_url('/ciudad/ciudad_existe_ajax'); ?>",
		    			cache: false,
		    			data: 'ciudad=' + ciudad,
		    			success: function(resp){
		    					if(resp == "existe"){
			    					nombre = $('#nombre');
			    					$('#form-group-nombre').addClass('has-error');
			    					$('#nombre').after('<span class="text-danger mensaje-error">La 	ciudad ya existe</span>');	
		    					}else{
		    						recargarTabla();
		    						cerrarModal();
		    					}
		    			},
		    			error: function(){
		    						console.log('error');
		    			}
				});	
		    }

		    function cerrarModal(){
		    	$('#accion').modal('toggle');
		    	$('#modalContent').empty();
		    }

		    function recargarTabla(){
		    	    	location.reload(true);
		    }

		    function agregarFilaEnTabla(valor){
		    	$('#tablebody').append('<tr><td class="text-center">'+ valor +'</td></tr>');
		    }

		    function nuevoFormulario(seleccionado, elementos){
		    	$(seleccionado).empty();
		    	$(seleccionado).append('<div id="contenedor-inputs" class="form-horizontal"></div>');
		    	agregarProvincias(seleccionado);
		    	agregarInput(elementos);
		    }


		    function agregarInput(elementos){
		    	elementos.forEach(function(entry){
		    		$('#contenedor-inputs').append('<div id="form-group-'+entry+'" class="form-group"><label for="' + entry +'" class="col-lg-2 control-label">'+ primeraMayuscula(entry) +'</label><div class="col-lg-10"><input type="text" class="form-control" id="'+ entry +'" name="'+ entry +'"></div></div>');
		    	});
		    }

		    function primeraMayuscula(string){
		      return string.charAt(0).toUpperCase() + string.slice(1);
		    }

		    function agregarProvincias(seleccionado){
		    	    	$(seleccionado).append('<div class="form-horizontal"><div class="form-group"><label for="nombre" class="col-lg-2 control-label">Provincia</label><div class="col-lg-10"><select style="width: 100%" name="provincias" id="provincias"></select></div></div></div>')
		    	    	$.ajax({
		    	    			type: "post",
		    	    			url: "<?php echo base_url('/provincia/obtener_provincias_ajax'); ?>",
		    	    			cache: false,
		    	    			success: function(resp){
		    	    					provincias = JSON.parse(resp);
		    	    					provincias.forEach(function(entry){
		    	    						$('#provincias').append('<option value="'+entry.id+'">'+entry.provincia_nombre+'</option>');
		    	    					});
		    	    					console.log(provincias);
		    	    			},
		    	    			error: function(){
		    	    						console.log('error');
		    	    			}
		    			});	
		    }

		    




		  
		 
		    // $('#button').click( function () { COMO SELECCIONAR EL CLIQUEADO!
		    //     table.row('.selected').remove().draw( false );
		    // } );
	});
</script>