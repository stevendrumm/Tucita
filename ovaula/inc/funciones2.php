<?php 
class conexion_bd {
	function __set($nombre, $valor) {
		echo "El dato ".$nombre."=".$valor." no son parametros válidos.";
	}
	function __construct() {
	$cadena;
	   $link = mysql_connect("localhost","root","");
	   mysql_select_db("test",$link);
	     if (! $link){
	      $cadena="Error al intentar conectarse con el servidor MySQL";
	      return $cadena;
	        exit();
	     } else{
	         if (! mysql_select_db("test",$link)){
	             $cadena="No se pudo conectar correctamente con la Base de datos";
	             return $cadena;
	             exit();
	          }else{
	          	$cadena="Se conecto adecuadamente al servidor y a la base de datos.";
	          	return $cadena;
	          }
	     }
	}
}
interface gestion{
	public function insertar($tabla,$tipo_id,$identificacion,$nombre,$apellido,$direccion,$telefono,$correo,$rol);
	public function modificar($tabla,$t_original,$id_original,$cor_original,$tipo_id,$identificacion,$nombre,$apellido,$direccion,$telefono,$correo,$rol);
	public function eliminar($tabla,$tipo_id,$identificacion,$correo);
}
class persona implements gestion{
	public function insertar($tabla,$tipo_id,$identificacion,$nombre,$apellido,$direccion,$telefono,$correo,$rol){
		$sentencia="SELECT tipo_id, identificacion FROM ".$tabla." WHERE tipo_id='$tipo_id' AND identificacion='$identificacion'";
		$sql=mysql_query($sentencia);
		$num=mysql_num_rows($sql);
		if($num==0){
			$sentencia="INSERT INTO ".$tabla." (id, tipo_id, identificacion, nombre, apellido, direccion, telefono, correo) VALUES (NULL, '$tipo_id', '$identificacion', '$nombre', '$apellido', '$direccion', '$telefono', '$correo')";
			mysql_query($sentencia);
			$sentencia="INSERT INTO usuaro (id, nick, correo, contrasena, rool) VALUES (NULL, '$nombre', '$correo', '$identificacion', '".$rol."')";
			mysql_query($sentencia);
			$mensaje="si";
			return $mensaje;
		}else{
			$mensaje="no";
			return $mensaje;
		}
	}
	public function modificar($tabla,$t_original,$id_original,$cor_original,$tipo_id,$identificacion,$nombre,$apellido,$direccion,$telefono,$correo,$rol){
		$sentencia="SELECT tipo_id, identificacion FROM ".$tabla." WHERE tipo_id='$t_original' AND identificacion='$id_original'";
		$sql=mysql_query($sentencia);
		$num=mysql_num_rows($sql);
		if($num==0){
			$mensaje="no";
			return $mensaje;
		}else{
			$sentencia="UPDATE ".$tabla." SET tipo_id='$tipo_id', identificacion='$identificacion', nombre='$nombre',apellido='$apellido', direccion='$direccion', telefono='$telefono', correo='$correo' WHERE tipo_id='$t_original' AND identificacion='$id_original'";
			mysql_query($sentencia);
			$sentencia="UPDATE usuaro SET nick='$nombre', correo='$correo', contrasena='$identificacion' WHERE correo='$cor_original'";
			mysql_query($sentencia);
			$mensaje="si";
			return $mensaje;
		}
	}
	public function eliminar($tabla,$tipo_id,$identificacion,$correo){
		$sentencia="SELECT tipo_id, identificacion FROM ".$tabla." WHERE tipo_id='$tipo_id' AND identificacion='$identificacion'";
		$sql=mysql_query($sentencia);
		$num=mysql_num_rows($sql);
		if($num==0){
			$mensaje="no";
			return $mensaje;
		}else{
			$sentencia="DELETE FROM usuaro WHERE correo='$correo'";
			$sql=mysql_query($sentencia);
			$sentencia="DELETE FROM ".$tabla." WHERE tipo_id='$tipo_id' AND identificacion='$identificacion'";
			$sql=mysql_query($sentencia);
			$mensaje="si";
			return $mensaje;
		}
	}
}
abstract class clase_abstracta{
	abstract protected function modificar($carrera, $semestre, $actual, $cadena);
	public function imprimir(){
		echo "HOLA MUNDO";
	}
}
class gestion_semestre extends clase_abstracta{
	public function modificar($carrera, $semestre, $actual, $cadena){
		$mensaje="";
		$sentencia="SELECT car.id as id_car, sem.semestre as seme FROM semestre as sem, carrera as car WHERE sem.id=".$semestre." AND sem.id_carrera=".$carrera." AND sem.id_carrera=car.id";
		$sql=mysql_query($sentencia);
		$num=mysql_num_rows($sql);
		if($num==0){
			$mensaje="no";
			return $mensaje;
		}else{
			$sentencia="SELECT semestre FROM semestre WHERE semestre='$cadena' AND id_carrera='$carrera'";
			$sql=mysql_query($sentencia);
			$num=mysql_num_rows($sql);
			if($num==0){
				$sentencia="UPDATE semestre SET semestre='$cadena' WHERE id='$semestre' AND id_carrera='$carrera'";
				$sql=mysql_query($sentencia);
				$mensaje="si";
				return $mensaje;
			}else{
				$mensaje="ya";
				return $mensaje;
			}
		}
	}
}
class generar_consulta{
	private $consultar;
	public function consultar_bd($consulta)
  {
  	$consultar=$consulta;
   $cont=mysql_query($consultar);
   return $cont;
  }
}

class mostrar extends generar_consulta{
	private $consultar;
 public function mostrar_bd($consulta)
  {
  	$consultar=$consulta;
    while($arr=mysql_fetch_assoc($consultar))
     {
	  return $arr;
     }
  }
}

class insertar extends generar_consulta {
	private $consultar;
  public function insertar_bd($consulta)
  {
  	$consultar=$consulta;
    mysql_query($consultar);
  }
}
class modificar extends generar_consulta {
	private $consultar;
	public function modificar_bd($consulta)
	{
		$consultar=$consulta;
		mysql_query($consultar);
	}
}
class eliminar extends generar_consulta {
	private $consultar;
	public function eliminar_bd($consulta)
	{	
		$consultar=$consulta;
		mysql_query($consultar);
	}
}
class comprobar_usuario extends mostrar{
	public $mensaje;
	private $consultar;
	public function buscar_usuario($consulta,$correo,$contrasena){
		$consultar=$consulta;
		$arreglo=mostrar::mostrar_bd($consultar);
		if($arreglo['correo'] == $correo && $arreglo['contrasena'] == $contrasena){
			$mensaje="si";
			return $mensaje;
		}else{
			$mensaje="no";
			return $mensaje;
			/*if($arreglo['usuario'] != $usuario && $arreglo['contrasena'] != $contrasena){
				$mensaje="El ussuario no se encuentra registrado.";
				return $mensaje;
			}
			else{
				$mensaje="El usuario o la contraseña son incorrectos.";
				return $mensaje;
			}*/
		}
	}
}
?>