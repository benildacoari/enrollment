<?php
include ("conexion.php");

$nombre_co=ucwords(mb_strtolower($_POST['nombre_espec']));

	$insert_e = 'INSERT INTO especialidad (nombre_espec) VALUES ("'.$nombre_co.'")';
	$retry_e =mysqli_query($link,$insert_e);
	$ide=mysqli_insert_id($link);

	$insert_c = 'INSERT INTO dat_curso (nombre_curso) VALUES ("'.$nombre_co.'")';
	$retry_c =mysqli_query($link,$insert_c);
	$idc=mysqli_insert_id($link);
	
	$insert_ec='INSERT INTO espec_cur(id_especialidad,iddat_curso) VALUES('.$ide.','.$idc.')';
	$retry_ec = mysqli_query($link,$insert_ec);
	$idce=mysqli_insert_id($link);
		
	if (!$retry_ec) {
	   		die('Error: ' . mysqli_error($link));
		}else{
			header("location:detalles_espec_co.php?ide=".$ide);
		}
mysqli_close($link);
		
?>