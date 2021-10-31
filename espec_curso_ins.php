<?php
include ("conexion.php");

	$idespec = $_POST['idespec'];
	if (!$idcurso = $_POST['curso']) {
   		header("location:detalles_espec_ins.php?ide=".$idespec);
	}else{
		$idcurso = $_POST['curso'];
	}
	
	$fecha_i = $_POST['fecha_i'];
	$fecha_f = $_POST['fecha_f'];
	$duracion = $_POST['duracion'];
	$frecuencia = $_POST['frecuencia'];
	$horario = ucwords(mb_strtolower($_POST['horario']));

	$consulta='SELECT nombre_espec FROM especialidad WHERE id_especialidad='.$idespec.'';
	$resultado= mysqli_query($link,$consulta);
	$array=mysqli_fetch_row($resultado);
	$nombre_espec=$array[0];

		$insert_value = 'INSERT INTO especialidad (nombre_espec,fecha_inicio,fecha_fin,nro_horas,frecuencia,horario) 
		VALUES ("'.$nombre_espec.'","'.$fecha_i.'","'.$fecha_f.'","'.$duracion.'","'.$frecuencia.'","'.$horario.'")';

		$retry_value = mysqli_query($link,$insert_value);
			if (!$retry_value) {
			   		die('Error: ' . mysqli_error($link));
				}
		$id_es=mysqli_insert_id($link);
		for ($i=0; $i <count($idcurso) ; $i++) { 
			$consulta1='INSERT INTO espec_cur(id_especialidad,iddat_curso) VALUES('.$id_es.','.$idcurso[$i].')';
			$retry_value1 = mysqli_query($link,$consulta1);
		}
			if (!$retry_value1) {
		   		die('Error: ' . mysql_error());
			}else{
				header("location:datosp.php?ide=".$id_es);
			} 
mysqli_close($link);
?>
