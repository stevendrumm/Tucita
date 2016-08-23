<?php 
	include 'funciones.php';
	//header('Content-Type: text/javascript; charset=utf8');
	$key=$_POST['key'];
	buscar($key);

	function buscar($tecla){
		$conexion=new bd();
		$mostrar=new mostrar();
		$generar=new generar_consulta();
		if(!session_id()) session_start();
		$institucion=$_SESSION['institucion'];
		$id_doc=$_SESSION['id'];
		//echo $institucion;
		$sentencia="SELECT a.id as id, m.nombre as materia, p.cod_curso as curso, d.nombre as nombre, d.apellido as apellido FROM asignacion as a, pensum as p, materia as m, docente as d WHERE a.cod_pensum=p.id AND p.cod_materia=m.id AND a.cod_docente=d.id AND m.nombre LIKE '%$tecla%' OR p.cod_curso LIKE '%$tecla%' AND a.cod_docente='$id_doc' AND d.cod_institucion='$institucion' AND a.cod_institucion='$institucion'";

			$num_rows=$generar->num_filas($sentencia);
			if ($num_rows==0) {
				$producto=array("mensaje"=>"no");
				echo json_encode($producto);
			}else{
				$devolver=array();
				$cont=$conexion->query($sentencia);
				while($arr=$cont->fetch_assoc()){
					$devolver[]=array_map('utf8_encode',$arr);//codificar el arreglo para caracteres especiales
				}
				echo json_encode($devolver);
			}
	}
?>