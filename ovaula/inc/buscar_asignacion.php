<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	$key=$_POST['key'];
	if (!empty($key)){
		buscar($key);
	}

	function buscar($tecla){
		$sentencia=mysql_query("SELECT car.nombre as car_nom, sem.semestre as sem, mat.nombre as mat_nombre, pen.id as pen_id, asi.id_docente as doc_id, asi.id as asi_id, doc.nombre as doc_nom, doc.apellido as doc_ape FROM carrera as car, semestre as sem, materia as mat, pensum as pen, asignacion as asi, docente as doc WHERE pen.id_semestre=sem.id AND pen.id_materia=mat.id AND sem.id_carrera=car.id AND doc.id=asi.id_docente AND pen.id=asi.id_pensum AND sem.semestre LIKE '%$tecla%'");
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