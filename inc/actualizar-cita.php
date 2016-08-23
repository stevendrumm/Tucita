<?php
include 'funciones.php';
$nombre1=$_POST['nombre1'];
$nombre2=$_POST['nombre2'];
$apellido1=$_POST['apellido1'];
$apellido2=$_POST['apellido2'];
$tipo=$_POST['tipo'];
$documento=$_POST['documento'];
$ips=$_POST['ips'];
$fecha=$_POST['fecha'];
$centro=$_POST['centro'];
$profesional=$_POST['profesional'];
$hora=$_POST['hora'];
$fecha2=$fecha." ".$hora.".000";
$bd=new bd();
if ($bd==true) {
	$arr=array();$arr2=array();$arr3=array();
	$sql="SELECT COUNT(*) AS NUMERO FROM fac_m_citas WHERE CONVERT(DATE,FECHA) = '$fecha' AND TIPDOCUM = '$tipo' AND NUMDOCUM = '$documento' AND CENTROPROD = '$centro'";
	$arr=$bd->checkMeeting($sql);
	if($arr[0]['NUMERO']==0){
		$sqlcita=$sql = "UPDATE fac_m_citas SET FECHA_SOLICITUD = GETDATE(), CENTROPROD = '$centro', HISTORIA='$documento', ESTADO = 1, TIPDOCUM ='$tipo', NUMDOCUM = '$documento', NOMBRE1 = '$nombre1', APELLIDO1 = '$apellido1', TIPO_SOLICITUD=31  WHERE FECHA = CONVERT(datetime, '".$fecha2."',121) AND CODIGO = '$profesional'";
		$arr2=$bd->updateMeeting($sql);
		$sql="SELECT COUNT(*) AS NUMERO FROM fac_m_citas WHERE FECHA = CONVERT(datetime, '$fecha2', 121) AND TIPDOCUM = '$tipo' AND NUMDOCUM = '$documento' AND CENTROPROD = '$centro'";
		$arr3=$bd->checkMeeting($sql);
		if($arr3[0]['NUMERO']==1){
			$arr4 = array('mensaje'=>'si');
			echo json_encode($arr4);
		}else{
			$arr5 = array('mensaje'=>'no');
			echo json_encode($arr5);
		}
	}else{
		$arr6 = array('mensaje'=>'ya');
		echo json_encode($arr6);
	}
}
?>