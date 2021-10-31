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

	$fecha_i = $_POST['fecha_i'];
	$fecha_f = $_POST['fecha_f'];
	$duracion = $_POST['duracion'];
	$frecuencia = $_POST['frecuencia'];
	$horario = ucwords(mb_strtolower($_POST['horario']));

	$consulta='SELECT nombre_espec FROM especialidad WHERE id_especialidad='.$ide.'';
	$resultado= mysqli_query($link,$consulta);
	$array=mysqli_fetch_row($resultado);
	$nombre_espec=$array[0];

	$actualizar = 'UPDATE especialidad SET nombre_espec="'.$nombre_espec.'",fecha_inicio="'.$fecha_i.'",fecha_fin="'.$fecha_f.'",nro_horas="'.$duracion.'",frecuencia="'.$frecuencia.'",horario="'.$horario.'" WHERE id_especialidad='.$ide.''; 
    $result =mysqli_query($link,$actualizar);
    	if (!$result){
			die ("Falló Consulta"); 
		}else{
			header("location:datosp.php?ide=".$ide);
		}
		
mysqli_close($link);
?>
