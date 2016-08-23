<?php
	include 'funciones.php';
	session_start();
	if (isset($_POST['grado']) & isset($_POST['nomenclatura'])) {
		$conexion=new bd();
		$grado=$_POST['grado'];
		$nomenclatura=$_POST['nomenclatura'];
		$institucion=$_SESSION['institucion'];
		$generar=new generar_consulta();
		$sentencia="SELECT grado FROM curso WHERE grado='$grado' AND nomenclatura='$nomenclatura' AND cod_institucion='$institucion'";
		$num_filas=$generar->num_filas($sentencia);
		if ($num_filas==0) {
			$id=$grado.$nomenclatura;
			$sentencia="INSERT INTO curso (id, grado, nomenclatura, cod_institucion) VALUES ('$id', '$grado', '$nomenclatura', '$institucion')";
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