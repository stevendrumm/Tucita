<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>OVAULA</title>
	<link rel="stylesheet" href="css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php 
		session_start();
		include 'inc/funciones.php';
		$conexion=new bd();
		$generar=new generar_consulta();
		$mostrar=new mostrar();
		if(!isset($_SESSION['usuario']) & !isset($_SESSION['contrasena'])){
			include "general.php";
		}else{
			$institucion=$_SESSION['institucion'];
			$usuario=$_SESSION['usuario'];
			$contrasena=$_SESSION['contrasena'];
			$consulta="SELECT rol FROM usuario WHERE id_institucion='$institucion' AND nick='$usuario' AND password='$contrasena'";
			$rol=$mostrar->mostrar_bd($consulta);
			if ($rol[0]['rol']=="admin") {
				include 'admin.php';
			}elseif($rol[0]['rol']=="doc"){
				include 'docente.php';
			}else{
				//include 'estudiante.php';
			}
		}
	?>	
	<div class="row">
		<div class="col s12 m12 l12 center">
			<img src="img/slogan-index.png" alt="Slogan OVAULA" class="responsive-img">
	    		<h3>¡La plataforma donde aprender es divertido!</h3>
		</div>
	</div>

	<!-- Modal Structure -->
	<div id="modal-bienvenida">
		<div id="modal1" class="modal">
		    <div class="modal-content">
		    	<div class="col s12 m8 l6 center">
		    		<img src="img/logo-modal.png" alt="Este es el logo de OVAULA" class="responsive-img">
		    		<h3>¡La plataforma donde aprender es divertido!</h3>
		    	</div>
		    </div>
	    	<div class="col s12 m8 l6 center">
	    		<button class="btn hoverable modal-close waves-effect">Empezar</button>
	    	</div>
		</div>
	</div>
	<div id="modal-login" class="modal">
	    <div class="modal-content">
		    <form class="col s12 m8 l6 center">		    	
		        <div class="input-field center">		
			    <input id="buscar-institucion" list="cargar-institucion" autocomplete="on" type="search" required class="validate">
					<label for="buscar-institucion"><i class="material-icons">search</i>Buscar Institución</label>
					<datalist id="cargar-institucion"></datalist>
			    </div>
				<div class="input-field center">
				  <i class="material-icons prefix">account_circle</i>
				  <input id="usuario-login" type="text" required class="validate">
				  <label for="usuario-login">Usuario</label>
				</div>
				<div class="input-field center">
				  <i class="material-icons prefix">vpn_key</i>
				  <input id="contrasena-login" type="password" required class="validate">
				  <label for="contrasena-login">password</label>
				</div>
		    </form>
	    </div>
	    <div class="row s12 m6 l6 center">
	    	<button class="btn hoverable waves-effect" onclick="validar()">Ingresar</button>
	    </div>
  	</div>  	
	<div class="curso">
		<div id="modal-curso" class="modal">
		  	<div class="modal-content">
		  		<div class="input-field center">
		  			<i class="material-icons prefix">filter_9_plus</i>  			
			    	<select name="" id="select-grado">
			    		<option value="" disabled selected>Seleccione el grado</option>
			    		<option value="01">01</option>
			    		<option value="02">02</option>
			    		<option value="03">03</option>
			    		<option value="04">04</option>
			    		<option value="05">05</option>
			    		<option value="06">06</option>
			    		<option value="07">07</option>
			    		<option value="08">08</option>
			    		<option value="09">09</option>
			    		<option value="10">10</option>
			    		<option value="11">11</option>
			    	</select>
			    </div>
			    <div class="input-field center">
		  			<i class="material-icons prefix">text_format</i>  			
			    	<select name="" id="select-nomenclatura">
			    		<option value="" disabled selected>Seleccione la nomenclatura</option>
			    		<option value="A">A</option>
			    		<option value="B">B</option>
			    		<option value="C">C</option>
			    		<option value="D">D</option>
			    		<option value="F">F</option>
			    		<option value="H">H</option>
			    	</select>
			    </div>
		  	</div>
		  	<div class="row s12 m6 l6 center">
		    	<button class="btn hoverable waves-effect" onclick="isertar_curso()">Insertar</button>
		    	<button class="btn hoverable modal-close waves-effect">Cerrar</button>
		    </div>
	  	</div>
	</div>
	<div class="docente">
		<div id="modal-docente" class="modal">
	  		<div class="modal-content">
	  			<div class="input-field center">
					<input id="buscar-docente" list="cargar-docente" autocomplete="on" type="search" required class="validate">
					<label for="buscar-docente"><i class="material-icons">search</i>Buscar docente</label>
					<datalist id="cargar-docente"></datalist>
			        </div>
	  			<div class="input-field center">
	  				<i class="material-icons prefix">account_circle</i>
					<input id="nombre-docente" type="text" required class="validate">
					<label for="nombre-docente">Nombres</label>
	  			</div>
	  			<div class="input-field center">
	  				<i class="material-icons prefix">account_circle</i>
					<input id="apellido-docente" type="text" required class="validate">
					<label for="apellido-docente">Apellidos</label>
	  			</div>
	  			<div class="input-field center">
		  			<i class="material-icons prefix">credit_card</i>  			
			    	<select name="" id="ti-doc-docente">
			    		<option value="" disabled selected>Seleccione el tipo de documento</option>
			    		<option value="CC">Cédula</option>
			    		<option value="CE">Cédula de extranjería</option>
			    	</select>
			    </div>
	  			<div class="input-field center">
	  				<i class="material-icons prefix">credit_card</i>
					<input id="documento-docente" type="text" required class="validate">
					<label for="documento-docente">Documento</label>
	  			</div>
	  			<div class="input-field center">
	  				<i class="material-icons prefix">email</i>
					<input id="email-docente" type="email" required class="validate">
					<label for="email-docente">Correo</label>
	  			</div>
	  			<div class="input-field center">
	  				<i class="material-icons prefix">contact_phone</i>
					<input id="telefono-docente" type="text" required class="validate">
					<label for="telefono-docente">Telefonos</label>
	  			</div>
	  		</div>
	  		<div class="row s12 m6 l6 center">
		    	<button class="btn hoverable waves-effect" onclick="insertar_docente()">Insertar</button>
		    	<button class="btn hoverable modal-close waves-effect">Cerrar</button>
		    </div>
	  	</div>
	</div>
	<div class="estudiante">
		<div id="modal-estudiante" class="modal">
	  		<div class="modal-content">
	  			<div class="input-field center">
					<input id="buscar-estudiante" list="cargar-estudiante" autocomplete="on" type="search" required class="validate">
					<label for="buscar-estudiante"><i class="material-icons">search</i>Buscar estudiante</label>
					<datalist id="cargar-estudiante"></datalist>
			    </div>
	  			<div class="input-field center">
	  				<i class="material-icons prefix">account_circle</i>
					<input id="nombre-estudiante" type="text" required class="validate">
					<label for="nombre-estudiante">Nombres</label>
	  			</div>
	  			<div class="input-field center">
	  				<i class="material-icons prefix">account_circle</i>
					<input id="apellido-estudiante" type="text" required class="validate">
					<label for="apellido-estudiante">Apellidos</label>
	  			</div>
	  			<div class="input-field center">
		  			<i class="material-icons prefix">credit_card</i>  			
			    	<select name="" id="ti-doc-estudiante">
			    		<option value="" disabled selected>Seleccione el tipo de documento</option>
			    		<option value="RC">Registro civil</option>
			    		<option value="TI">Tarjeta de identidad</option>
			    		<option value="CC">Cédula</option>
			    		<option value="CE">Cédula de extranjería</option>
			    	</select>
			    </div>
	  			<div class="input-field center">
	  				<i class="material-icons prefix">credit_card</i>
					<input id="documento-estudiante" type="text" required class="validate">
					<label for="documento-estudiante">Documento</label>
	  			</div>
	  			<div class="input-field center">
	  				<i class="material-icons prefix">email</i>
					<input id="email-estudiante" type="email" required class="validate">
					<label for="email-estudiante">Correo</label>
	  			</div>
	  			<div class="input-field center">
	  				<i class="material-icons prefix">contact_phone</i>
					<input id="telefono-estudiante" type="text" required class="validate">
					<label for="telefono-estudiante">Telefonos</label>
	  			</div>
	  		</div>
	  		<div class="row s12 m6 l6 center">
		    	<button class="btn hoverable waves-effect" onclick="insertar_estudiante()">Insertar</button>
		    	<button class="btn hoverable modal-close waves-effect">Cerrar</button>
		    </div>
	  	</div>
	</div>
	<div class="materia">
  		<div id="modal-materia" class="modal">
  			<div class="modal-content">
  				<div class="input-field center">
	  				<i class="material-icons prefix">event_note</i>
					<input id="materia-materia" type="text" required class="validate">
					<label for="materia-materia">Materia</label>
	  			</div>
  			</div>
  			<div class="row s12 m6 l6 center">
		    	<button class="btn hoverable waves-effect" onclick="insertar_materia()">Insertar</button>
		    	<button class="btn hoverable modal-close waves-effect">Cerrar</button>
		    </div>
  		</div>
  	</div>
  	<div class="periodo">
  		<div id="modal-periodo" class="modal">
  			<div class="modal-content">
  				<div class="input-field center">
	  				<div class="input-field center">
			  			<i class="material-icons prefix">text_fields</i>  			
				    	<select name="" id="periodo-periodo">
				    		<option value="" disabled selected>Seleccione el periodo</option>
				    		<option value="primero">Primer periodo</option>
				    		<option value="segundo">Segundo periodo</option>
				    		<option value="tercero">Tercer periodo</option>
				    		<option value="cuarto">Cuarto periodo</option>
				    	</select>
			    	</div>
			    	<div class="input-field center">
		  				<h5>Fecha de inicio</h5>
	  				</div>
			    	<div class="input-field center">
		  				<i class="material-icons prefix">perm_contact_calendar</i>
						<input id="per-fecha-inicio" type="date" required class="datepicker">
	  				</div>
	  				<div class="input-field center">
		  				<h5>Fecha de finalización</h5>
	  				</div>
			    	<div class="input-field center">
		  				<i class="material-icons prefix">perm_contact_calendar</i>
						<input id="per-fecha-fin" type="date" required class="datepicker">
	  				</div>
	  			</div>
  			</div>
  			<div class="row s12 m6 l6 center">
		    	<button class="btn hoverable waves-effect" onclick="insertar_periodo()">Insertar</button>
		    	<button class="btn hoverable modal-close waves-effect">Cerrar</button>
		    </div>
  		</div>
  	</div>
  	<div class="pensum">
  		<div id="modal-pensum" class="modal">
  			<div class="modal-content">
  				<div class="input-field center">
					<input id="buscar-materia" list="cargar-materia" autocomplete="on" type="search" required class="validate">
					<label for="buscar-materia"><i class="material-icons">search</i>Buscar Materia</label>
					<datalist id="cargar-materia"></datalist>
			    </div>
  				<div class="input-field center">
					<input id="buscar-curso" list="cargar-curso" autocomplete="on" type="search" required class="validate">
					<label for="buscar-curso"><i class="material-icons">search</i>Buscar Curso</label>
					<datalist id="cargar-curso"></datalist>
			    </div>			    
  			</div>
  			<div class="row s12 m6 l6 center">
		    	<button class="btn hoverable waves-effect" onclick="insertar_pensum()">Insertar</button>
		    	<button class="btn hoverable modal-close waves-effect">Cerrar</button>
		    </div>
  		</div>
  	</div>
  	<div class="asignacion">
  		<div id="modal-asignacion" class="modal">
  			<div class="modal-content">
  				<div class="input-field center">
					<input id="buscar-docente-asig" list="cargar-docente-asig" autocomplete="on" type="search" required class="validate">
					<label for="buscar-docente-asig"><i class="material-icons">search</i>Buscar Docente</label>
					<datalist id="cargar-docente-asig"></datalist>
			    </div>
  				<div class="input-field center">
					<input id="buscar-pensum" list="cargar-pensum" autocomplete="on" type="search" required class="validate">
					<label for="buscar-pensum"><i class="material-icons">search</i>Buscar Pensum</label>
					<datalist id="cargar-pensum"></datalist>
			    </div>			    
  			</div>
  			<div class="row s12 m6 l6 center">
		    	<button class="btn hoverable waves-effect" onclick="insertar_asignacion()">Insertar</button>
		    	<button class="btn hoverable modal-close waves-effect">Cerrar</button>
		    </div>
  		</div>  		
  	</div>
  	<div class="matricula">
  		<div id="modal-matricula" class="modal">
  			<div class="modal-content">
  				<div class="input-field center"> 			
			    	<select name="" id="estado-estudiante">
			    		<option value="" disabled selected>Seleccione el estado del estudiante</option>
			    		<option value="AC">Activo</option>
			    		<option value="IN">Inactivo</option>
			    		<option value="RE">Retirado</option>
			    	</select>
			    </div>
  				<div class="input-field center">
					<input id="buscar-estudiante-mat" list="cargar-estudiante-mat" autocomplete="on" type="search" required class="validate">
					<label for="buscar-estudiante-mat"><i class="material-icons">search</i>Buscar Estudiante</label>
					<datalist id="cargar-estudiante-mat"></datalist>
			    </div>
  				<div class="input-field center">
					<input id="buscar-curso-mat" list="cargar-curso-mat" autocomplete="on" type="search" required class="validate">
					<label for="buscar-curso-mat"><i class="material-icons">search</i>Buscar Curso</label>
					<datalist id="cargar-curso-mat"></datalist>
			    </div>			    
  			</div>
  			<div class="row s12 m6 l6 center">
		    	<button class="btn hoverable waves-effect" onclick="insertar_matricula()">Insertar</button>
		    	<button class="btn hoverable modal-close waves-effect">Cerrar</button>
		    </div>
  		</div>  		
  	</div>
  	<div class="examen">
  		<div id="modal-examen" class="modal">
  			<div class="modal-content">
  				<div class="input-field center">
	  				<textarea id="enunciado-examen" class="materialize-textarea"></textarea>
        			<label for="enunciado-examen">Ingrese la descripción del examen</label>
	  			</div>
  				<div class="input-field center">
		  			<h5>Fecha del examen</h5>
	  			</div>
  				<div class="input-field center">
	  				<i class="material-icons prefix">perm_contact_calendar</i>
					<input id="fecha-examen" type="date" required class="datepicker">
	  			</div>
  				<div class="input-field center">
					<input id="examen-asignacion" list="cargar-examen-asignacion" autocomplete="on" type="search" required class="validate">
					<label for="examen-asignacion"><i class="material-icons">search</i>Buscar Asingnacion</label>
					<datalist id="cargar-examen-asignacion"></datalist>
			    </div>
  				<div class="input-field center">
					<input id="examen-periodo" list="examen-periodo" autocomplete="on" type="search" required class="validate">
					<label for="examen-periodo"><i class="material-icons">search</i>Buscar periodo</label>
					<datalist id="examen-periodo"></datalist>
			    </div>			    
  			</div>
  			<div class="row s12 m6 l6 center">
		    	<button class="btn hoverable modal-close waves-effect">Empezar</button>
		    </div>
  		</div>
  	</div>
  	<div class="pregunta">
  		<div id="modal-pregunta" class="modal">
  			<div class="modal-content">
  				<div class="input-field center">
					<input id="buscar-examen" list="cargar-examen" autocomplete="on" type="search" required class="validate">
					<label for="buscar-examen"><i class="material-icons">search</i>Buscar Examen</label>
					<datalist id="cargar-examen"></datalist>
			    </div>
  				<div class="input-field center">
	  				<textarea id="enunciado-pregunta" class="materialize-textarea"></textarea>
        			<label for="enunciado-pregunta">Ingrese la pregunta</label>
	  			</div>
  				<div class="input-field center">
					<input id="pregunta-asignacion" list="pregunta-asignacion" autocomplete="on" type="search" required class="validate">
					<label for="pregunta-asignacion"><i class="material-icons">search</i>Buscar periodo</label>
					<datalist id="pregunta-asignacion"></datalist>
			    </div>
  				<div class="input-field center">
					<input id="pregunta-periodo" list="pregunta-periodo" autocomplete="on" type="search" required class="validate">
					<label for="pregunta-periodo"><i class="material-icons">search</i>Buscar periodo</label>
					<datalist id="pregunta-periodo"></datalist>
			    </div>		    
  			</div>
  			<div class="row s12 m6 l6 center">
		    	<button class="btn hoverable modal-close waves-effect">Empezar</button>
		    </div>
  		</div>
  	</div>
  	<div id="cargar-ruleta"></div>
	<script src="js/jquery2.js"></script>
	<script src="js/materialize.min.js"></script>
	<script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<script>
		$(document).ready(function() {
			var fecha_inicio;
			var fecha_fin;
			$(".button-collapse").sideNav();
			$("#modal1").openModal({dismissible: false});
			$('.modal-trigger').leanModal();
			$('select').material_select();
			$('#per-fecha-inicio').click(function(event) {
			event.stopPropagation();
    		$("#per-fecha-inicio").first().pickadate("picker").open();
			});
			$('#per-fecha-fin').click(function(event) {
				event.stopPropagation();
    			$("#per-fecha-fin").first().pickadate("picker").open();
			});
			$('#fecha-examen').click(function(event) {
				event.stopPropagation();
    			$("#fecha-examen").first().pickadate("picker").open();
			});
			/*$("#per-fecha-inicio").change(function(event) {
				fecha_inicio=document.getElementById('per-fecha-inicio').value;
				fecha_fin=document.getElementById('per-fecha-fin').value;
				document.getElementById('per-fecha-fin').value="";
				if(fecha_inicio!="" && fecha_fin!=""){
					if(fecha_inicio>fecha_fin){
						document.getElementById('per-fecha-inicio').value="";
						document.getElementById('per-fecha-fin').value="";
						alert('la fecha inicial no puede ser mayor que la final');
						$('#per-fecha-inicio').datepicker("hide");
					}else{
						$('#per-fecha-inicio').datepicker("hide");
					}
				}
			});*/
			$('#buscar-institucion').keyup(function(event) {
				if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57)  || (event.keyCode >= 97 && event.keyCode <= 122) || event.keyCode == 08 || event.keyCode == 32) {
					var inst=document.getElementById('buscar-institucion').value;
					$.ajax({
						url: 'inc/buscarInstitucionLogin.php',
						type: 'POST',
						dataType: 'html',
						data: {"key":inst},
					})
					.done(function(data) {
						console.log(data);
						var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
						if (institucion['mensaje']!="no"){
							$('#cargar-institucion').empty();
							$('#cargar-institucion').append('<option label="" disabled selected>Seleccione el tipo de documento</option>');
							for(var i in institucion){
								$('#cargar-institucion').append('<option data-value="'+institucion[i].id+'">'+institucion[i].nombre+'</option>');
							}
						}
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}
			});
			$('#buscar-docente-asig').keyup(function(event) {
				if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57)  || (event.keyCode >= 97 && event.keyCode <= 122) || event.keyCode == 08 || event.keyCode == 32) {
					var inst=document.getElementById('buscar-docente-asig').value;
					$.ajax({
						url: 'inc/buscar-docente.php',
						type: 'POST',
						dataType: 'html',
						data: {"key":inst},
					})
					.done(function(data) {
						console.log(data);
						var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
						$('#cargar-docente-asig').empty();
						$('#cargar-docente-asig').append('<option label="" disabled selected>Seleccione el tipo de documento</option>');
						if (institucion['mensaje']!="no"){							
							for(var i in institucion){
								$('#cargar-docente-asig').append('<option data-value="'+institucion[i].id+'">'+institucion[i].nombre+' '+institucion[i].apellido+' '+institucion[i].id+'</option>');
							}
						}
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}
			});
			$('#buscar-estudiante-mat').keyup(function(event) {
				if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57)  || (event.keyCode >= 97 && event.keyCode <= 122) || event.keyCode == 08 || event.keyCode == 32) {
					var inst=document.getElementById('buscar-estudiante-mat').value;
					$.ajax({
						url: 'inc/buscar-estudiante.php',
						type: 'POST',
						dataType: 'html',
						data: {"key":inst},
					})
					.done(function(data) {
						console.log(data);
						var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
						if (institucion['mensaje']!="no"){
							$('#cargar-estudiante-mat').empty();
							$('#cargar-estudiante-mat').append('<option label="" disabled selected>Seleccione el tipo de documento</option>');
							for(var i in institucion){
								$('#cargar-estudiante-mat').append('<option data-value="'+institucion[i].id+'">'+institucion[i].nombre+' '+institucion[i].apellido+' '+institucion[i].id+'</option>');
							}
						}
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}
			});
			$('#buscar-materia').keyup(function(event) {
				if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 97 && event.keyCode <= 122) || event.keyCode == 08 || event.keyCode == 32) {
					var inst=document.getElementById('buscar-materia').value;
					$.ajax({
						url: 'inc/buscar-materia.php',
						type: 'POST',
						dataType: 'html',
						data: {"key":inst},
					})
					.done(function(data) {
						console.log(data);
						var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
						if (institucion['mensaje']!="no"){
							$('#cargar-materia').empty();
							$('#cargar-materia').append('<option label="" disabled selected>Seleccione el tipo de documento</option>');
							for(var i in institucion){
								$('#cargar-materia').append('<option data-value="'+institucion[i].id+'">'+institucion[i].nombre+'</option>');
							}
						}
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}
			});
			$('#buscar-curso').keyup(function(event) {
				if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57)  || (event.keyCode >= 97 && event.keyCode <= 122) || event.keyCode == 08 || event.keyCode == 32) {
					var inst=document.getElementById('buscar-curso').value;
					$.ajax({
						url: 'inc/buscar-curso.php',
						type: 'POST',
						dataType: 'html',
						data: {"key":inst},
					})
					.done(function(data) {
						console.log(data);
						var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
						if (institucion['mensaje']!="no"){
							$('#cargar-curso').empty();
							$('#cargar-curso').append('<option label="" disabled selected>Seleccione el tipo de documento</option>');
							for(var i in institucion){
								$('#cargar-curso').append('<option data-value="'+institucion[i].id+'">'+institucion[i].id+'</option>');
							}
						}
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}
			});
			$('#buscar-curso-mat').keyup(function(event) {
				if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57)  || (event.keyCode >= 97 && event.keyCode <= 122) || event.keyCode == 08 || event.keyCode == 32) {
					var inst=document.getElementById('buscar-curso-mat').value;
					$.ajax({
						url: 'inc/buscar-curso.php',
						type: 'POST',
						dataType: 'html',
						data: {"key":inst},
					})
					.done(function(data) {
						console.log(data);
						var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
						if (institucion['mensaje']!="no"){
							$('#cargar-curso-mat').empty();
							$('#cargar-curso-mat').append('<option label="" disabled selected>Seleccione el tipo de documento</option>');
							for(var i in institucion){
								$('#cargar-curso-mat').append('<option data-value="'+institucion[i].id+'">'+institucion[i].id+'</option>');
							}
						}
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}
			});
			$('#buscar-pensum').keyup(function(event) {
				if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57)  || (event.keyCode >= 97 && event.keyCode <= 122) || event.keyCode == 08 || event.keyCode == 32) {
					var inst=document.getElementById('buscar-pensum').value;
					$.ajax({
						url: 'inc/buscar-pensum.php',
						type: 'POST',
						dataType: 'html',
						data: {"key":inst},
					})
					.done(function(data) {
						console.log(data);
						var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
						if (institucion['mensaje']!="no"){
							$('#cargar-pensum').empty();
							$('#cargar-pensum').append('<option label="" disabled selected>Seleccione el tipo de documento</option>');
							for(var i in institucion){
								$('#cargar-pensum').append('<option data-value="'+institucion[i].id+'">'+institucion[i].curso+' '+institucion[i].nombre+'</option>');
							}
						}
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}
			});
			$('#examen-asignacion').keyup(function(event) {
				if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 97 && event.keyCode <= 122) || event.keyCode == 08 || event.keyCode == 32) {
					var inst=document.getElementById('examen-asignacion').value;
					$.ajax({
						url: 'inc/buscar-asignacion.php',
						type: 'POST',
						dataType: 'html',
						data: {"key":inst},
					})
					.done(function(data) {
						console.log(data);
						var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
						$('#cargar-examen-asignacion').empty();
						$('#cargar-examen-asignacion').append('<option label="" disabled selected>Seleccione el tipo de documento</option>');
						if (institucion['mensaje']!="no"){							
							for(var i in institucion){
								$('#cargar-examen-asignacion').append('<option data-value="'+institucion[i].id+'">'+institucion[i].materia+' '+institucion[i].nombre+institucion[i].apellido+' '+institucion[i].curso+'</option>');
							}
						}
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}
			});
			/*$('#llamar-login').click(function(event) {
				$.ajax({
					url: 'inc/buscarInstitucionLogin.php',
					type: 'POST',
					dataType: 'html',
					data: {},
				})
				.done(function(data) {
					console.log(data);
					var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
					if (institucion['mensaje']!="no"){
						$("#buscar-institucion").empty();
						$("#buscar-institucion").append('<option value="" disabled selected>Seleccione el tipo de documento</option>')
						for(var i in institucion){
							alert(institucion[i].id+" "+institucion[i].nombre);
							$("#buscar-institucion").append('<option value="'+institucion[i].id+'">'+institucion[i].nombre+'</option>')
						}
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			});*/
		});
		/*function lanzarLogin(){
				
				$("#modal-login").openModal();
		}
		$('#buscar-institucion').change(function(event) {
			var res=$('this').val();
			alert(res);
		});*/
		function validar(){
			var g=$('#buscar-institucion').val();  
			var id = $('#cargar-institucion').find('option').filter(function() { return $.trim( $(this).text() ) === g; }).attr('data-value');
			var user=$('#usuario-login').val();
			var pass=$('#contrasena-login').val();
			$.ajax({
				url: 'inc/recibe-login.php',
				type: 'POST',
				dataType: 'html',
				data: {"institucion":id,"usuario":user,"contrasena":pass},
			})
			.done(function(data) {
				console.log(data);
				var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
				if (institucion['mensaje']=="no"){
					alert("El usuario no se encuentra registrado.");
				}else if(institucion['mensaje']=="incorrecto"){
					alert("El usuario, la contraseña o la institución son incorrectos.");
				}else if (institucion['mensaje']=="si") {
					alert("Se ha autenticado correctamente.");
					location.reload();
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		}
		function isertar_curso(){
			var grado=document.getElementById('select-grado').value;
			var nomen=document.getElementById('select-nomenclatura').value;
			if (grado=="" || nomen=="") {
				alert('Ningún campo puede estar vacío.');
			}else{
				$.ajax({
					url: 'inc/insertar-curso.php',
					type: 'POST',
					dataType: 'html',
					data: {"grado":grado,"nomenclatura":nomen},
				})
				.done(function(data) {
					console.log(data);
					var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
					if (institucion['mensaje']=="no"){
						alert("El curso ya se encuentra registrado.");
					}else if(institucion['mensaje']=="error"){
						alert("Ha ocurrido un error.");
					}else if (institucion['mensaje']=="si") {
						alert("Se ha registrado el curso satisfactoriamente.");
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			}
		}
		function insertar_docente(){
			var nombre=document.getElementById('nombre-docente').value;
			var apellido=document.getElementById('apellido-docente').value;
			var tipo=document.getElementById('ti-doc-docente').value;
			var documento=document.getElementById('documento-docente').value;
			var email=document.getElementById('email-docente').value;
			var telefono=document.getElementById('telefono-docente').value;
			if (nombre=="" || apellido=="" || tipo=="" || documento=="" || email=="" || telefono=="") {
				alert('Ningún campo puede estar vacío.');
			}else{
				$.ajax({
					url: 'inc/insertar-docente.php',
					type: 'POST',
					dataType: 'html',
					data: {"nombre":nombre,"apellido":apellido,"tipo":tipo,"documento":documento,"email":email,"telefono":email},
				})
				.done(function(data) {
					console.log(data);
					var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
					if (institucion['mensaje']=="no"){
						alert("El docente ya se encuentra registrado.");
					}else if(institucion['mensaje']=="error"){
						alert("Ha ocurrido un error.");
					}else if (institucion['mensaje']=="si") {
						alert("Se ha registrado el docente satisfactoriamente.");
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			}
		}
		function insertar_estudiante(){
			var nombre=document.getElementById('nombre-estudiante').value;
			var apellido=document.getElementById('apellido-estudiante').value;
			var tipo=document.getElementById('ti-doc-estudiante').value;
			var documento=document.getElementById('documento-estudiante').value;
			var email=document.getElementById('email-estudiante').value;
			var telefono=document.getElementById('telefono-estudiante').value;
			if (nombre=="" || apellido=="" || tipo=="" || documento=="" || email=="" || telefono=="") {
				alert('Ningún campo puede estar vacío.');
			}else{
				$.ajax({
					url: 'inc/insertar-estudiante.php',
					type: 'POST',
					dataType: 'html',
					data: {"nombre":nombre,"apellido":apellido,"tipo":tipo,"documento":documento,"email":email,"telefono":email},
				})
				.done(function(data) {
					console.log(data);
					var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
					if (institucion['mensaje']=="no"){
						alert("El estudiante ya se encuentra registrado.");
					}else if(institucion['mensaje']=="error"){
						alert("Ha ocurrido un error.");
					}else if (institucion['mensaje']=="si") {
						alert("Se ha registrado el estudiante satisfactoriamente.");
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			}
		}
		function insertar_materia(){
			var materia=document.getElementById('materia-materia').value;
			if (materia=="") {
				alert('El campo no puede estar vacío.');
			}else{
				$.ajax({
					url: 'inc/insertar-materia.php',
					type: 'POST',
					dataType: 'html',
					data: {"nombre":materia},
				})
				.done(function(data) {
					console.log(data);
					var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
					if (institucion['mensaje']=="no"){
						alert("La materia ya se encuentra registrada.");
					}else if(institucion['mensaje']=="error"){
						alert("Ha ocurrido un error.");
					}else if (institucion['mensaje']=="si") {
						alert("Se ha registrado la materia satisfactoriamente.");
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});				
			}
		}
		function insertar_periodo(){
			var periodo=document.getElementById('periodo-periodo').value;
			var input=$('#per-fecha-inicio').pickadate();
			var picker = input.pickadate('picker');
			var inicio=picker.get('select', 'yyyy/mm/dd');
			input=$('#per-fecha-fin').pickadate();//obtengo el formato de fecha en texto
			picker = input.pickadate('picker');//lo convierto en un objeto
			var fin=picker.get('select', 'yyyy/mm/dd');//cambio el formato de texto a numero
			if (periodo=="" || inicio=="" || fin=="") {
				alert('El campo no puede estar vacío.');
			}else{
				$.ajax({
					url: 'inc/insertar-periodo.php',
					type: 'POST',
					dataType: 'html',
					data: {"periodo":periodo,"inicio":inicio,"fin":fin},
				})
				.done(function(data) {
					console.log(data);
					var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
					if (institucion['mensaje']=="no"){
						alert("El periodo ya se encuentra registrado.");
					}else if(institucion['mensaje']=="error"){
						alert("Ha ocurrido un error.");
					}else if (institucion['mensaje']=="si") {
						alert("Se ha registrado el periodo satisfactoriamente.");
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			}
		}
		function insertar_pensum(){
			var g=$('#buscar-materia').val();  
			var id_materia = $('#cargar-materia').find('option').filter(function() { return $.trim( $(this).text() ) === g; }).attr('data-value');
			var g=$('#buscar-curso').val();  
			var id_curso = $('#cargar-curso').find('option').filter(function() { return $.trim( $(this).text() ) === g; }).attr('data-value');
			if (id_materia=="" || id_curso=="") {
				alert('Ningún campo puede estar vacío.');
			}else{
				$.ajax({
					url: 'inc/insertar-pensum.php',
					type: 'POST',
					dataType: 'html',
					data: {"materia":id_materia,"curso":id_curso},
				})
				.done(function(data) {
					console.log(data);
					var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
					if (institucion['mensaje']=="no"){
						alert("El pensum ya se encuentra registrado.");
					}else if(institucion['mensaje']=="error"){
						alert("Ha ocurrido un error.");
					}else if (institucion['mensaje']=="si") {
						alert("Se ha registrado el pensum satisfactoriamente.");
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			}
		}
		function insertar_asignacion(){
			var g=$('#buscar-docente-asig').val();  
			var id_docente = $('#cargar-docente-asig').find('option').filter(function() { return $.trim( $(this).text() ) === g; }).attr('data-value');
			var g=$('#buscar-pensum').val();  
			var id_pensum = $('#cargar-pensum').find('option').filter(function() { return $.trim( $(this).text() ) === g; }).attr('data-value');
			if (id_docente=="" || id_pensum=="") {
				alert('Ningún campo puede estar vacío.');
			}else{
				$.ajax({
					url: 'inc/insertar-asignacion.php',
					type: 'POST',
					dataType: 'html',
					data: {"docente":id_docente,"pensum":id_pensum},
				})
				.done(function(data) {
					console.log(data);
					var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
					if (institucion['mensaje']=="no"){
						alert("La asignacion ya se encuentra registrada.");
					}else if(institucion['mensaje']=="error"){
						alert("Ha ocurrido un error.");
					}else if (institucion['mensaje']=="si") {
						alert("Se ha registrado la asignacion satisfactoriamente.");
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			}
		}
		function insertar_matricula(){
			var g=$('#buscar-estudiante-mat').val();  
			var id_estudiante = $('#cargar-estudiante-mat').find('option').filter(function() { return $.trim( $(this).text() ) === g; }).attr('data-value');
			var g=$('#buscar-curso-mat').val();  
			var id_curso = $('#cargar-curso-mat').find('option').filter(function() { return $.trim( $(this).text() ) === g; }).attr('data-value');
			var estado=document.getElementById('estado-estudiante').value;
			if (estado=="" || id_estudiante=="" || id_curso=="") {
				alert('Ningún campo puede estar vacío.');
			}else{
				$.ajax({
					url: 'inc/insertar-matricula.php',
					type: 'POST',
					dataType: 'html',
					data: {"estado":estado,"estudiante":id_estudiante,"curso":id_curso},
				})
				.done(function(data) {
					console.log(data);
					var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
					if (institucion['mensaje']=="no"){
						alert("La matrícula ya se encuentra registrada.");
					}else if(institucion['mensaje']=="error"){
						alert("Ha ocurrido un error.");
					}else if (institucion['mensaje']=="si") {
						alert("Se ha registrado la matrícula satisfactoriamente.");
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			}
		}
		$('.datepicker').pickadate({
		    onSet: function( arg ){
		        if ( 'select' in arg ){ //prevent closing on selecting month/year
		            this.close();
		            fecha_inicio=new Date($('#per-fecha-inicio').val());
					fecha_fin=new Date($('#per-fecha-fin').val());
					if(fecha_inicio!="" && fecha_fin!=""){
						if(fecha_inicio>fecha_fin || fecha_fin<fecha_inicio){
							document.getElementById('per-fecha-inicio').value="";
							document.getElementById('per-fecha-fin').value="";
							alert('la fecha inicial no puede ser mayor que la final');}
					}
					
		        }
		    },
		    // Strings and translations
			showMonthsShort: undefined,
			showWeekdaysFull: undefined,
			selectYears: 80,

			// Buttons
			today: 'Hoy',
			clear: 'Borrar',
			close: 'Cerrar',

			// Accessibility labels
			labelMonthNext: 'Mes Siguiente',
			labelMonthPrev: 'Mes Anterior',
			labelMonthSelect: 'Seleccionar Mes',
			labelYearSelect: 'Seleccionar Año',

			// Formats
			format: 'dd mmmm, yyyy',
			formatSubmit: 'dd mmmm, yyyy',
			hiddenPrefix: undefined,
			hiddenSuffix: '_submit',
			hiddenName: true,

			// Editable input
			editable: undefined,

			// Dropdown selectors
			selectYears: true,
			selectMonths: true,

			// First day of the week
			firstDay: 1,

			// Date limits
			min: undefined,
			max: undefined,
			yearRange: '1950:'+new Date().getFullYear().toString(),

			// Disable dates
			disable: undefined,

			// Root picker container
			container: undefined,

			// Hidden input container
			containerHidden: undefined,

			// Close on a user action
			closeOnSelect: true,
			closeOnClear: true,

			// Events
			onStart: undefined,
			onRender: undefined,
			onOpen: undefined,
			onClose: true,
			onStop: undefined,

			// Classes
			klass: {

			  // The element states
			  input: 'picker__input',
			  active: 'picker__input--active',

			  // The root picker and states *
			  picker: 'picker',
			  opened: 'picker--opened',
			  focused: 'picker--focused',

			  // The picker holder
			  holder: 'picker__holder',

			  // The picker frame, wrapper, and box
			  frame: 'picker__frame',
			  wrap: 'picker__wrap',
			  box: 'picker__box',

			  // The picker header
			  header: 'picker__header',

			  // Month navigation
			  navPrev: 'picker__nav--prev',
			  navNext: 'picker__nav--next',
			  navDisabled: 'picker__nav--disabled',

			  // Month & year labels
			  month: 'picker__month',
			  year: 'picker__year',

			  // Month & year dropdowns
			  selectMonth: 'picker__select--month',
			  selectYear: 'picker__select--year',

			  // Table of dates
			  table: 'picker__table',

			  // Weekday labels
			  weekdays: 'picker__weekday',

			  // Day states
			  day: 'picker__day',
			  disabled: 'picker__day--disabled',
			  selected: 'picker__day--selected',
			  highlighted: 'picker__day--highlighted',
			  now: 'picker__day--today',
			  infocus: 'picker__day--infocus',
			  outfocus: 'picker__day--outfocus',

			  // The picker footer
			  footer: 'picker__footer',

			  // Today, clear, & close buttons
			  buttonClear: 'picker__button--clear',
			  buttonClose: 'picker__button--close',
			  buttonToday: 'picker__button--today'
			}
		});
		$('select').material_select();

		
		$('.datepicker').pickadate({
			
					
		});
		function login(){

		}
	</script>
</body>
</html>