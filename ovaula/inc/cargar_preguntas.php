<?php
	include 'funciones.php';
	$conexion=new conexion_bd();
	$cons=new generar_consulta();
	$id=$_POST['test'];
	$sent="SELECT * FROM pregunta WHERE id_test='$id'";
	$sql=$cons->consultar_bd($sent);
	$num_row=mysql_num_rows($sql);
	if ($num_row!=0){
		$resultado=array();
		while($arr=mysql_fetch_assoc($sql))
	     {
		 	$resultado[]=$arr;
	     }
	     echo json_encode($resultado);
	}elseif ($num_row==0){
		$resultado=array("mensaje"=>"no");
		echo json_encode($resultado);
	}
?>