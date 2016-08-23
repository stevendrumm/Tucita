<?php
	include 'funciones.php';
	session_start();
	if (isset($_POST['docente']) & isset($_POST['pensum'])) {
		$conexion=new bd();
		$docente=$_POST['docente'];
		$pensum=$_POST['pensum'];
		$institucion=$_SESSION['institucion'];
		$generar=new generar_consulta();
		$sentencia="SELECT id FROM asignacion WHERE cod_docente='$docente' AND cod_pensum='$pensum' AND cod_institucion='$institucion'";
		$num_filas=$generar->num_filas($sentencia);
		if ($num_filas==0) {
			$id=$docente.$pensum;
			$sentencia="INSERT INTO asignacion (id, cod_docente, cod_pensum, cod_institucion) VALUES ('$id', '$docente', '$pensum', '$institucion')";
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