<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	if (isset($_POST['carrera'])) {
		$carrera=$_POST['carrera'];
		$sem=$_POST['semestre'];
		$actual=$_POST['actual'];
		$proximo=$_POST['proximo'];
		//echo $carrera." ".$semestre." ".$proximo." ".$actual;
		$semestre=new gestion_semestre();
		$mensaje=$semestre->modificar($carrera,$sem,$actual,$proximo);
		echo $mensaje;
	}else{
		$mensaje="error";
		echo $mensaje;
	}
?>