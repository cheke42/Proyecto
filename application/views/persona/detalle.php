<?php $persona = $this->persona_model->get($id);
	$domicilio_actual = $this->datos_domicilio_model->get($persona->domicilio_actual);

	$id_provincia = $this->provincia_ciudad_model->get($domicilio_actual->provincia_ciudad)->id_provincia;
	$id_ciudad = $this->provincia_ciudad_model->get($domicilio_actual->provincia_ciudad)->id_ciudad;

	$empresa = '';
	if (!is_null($persona->empresa)){
		$empresa = $this->empresa_model->get($persona->empresa)->nombre;
	}
	$nacionalidad = '';
	if (!is_null($persona->nacionalidad)){
		$nacionalidad = $this->nacionalidad_model->get($persona->nacionalidad)->nombre;
	}

	
	

	

	$ciudad;

?>

<div id="loader-wrapper">
    <div id="loader"></div>
 
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
 
</div>
<div class="container">
	<div class="row">
		<form class="form-horizontal">
			<fieldset>
				<legend class="text-center">Datos Personales</legend>
				<br>
				<div class="form-group">
					<label for="dni" class="col-lg-2 control-label">DNI</label>
					<div class="col-lg-4">
						<input type="number" class="form-control" id="dni" name="dni" placeholder="DNI sin puntos" required value="<?php echo $persona->dni ?>">
					</div>
					<label for="cuit" class="col-lg-2 control-label">CUIT</label>
					<div class="col-lg-4">
						<input type="number" class="form-control" id="cuit" name="cuit" placeholder="Cuit Sin guión" value="<?php echo $persona->cuit; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="nombre" class="col-lg-2 control-label">Nombre</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required value="<?php echo $persona->nombre ?>">
					</div>
					<label for="apellido" class="col-lg-2 control-label">Apellido</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="apellido" name="apellido" placeholder="1° Apellido" required value="<?php echo $persona->apellido ?>">
					</div>
				</div>
				<div class="form-group">
					
					<label for="segundo_apellido" class="col-lg-2 control-label">2° Apellido</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="2° Apellido" value="<?php echo $persona->segundo_apellido; ?>">
					</div>
					<label for="empresa" class="col-lg-2 control-label">Empresa</label>
					<div class="col-lg-4">
						<select style="width: 100%" name="empresa" id="empresa">
							
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="lugar_nacimiento" class="col-lg-2 control-label">Lugar Nacimiento</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="lugar_nacimiento" name="lugar_nacimiento" placeholder="Lugar de Nacimiento" value="<?php echo $persona->lugar_nacimiento ?>">
					</div>
					<label for="fecha_nacimiento" class="col-lg-2 control-label">Fecha Nacimiento</label>
					<div class="col-lg-4">
						<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required min="1916-01-01" value="<?php echo $persona->fecha_nacimiento ?>" >
					</div>
				</div>
				<div class="form-group">
					<label for="nacionalidad" class="col-lg-2 control-label">Nacionalidad</label>
					<div class="col-lg-4">
						<select style="width: 100%" name="nacionalidad" id="nacionalidad">
							
						</select>
					</div>
					<label for="email" class="col-lg-2 control-label">Mail</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="email" name="email" placeholder="Correo Electrónico" value="<?php echo $persona->email ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="telefonos" class="col-lg-2 control-label">Telefonos</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="telefonos" name="telefonos" placeholder="Telefonos separados por coma" value="<?php echo $persona->telefonos ?>">
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend class="text-center">Domicilio</legend>
				<div class="form-group">
					<label for="provincia" class="col-lg-2 control-label">Provinicia</label>
					<div class="col-lg-4">
						<select  style="width: 100%" name="provincia" id="provincia">
							
						</select>
					</div>
					<label for="ciudad" class="col-lg-2 control-label">Ciudad</label>
					<div class="col-lg-4">
						<select  style="width: 100%" name="ciudad" id="ciudad">
						</select>
					</div>
				</div>
				<div class="form-group">
				 <label for="barrio" class="col-lg-2 control-label">Barrio</label>
				 <div class="col-lg-4">
				 	<input type="text" class="form-control" name="barrio" id="barrio" placeholder="Nombre de Barrio" value="<?php echo $domicilio_actual->barrio ?>">
				 </div>
				 <label for="calle" class="col-lg-2 control-label">Calle</label>
				<div class="col-lg-4">
					<input type="text" class="form-control" name="calle" id="calle" placeholder="Nombre de la calle" value="<?php echo $domicilio_actual->calle ?>">
				</div>
				</div>
				<div class="form-group">
				 <label for="numero" class="col-lg-2 control-label">N°</label>
				 <div class="col-lg-4">
				 	<input type="number" class="form-control" name="numero" id="numero" placeholder="N° de casa" value="<?php echo $domicilio_actual->numero ?>">
				 </div>
				 <label for="piso" class="col-lg-2 control-label">Piso</label>
				<div class="col-lg-4">
					<input type="number" class="form-control" name="piso" id="piso" placeholder="N° de Piso" value="<?php echo $domicilio_actual->piso ?>">
				</div>
				</div>
				<div class="form-group">
				 <label for="departamento" class="col-lg-2 control-label">Departamento</label>
				 <div class="col-lg-4">
				 	<input type="text" class="form-control" name="departamento" id="departamento" placeholder="N° de Departamento" value="<?php echo $domicilio_actual->departamento ?>">
				 </div>
				</div>
				<div class="form-group text-right">
					        <a id="guardar_persona" type="submit" class="btn btn-primary">Guardar</a>
				</div>

			</fieldset>
		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#empresa').select2({
			placeholder: "<?php echo $empresa; ?>",
			allowClear: true
		});

		$('#empresa').select2({
			placeholder: "<?php echo $empresa; ?>",
			allowClear: true
		});


		$('#empresa option:eq(1)').prop('selected', true);
		empresas = JSON.parse('<?php echo json_encode($this->empresa_model->get()) ?>');
		provincias = JSON.parse('<?php echo json_encode($this->provincias_model->get()) ?>');
		paises = JSON.parse('<?php  echo json_encode($this->paises_model->get()) ?>');
		$.each(empresas,function(index, empresa) {
			$('#empresa').append(crearOption(empresa.id,empresa.nombre));
		});
		$.each(paises,function(index, pais) {
			$('#nacionalidad').append(crearOption(pais.id,pais.nombre));
		});
		$.each(provincias,function(index, provincia) {
			$('#provincia').append(crearOption(provincia.id,provincia.provincia_nombre));
		});

		$('#provincia').on('select2:select', function(event) {
			idSeleccionado = $('#provincia').find(":selected").val();
			actualizarCiudades(idSeleccionado);
		});

		function crearOption(id,texto){
			return '<option value="' + id +'">'+ texto +'</option>';
		}

		function actualizarCiudades(idProvincia){
			$("#ciudad").empty();
			$.ajax({
							type: "post",
							url: "<?php echo base_url('ciudad/ciudad_por_provincia'); ?>",
							cache: false,
							data: 'id=' + idProvincia,
							success: function(resp){
								var ciudades =  JSON.parse(resp);
								$.each(ciudades, function(i, ciudad) {
									$('#ciudad').append(crearOption(ciudad.id,ciudad.ciudad_nombre));
								});

							},
							error: function(){
								console.log("Se produjo un error de comunicación con el servidor");
							}
						});

			

		}

		$('#guardar_persona').unbind().click(function(event) {
			var dni = $('#dni').val();
			var cuit = $('#cuit').val();
			var nombre = $('#nombre').val();
			var apellido = $('#apellido').val();
			var segundo_apellido = $('#segundo_apellido').val();
			var lugar_nacimiento = $('#lugar_nacimiento').val();
			var fecha_nacimiento = $('#fecha_nacimiento').val();
			var nacionalidad = $('#nacionalidad').val();
			var email = $('#email').val();
			var telefonos = $('#telefonos').val();
			var provincia = $('#provincia').val()
			var ciudad = $('#ciudad').val()
			var barrio = $('#barrio').val();
			var calle = $('#calle').val();
			var numero = $('#numero').val();
			var piso = $('#piso').val();
			var empresa = $('#empresa').val();
			var departamento = $('#departamento').val();
			$.ajax({
							type: "post",
							url: "<?php echo base_url('persona/save_ajax'); ?>",
							cache: false,
							data: 'dni=' + dni 
									+ '&cuit=' + cuit
									+ '&nombre=' + nombre
									+ '&apellido=' + apellido
									+ '&segundo_apellido=' + segundo_apellido
									+ '&lugar_nacimiento=' + lugar_nacimiento
									+ '&fecha_nacimiento=' + fecha_nacimiento
									+ '&nacionalidad=' + nacionalidad
									+ '&email=' + email
									+ '&telefonos=' + telefonos
									+ '&provincia=' + provincia
									+ '&ciudad=' + ciudad
									+ '&barrio=' + barrio
									+ '&calle=' + calle
									+ '&numero=' + numero 
									+ '&piso=' + piso 
									+ '&departamento=' + departamento
									+ '&empresa=' + empresa
							,success: function(resp){
								window.location.replace("<?php echo base_url('persona/listar'); ?>");
							},
							error: function(){
								console.log("Se produjo un error de comunicación con el servidor");
							}
						});


		});
	
		

	});

	

	
</script>
