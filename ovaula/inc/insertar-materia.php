<?php
	include 'funciones.php';
	if (isset($_POST['nombre'])) {
		session_start();
		$nombre=$_POST['nombre'];
		$institucion=$_SESSION['institucion'];
		$conexion=new bd();
		$generar=new generar_consulta();
		$sentencia="SELECT nombre FROM materia WHERE nombre='$nombre' AND cod_institucion='$institucion'";
		$num_rows=$generar->num_filas($sentencia);
		if ($num_rows==0) {
			$sentencia="INSERT INTO materia (id, nombre, cod_institucion) VALUES (NULL, '$nombre', '$institucion')";
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