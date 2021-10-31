<?php
include ("conexion.php");

$idespec=$_POST['ide'];
$idmat=$_POST['idm'];

	$consulta="UPDATE matricula SET id_especialidad='".$idespec."' WHERE idmatricula=".$idmat."";
	$retry_value = mysqli_query($link,$consulta);
	if (!$retry_value) {
	   	die('Error: ' . mysqli_error($link));
	}else{

		$consulta_n="UPDATE notas SET id_especialidad='".$idespec."' WHERE idmatricula=".$idmat."";
		$retry_value_n = mysqli_query($link,$consulta_n);
		if (!$retry_value_n) {
	   		die('Error: ' . mysqli_error($link));
		}else{

			$consulta_p="UPDATE pagos SET id_especialidad='".$idespec."' WHERE idmatricula=".$idmat."";
			$retry_value_p = mysqli_query($link,$consulta_p);
			if (!$retry_value_p) {
			   		die('Error: ' . mysqli_error($link));
			}else{
				header("location:mostrarm.php?idc=".$idespec);
			}
		}
	}
mysqli_close($link);
		
?>