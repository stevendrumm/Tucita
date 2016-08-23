<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	//$imprimeConexion=$conexion->inicializar();
	$mensaje="";
	if (isset($_POST['nombre'])) {
		$nombre=$_POST['nombre'];
		$consulta=new generar_consulta();
		$sentencia="SELECT nombre FROM carrera WHERE nombre='$nombre'";
		$sql=$consulta->consultar_bd($sentencia);
		$num=mysql_num_rows($sql);
		if($num==0){
			$insertar=new insertar();
			$consulta=("INSERT INTO carrera (id, nombre) VALUES (NULL,'".$nombre."')");
			$insertar->insertar_bd($consulta);
			$mensaje="si";
			echo $mensaje;
		}else{
			$mensaje="no";
			echo $mensaje;
		}
	}else{
		$mensaje="error";
		echo $mensaje;
	}
?>