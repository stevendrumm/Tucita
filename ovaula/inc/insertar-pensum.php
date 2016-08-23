<?php
	include 'funciones.php';
	session_start();
	if (isset($_POST['materia']) & isset($_POST['curso'])) {
		$conexion=new bd();
		$materia=$_POST['materia'];
		$curso=$_POST['curso'];
		$institucion=$_SESSION['institucion'];
		$generar=new generar_consulta();
		$sentencia="SELECT id FROM pensum WHERE cod_materia='$materia' AND cod_curso='$curso' AND cod_institucion='$institucion'";
		$num_filas=$generar->num_filas($sentencia);
		if ($num_filas==0) {
			$id=$materia.$curso;
			$sentencia="INSERT INTO pensum (id, cod_materia, cod_curso, cod_institucion) VALUES ('$id', '$materia', '$curso', '$institucion')";
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