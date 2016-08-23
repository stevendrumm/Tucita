<?php
class bd{
	public function queryPerson($sql){
		$serverName = "190.14.241.42, 1433";

		$connectionInfo = array( "Database" => "RFAST8", "UID" => "citasweb", "PWD" => "4dm1n1str4d0r");

		$conn=sqlsrv_connect($serverName, $connectionInfo);

		if($conn){
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$success = sqlsrv_query( $conn, $sql , $params, $options );	
			
			
			if($success){
				 
				//echo "todo bien";
				//echo sqlsrv_num_rows($success);
				if(sqlsrv_num_rows($success) != 0){
					//echo "todo bien";
					while( $row = sqlsrv_fetch_array( $success, SQLSRV_FETCH_ASSOC) ) {
					    //echo $row['LastName'].", ".$row['FirstName']."<br />";
					    $row['NOMBRE'] = utf8_encode($row['NOMBRE']);					    
						$arr[]=$row;
					}
					/*$obj = sqlsrv_fetch_array($success,SQLSRV_FETCH_ASSOC);

					$obj['TIPDOCUM'] = (String) $obj['TIPDOCUM'];
					
					//echo json_encode($obj);*/
					return $arr;
					sqlsrv_free_stmt( $success);
				}else{
					//echo "todo mal";
					$arr=array("mensaje"=>"no");
					return $arr;
				}
				
			}
			//return true;
			//echo "Conexión establecida";
		}else{
			//echo "Error de conexión";
			//return false;
		}
	}
	public function buscarPersona($sql){
		$serverName = "190.14.241.42, 1433";
		$connectionInfo = array( "Database" => "RFAST8", "UID" => "citasweb", "PWD" => "4dm1n1str4d0r");
		$conn=sqlsrv_connect($serverName, $connectionInfo);
		if($conn){
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$success = sqlsrv_query( $conn, $sql , $params, $options );	
			if($success){
				if(sqlsrv_num_rows($success) != 0){
					while( $row = sqlsrv_fetch_array( $success, SQLSRV_FETCH_ASSOC) ) {
					    //echo $row['LastName'].", ".$row['FirstName']."<br />";
					    $row['NOMBRE1'] = utf8_encode($row['NOMBRE1']);
					    $row['NOMBRE2'] = utf8_encode($row['NOMBRE2']);
					    $row['APELLIDO1'] = utf8_encode($row['APELLIDO1']);
					    $row['APELLIDO2'] = utf8_encode($row['APELLIDO2']);
						$arr[]=$row;
					}
					return $arr;
					sqlsrv_free_stmt( $success);
				}else{
					//echo "todo mal";
					$arr=array("mensaje"=>"no");
					return $arr;
				}
			}
		}else{
			//echo "Error de conexión";
			//return false;
		}
	}
	public function queryHour($sql){
		$serverName = "190.14.241.42, 1433";
		$connectionInfo = array( "Database" => "RFAST8", "UID" => "citasweb", "PWD" => "4dm1n1str4d0r");
		$conn=sqlsrv_connect($serverName, $connectionInfo);
		if($conn){
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$success = sqlsrv_query( $conn, $sql , $params, $options );	
			if($success){
				if(sqlsrv_num_rows($success) != 0){
					while( $row = sqlsrv_fetch_array( $success, SQLSRV_FETCH_ASSOC) ) {
						$arr[]=$row;
					}
					return $arr;
					sqlsrv_free_stmt( $success);
				}else{
					//echo "todo mal";
					$arr=array("mensaje"=>"no");
					return $arr;
				}
			}
		}else{
			//echo "Error de conexión";
			//return false;
		}
	}
	public function checkMeeting($sql){
		$serverName = "190.14.241.42, 1433";
		$connectionInfo = array( "Database" => "RFAST8", "UID" => "citasweb", "PWD" => "4dm1n1str4d0r");
		$conn=sqlsrv_connect($serverName, $connectionInfo);
		if($conn){
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$success = sqlsrv_query( $conn, $sql , $params, $options );			
			if($success){
				while( $row = sqlsrv_fetch_array( $success, SQLSRV_FETCH_ASSOC) ) {
						$arr[]=$row;
					}
					return $arr;
				sqlsrv_free_stmt( $success);							
			}
		}else{
			//echo "Error de conexión";
			//return false;
		}
	}
	public function updateMeeting($sql){
		$serverName = "190.14.241.42, 1433";
		$connectionInfo = array( "Database" => "RFAST8", "UID" => "citasweb", "PWD" => "4dm1n1str4d0r");
		$conn=sqlsrv_connect($serverName, $connectionInfo);
		if($conn){
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$success = sqlsrv_query( $conn, $sql , $params, $options );			
			if($success){
				$arr = array();
				if(sqlsrv_rows_affected($success) != 0){
					$arr = array('mensaje'=>'si');	
				}
				else{
					$arr = array('mensaje'=>'no');
				}
				return $arr;
				sqlsrv_free_stmt( $success);
			}
		}else{
			//echo "Error de conexión";
			//return false;
		}
	}
	/*public function __construct(){
		$serverName = "190.14.241.42, 1433";

		$connectionInfo = array( "Database" => "RFAST8", "UID" => "citasweb", "PWD" => "4dm1n1str4d0r");

		$conn=sqlsrv_connect($serverName, $connectionInfo);

		if($conn){
			return true;
			//echo "Conexión establecida";
		}else{
			//echo "Error de conexión";
			return false;
		}
	}
	public function queryObject($sql){
		$stm=sqlsrv_query( $conn, $sql);
		if( $stmt === false ) {
		     die( print_r( sqlsrv_errors(), true));
		}
		while( $obj = sqlsrv_fetch_object( $stmt)) {
		      //echo $obj->fName.", ".$obj->lName."<br />";
		}
		return $obj;
	}
	public function queryArray($sql){
		$stmt = sqlsrv_query( $sql );
		if( $stmt === false) {
		    die( print_r( sqlsrv_errors(), true) );
		}
		$arr=array();
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		      //echo $row['LastName'].", ".$row['FirstName']."<br />";
			$arr[]=$row;
		}
		return $arr;
	}*/
}
?>