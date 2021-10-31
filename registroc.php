<?php
include ("conexion.php");

$ide=$_POST['idespec'];
$nombre_curso=ucwords(mb_strtolower($_POST['nombre_curso']));

	$insert_value = 'INSERT INTO dat_curso (nombre_curso) VALUES ("' . $nombre_curso . '")';
	
	$retry_value =mysqli_query($link,$insert_value);
	if (!$retry_value) {
	   		die('Error: ' . mysqli_error($link));
		}else{
			header("location:info_espec.php?idc=".$ide);
		}
mysqli_close($link);
		
?>
