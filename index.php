<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sistema de citas de la ACIN</title>
	<!--link rel="stylesheet" href="css/materialize.min.css" -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php
	
	//phpinfo(); 94474820
	?>
<div class="navbar-fixed">
	<nav class="green darken-1">
		<container class="nav-wraper">
			<a href="index.php" class="brand-logo"><img src="img/letras2.png" alt="Imagen del nombre de la palicación"></a>
			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<li><a class="waves-effect waves-light btn modal-trigger" href="#modal-login">Reservar cita</a></li>
				<li><a href="badges.html">Contáctenos</a></li>
			</ul>
			<ul class="side-nav" id="mobile-demo">
				<li><a class="waves-effect waves-light btn modal-trigger" href="#modal-login">Reservar cita</a></li>
				<li><a href="badges.html">Contáctenos</a></li>
			</ul>
		</container>
	</nav>
</div>
<div class="main">
	<div class="row">
		<div class="col s12 m6 l7">
			<img src="img/haztucita2.png" alt="Imagen del logo de la ardillita haztucita" class="circle responsive-img"/>
		</div>
		<div class="col s12 m5 l3">
			<div class="card small">
				<div class="card-image waves-effect waves-block waves-light">
				  <img class="activator" src="img/tucitaapp.png">
				</div>
				<div class="card-content">
				  <span class="card-title activator grey-text text-darken-4"><i class="material-icons">android</i>TucitaApp<i class="material-icons right">more_vert</i></span>
				  <p> <a target="_blank" class="btn-floating btn-large waves-effect waves-light green" href="https://www.facebook.com/haztucita"><i class="material-icons">touch_app</i></a></p>
				</div>
				<div class="card-reveal">
				  <span class="card-title grey-text text-darken-4">TucitaApp<i class="material-icons right">close</i></span>
				  <p>Próximaente reserva tu cita médica desde cualquier lugar y a cualquier hora desde tu celular.</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modal-login" class="modal">
	<div class="modal-content" id="buscarPersona">
	    <form class="col s12 m10 l10 center" id="formCita" onsubmit="return buscar(this);">
		    <div class="input-field col s12">
	  			<i class="material-icons">credit_card</i>  			
		    	<select id="tipoDocumento" name="tipoDocumento">
		    		<option value="" disabled selected>Seleccione el tipo de documento</option>
		    		<option value="4">Registro civil</option>
		    		<option value="2">Tarjeta de identidad</option>
		    		<option value="1">Cédula</option>
		    		<option value="3">Cédula de extranjería</option>
		    	</select>
		    </div>
			<div class="input-field center">
			  <i class="material-icons">dialpad</i>
			  <label id="bold" for="documento">Documento</label>
			  <input id="documento" name="documento" type="text" required class="validate">
			  
			</div>
	    </form>
	</div>
	<div class="row s12 m6 l6 center" id="botonBuscar">
		<button class="btn waves-effect waves-light" onclick="buscar(formCita)"><i class="material-icons right">search</i>Buscar</button>		
	</div>
	<div class="modal-content" id="mostrarPersona">
		<div id="datosPersona">
			<i class="material-icons medium">perm_identity</i>
		</div>
	    <div id="fecha">
	    	<i class="material-icons prefix">perm_contact_calendar</i>
	    	<label for="fecha-cita">Seleccione la fecha en que desea la cita.</label>
			<input id="fecha-cita" type="date" required class="datepicker">
	    </div>
	    <div id="centro-prod">
	    	 <div class="input-field col s12">
	  			<i class="material-icons">assignment</i>		
		    	<select id="centro" name="centro">
		    		<option value="" disabled selected>Seleccione el tipo de consulta.</option>
		    		<option value='1110'>Médico general.</option>
  					<option value='1301'>Odontología.</option>
		    	</select>
		    </div>
	    </div>
	    <div id="profesional" class="input-field col s12 profesional">
  			<i class="material-icons">local_pharmacy</i>  			
	    	<select name="mySelect" id="mySelect" class="mySelect"></select>
	    </div>
	    <div id="hora">
	    	<div class="input-field col s12">
	  			<i class="material-icons">alarm</i>  			
		    	<select id="hora-reserva" name="hora-reserva"></select>
		    </div>
	    </div>
	</div>
	<div class="row s12 m6 l6 center" id="cargarDatos">
		<button class="btn waves-effect waves-light" onclick="volver();"><i class="material-icons right">reply</i>volver</button>
		<button class="btn waves-effect waves-light" onclick="reservarCita();"><i class="material-icons right">save</i>Reservar cita</button>
		<button class="btn waves-effect waves-light" onclick="recargar();"><i class="material-icons right">delete_forever</i>Cancelar</button>
	</div>
</div>

<script type="text/javascript" src="js/jquery2.js"></script>
<!--script type="text/javascript" src="js/materialize.min.js"></script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="js/jQueryRotate.js"></script>
<script type="text/javascript">
	var nombre1="";	var nombre2="";	var apellido1=""; var apellido2="";	var tipo=""; var documento=""; var ips=""; var fecha=""; var centro=""; var profesional=""; var hora="";var nombrepro="";
	$(document).ready(function() {
		$('.modal-trigger').leanModal();
		$('select').material_select();
		$(".button-collapse").sideNav();
	});
	
	$('#fecha-cita').change(function(event) {
		$('#centro').val("");//se4 vuelve a seleccionar el valor por defecto del option
		$('#mySelect').empty();
		$('#hora-reserva').empty();
		$('#centro').material_select();//recargo la lista del select de materialize para que muestre los campos agregados.
		$('#mySelect').material_select();//recargo la lista del select de materialize para que muestre los campos agregados.
		$('#hora-reserva').material_select();//recargo la lista del select de materialize para que muestre los campos agregados.
	});

	$('#centro').change(function(event) {
		var input=$('#fecha-cita').pickadate();//obtengo el formato de fecha en texto
		var picker = input.pickadate('picker');//lo convierto en un objeto
		fecha=picker.get('select', 'yyyy-mm-dd');//cambio el formato de texto a numero
		centro=document.getElementById('centro').value;
		$.ajax({
			url: 'inc/buscar-profesional.php',
			type: 'POST',
			dataType: 'html',
			data: {"centro":centro,"fecha":fecha},
		})
		.done(function(data) {
			console.log(data);
			var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
			if (institucion['mensaje']=="no"){
				alert('No hay registros asociados con los datos ingresados.');
			}else {
				$('#mySelect').empty();
				$('#hora-reserva').empty();
				$('#mySelect').append('<option value="" disabled selected>Seleccione el profesional de preferencia</option>');
				for(var i in institucion){
					$("#mySelect").append("<option value='" + institucion[i].CODIGO + "'>" + institucion[i].NOMBRE + "</option>");
				}
				 $('#mySelect').material_select();//recargo la lista del select de materialize para que muestre los campos agregados.
				 $('#hora-reserva').material_select();//recargo la lista del select de materialize para que muestre los campos agregados.
			}
		})
		
	});

	$('#mySelect').change(function(event) {
		var input=$('#fecha-cita').pickadate();//obtengo el formato de fecha en texto
		var picker = input.pickadate('picker');//lo convierto en un objeto
		var inicio=picker.get('select', 'yyyy-mm-dd');//cambio el formato de texto a numero
		profesional=document.getElementById('mySelect').value;
		nombrepro=$('#mySelect option:selected').text();
		$.ajax({
			url: 'inc/buscar-hora.php',
			type: 'POST',
			dataType: 'html',
			data: {"fecha":inicio,"profesional":profesional},
		})
		.done(function(data) {
			console.log(data);
			var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
			if (institucion['mensaje']=="no"){
				alert('No hay registros asociados con los datos ingresados.');
			}else {
				$('#hora-reserva').empty();
				$('#hora-reserva').append('<option value="" disabled selected>Seleccione la hora en la cual desea la cita.</option>');
				for(var i in institucion){
					$("#hora-reserva").append("<option value='"+institucion[i].HORA +"'>" + institucion[i].HORA + "</option>");
				}
				 $('#hora-reserva').material_select();//recargo la lista del select de materialize para que muestre los campos agregados.
			}
		})
	});

	function reservarCita(){
		hora=document.getElementById('hora-reserva').value;
		var nomcen=$('#centro option:selected').text()
		//alert(nombre1+' '+nombre2+' '+apellido1+' '+apellido2+' '+tipo+' '+documento+' '+ips+' '+fecha+' '+centro+' '+profesional+' '+hora);
		if(nombre1=="" || nombre2=="" || apellido1=="" || apellido2=="" || tipo=="" || documento=="" || ips=="" || fecha=="" || centro=="" || profesional=="" || hora==""){
			alert('Ningún campo puede estar vacío.');
		}else{
			var pregunta=confirm('¿Desea reservar la cita para el '+fecha+' a las '+hora+' con el profesional '+nombrepro+'?');
			if (pregunta==true){
				$.ajax({
					url: 'inc/actualizar-cita.php',
					type: 'POST',
					dataType: 'html',
					data: {"nombre1":nombre1,"nombre2":nombre2,"apellido1":apellido1,"apellido2":apellido2,"tipo":tipo,"documento":documento,"ips":ips,"fecha":fecha,"centro":centro,"profesional":profesional,"hora":hora},
				})
				.done(function(data) {
					console.log(data);
					var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
					if (institucion['mensaje']=="no"){
						alert('Ha ocurrido un error en el proceso, por favor intentelo nuevamente o cambie de hora o profesional.');
					}else if (institucion['mensaje']=="si"){
						alert('La cita se reservó satisfactoriamente para el '+fecha+' a las '+hora+' con el profesional '+nombrepro+'.');
					}else if (institucion['mensaje']=="ya"){
						alert('Ya tiene reservada una cita reservada para: '+nomcen+'.');
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			}else{
				alert('La operación a sido cancelada.');
			}
		}
	}

	function buscar(formulario){
		if(formulario.documento.value==""){
			formulario.documento.focus();
			alert('El campo documento no puede estar vacío.');
			return false;
		}else if(formulario.tipoDocumento.value==""){
			formulario.tipoDocumento.focus();
			alert('Debe seleccionar una opcción en el campo tipo de documento.');
			return false;
		}else{
			tipo=document.getElementById('tipoDocumento').value;
			documento=document.getElementById('documento').value;
			$.ajax({
				url: 'inc/buscar-persona.php',
				type: 'POST',
				dataType: 'html',
				data: {"tipo":tipo,"documento":documento},
			})
			.done(function(data) {
				console.log(data);
				var institucion=JSON.parse(data);//convierto la data de JSON en un arreglo de objetos
				if (institucion['mensaje']!="no"){
					$('#datosPersona').empty();
					$('#datosPersona').append('<i class="material-icons medium">perm_identity</i>');
					for(var i in institucion){
						if (institucion[i].NOMBRE1!="undefined") {
							$('#datosPersona').append('<h4>'+institucion[i].NOMBRE1+'  '+institucion[i].NOMBRE2+'  '+institucion[i].APELLIDO1+'  '+institucion[i].APELLIDO2+'</h4>');
							nombre1=institucion[i].NOMBRE1;
							nombre2=institucion[i].NOMBRE2;
							apellido1=institucion[i].APELLIDO1;
							apellido2=institucion[i].APELLIDO2;
							ips=institucion[i].IPS
						}
					}

					$('#buscarPersona').hide();
					$('#botonBuscar').hide();
					$('#mostrarPersona').show();
					$('#cargarDatos').show();
				}else if (institucion['mensaje']=="no") {
					alert('No hay registros asociados con los datos ingresados, por favor acérquese a su eps.');
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

	function volver(){
		$('#datosPersona').empty().append('<i class="material-icons medium">perm_identity</i>');
		var input=$('#fecha-cita').pickadate();//obtengo el formato de fecha en texto
		var picker = input.pickadate('picker');//lo convierto en un objeto
		var inicio=picker.set('select', true);//selecciono el dia por defecto de hoy
		$('#centro').val("");//se4 vuelve a seleccionar el valor por defecto del option
		$('#mySelect').empty();
		$('#hora-reserva').empty();
		$('#centro').material_select();//recargo la lista del select de materialize para que muestre los campos agregados.
		$('#mySelect').material_select();//recargo la lista del select de materialize para que muestre los campos agregados.
		$('#hora-reserva').material_select();//recargo la lista del select de materialize para que muestre los campos agregados.
		$('#buscarPersona').show();
		$('#botonBuscar').show();
		$('#mostrarPersona').hide();
		$('#cargarDatos').hide();
	}

	function recargar(){
		location.reload();
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
	    // Strings and translations se traduce el calendario a español
		showMonthsShort: true,
		showWeekdaysFull: true,
		monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
		monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		weekdaysFull: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
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
		yearRange: undefined,

		// Disable dates se deshabilita desde hoy hacia atrás tambien los dias domingos
		disable: [ { from: [1900,1,1], to: true }, 7],

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
</script>
</body>
</html>