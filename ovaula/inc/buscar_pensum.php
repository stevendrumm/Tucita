<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	$key=$_POST['key'];
	if (!empty($key)){
		buscar($key);
	}

	function buscar($tecla){
		$sentencia=mysql_query("SELECT car.id as car_id, car.nombre as car_nom, sem.id as sem_id, sem.semestre as sem, pen.id as mat_id, mat.nombre as mat_nombre, pen.id as pen_id FROM carrera as car, semestre as sem, materia as mat, pensum as pen WHERE pen.id_semestre=sem.id AND pen.id_materia=mat.id AND sem.id_carrera=car.id AND sem.semestre LIKE '%$tecla%'");
			$num_rows=mysql_num_rows($sentencia);
			if ($num_rows==0) {
				$producto=array("mensaje"=>"no");
				echo json_encode($producto);
			}else{
				$producto=array();
				while ($arr=mysql_fetch_assoc($sentencia)) {
					$producto[]=$arr;
				}
				echo json_encode($producto);
			}
	}
?>