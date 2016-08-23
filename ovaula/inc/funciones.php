<?php 
class bd extends MySQLi{
	 public function __construct(){
	 	parent::__construct("localhost", "root", "", "ovaula");
	 	if(mysqli_connect_error()){
	 		 die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	 	}
	 }
	function query($query)
	{
	$result = parent::query($query);
	if(mysqli_error($this)){
	  //throw new QueryException(mysqli_error($this), mysqli_errno($this));
	}
	return $result;
	}
	function close()
	{
	  parent::close();
	}
}

class generar_consulta extends bd{
	private $consultar;
	public function consultar_bd($consulta)
	{
		$consultar=$consulta;
		$cont=parent::query($consultar);
		return $cont;
		parent::close();
	}
	public function num_filas($consulta){
		$consultar=$consulta;
		$cont=parent::query($consultar);
		$num=$cont->num_rows;
		return $num;
		parent::close();
	}
  
}

class mostrar extends bd{
	private $consultar;
	public function mostrar_bd($consulta)
	{
		$devolver=array();
		$consultar=$consulta;
		$cont=parent::query($consultar);
	while($arr=$cont->fetch_assoc())
	 {
	  	$devolver[]=$arr;
	 }
	 return $devolver;
	 parent::close();
	}
}

class insertar extends bd {
	private $consultar;
  public function insertar_bd($consulta)
  {
  	$consultar=$consulta;
   	$cont=parent::query($consultar);
  }
}
class modificar extends bd {
	private $consultar;
	public function modificar_bd($consulta)
	{
		$consultar=$consulta;
		$cont=parent::query($consultar);
	}
}
class eliminar extends generar_consulta {
	private $consultar;
	public function eliminar_bd($consulta)
	{	
		$consultar=$consulta;
		$cont=bd::query($consultar);
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