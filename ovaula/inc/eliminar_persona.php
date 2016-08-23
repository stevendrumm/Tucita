<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	$mensaje="";
	if (isset($_POST['ta'])) {
		$tabla=$_POST['ta'];
		$tipo=$_POST['tipo'];
		$id=$_POST['id'];
		$correo=$_POST['cor'];
		$persona=new persona();
		$mensaje=$persona->eliminar($tabla,$tipo,$id,$correo);
		echo $mensaje;
	}else{
		$mensaje="error";
		echo $mensaje;
	}
?>