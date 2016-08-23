<?php
	include 'funciones.php';
	session_start();
	if (isset($_POST['nombre']) & isset($_POST['apellido']) & isset($_POST['tipo']) & isset($_POST['documento']) & isset($_POST['email']) & isset($_POST['telefono'])) {
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$tipo=$_POST['tipo'];
		$documento=$_POST['documento'];
		$email=$_POST['email'];
		$telefono=$_POST['telefono'];
		$institucion=$_SESSION['institucion'];
		$conexion=new bd();
		$generar=new generar_consulta();
		$sentencia="SELECT nombre FROM estudiante WHERE tipo_documento='$tipo' AND documento='$documento' AND cod_institucion='$institucion'";
		$num_rows=$generar->num_filas($sentencia);
		if ($num_rows==0) {
			$id=$tipo.$documento;
			$sentencia="INSERT INTO estudiante (id, nombre, apellido, tipo_documento, documento, email, telefono, cod_institucion) VALUES ('$id', '$nombre', '$apellido', '$tipo', '$documento', '$email', '$telefono', '$institucion')";
			$result=$generar->consultar_bd($sentencia);
			if ($result) {
				$producto=array("mensaje"=>"si");
				echo json_encode($producto);
			}else{
				$producto=array("mensaje"=>"error");
				echo json_encode($producto);
			}
		}else{
			$producto=array("mensaje"=>"no");
			echo json_encode($producto);
		}
	}else{
		$producto=array("mensaje"=>"error");
		echo json_encode($producto);
	}
?>