<?php 
	include 'funciones.php';
	//header('Content-Type: text/javascript; charset=utf8');
	$key=$_POST['key'];
	buscar($key);

	function buscar($tecla){
		$conexion=new bd();
		$mostrar=new mostrar();
		$generar=new generar_consulta();
		session_start();
		$institucion=$_SESSION['institucion'];
		$sentencia="SELECT p.id as id, m.nombre as nombre, p.cod_curso as curso FROM pensum as p, materia as m WHERE p.cod_materia=m.id AND p.cod_institucion='$institucion' AND p.cod_curso LIKE '%$tecla%'";

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