<?php
	include 'funciones.php';
	session_start();
	if (isset($_POST['estado']) & isset($_POST['estudiante']) & isset($_POST['curso'])) {
		$conexion=new bd();
		$estudiante=$_POST['estudiante'];
		$curso=$_POST['curso'];
		$estado=$_POST['estado'];
		$institucion=$_SESSION['institucion'];
		$generar=new generar_consulta();
		$sentencia="SELECT id FROM matricula WHERE cod_estudiante='$estudiante' AND cod_curso='$curso' AND cod_institucion='$institucion'";
		$num_filas=$generar->num_filas($sentencia);
		if ($num_filas==0) {
			$sentencia="INSERT INTO matricula (id, estado, cod_estudiante, cod_curso, cod_institucion) VALUES (NULL, '$estado', '$estudiante', '$curso', '$institucion')";
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