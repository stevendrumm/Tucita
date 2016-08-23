<?php
	include 'funciones.php';
	if (isset($_POST['periodo']) & isset($_POST['inicio']) & isset($_POST['fin'])) {
		session_start();
		$periodo=$_POST['periodo'];
		$inicio=$_POST['inicio'];
		$fin=$_POST['fin'];
		$institucion=$_SESSION['institucion'];//$hoy=date('Y/m/d');
		$conexion=new bd();
		$generar=new generar_consulta();
		$sentencia="SELECT descripcion FROM periodo WHERE fecha_inicio BETWEEN '$inicio' AND '$fin' OR fecha_fin BETWEEN '$inicio' AND '$fin' AND cod_institucion='$institucion'";
		$num_rows=$generar->num_filas($sentencia);
		if ($num_rows==0) {
			$sentencia="INSERT INTO periodo (id, fecha_inicio,  fecha_fin, descripcion, cod_institucion) VALUES (NULL, '$inicio', '$fin', '$periodo', '$institucion')";
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