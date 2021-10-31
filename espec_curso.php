<?php
include ("conexion.php");
	$idcurso = $_POST['curso'];
	if (!$idcurso) {
		header("location:detalles_espec.php");
	}else{
		$idcurso = $_POST['curso'];
	
		$nombre_espec=ucwords(mb_strtolower($_POST['nombre_espec']));
		$fecha_i = $_POST['fecha_i'];
		$fecha_f = $_POST['fecha_f'];
		$duracion = $_POST['duracion'];
		$frecuencia = $_POST['frecuencia'];
		$horario =  ucwords(mb_strtolower($_POST['horario']));


		$insert_value = 'INSERT INTO especialidad (nombre_espec,fecha_inicio,fecha_fin,nro_horas,frecuencia,horario) VALUES ("'.$nombre_espec.'","'.$fecha_i.'","'.$fecha_f.'",'.$duracion.',"'.$frecuencia.'","'.$horario.'")';
		
		$retry_value =mysqli_query($link,$insert_value);
		$ide=mysqli_insert_id($link);

		for ($i=0; $i <count($idcurso) ; $i++) { 
			$consulta1='INSERT INTO espec_cur(id_especialidad,iddat_curso) VALUES('.$ide.','.$idcurso[$i].')';
			$retry_value1 = mysqli_query($link,$consulta1);
		}

			if (!$retry_value1) {
			   		die('Error: ' . mysql_error());
				}else{
					header("location:info_espec.php?idc=".$ide);
				}
	}
	mysqli_close($link);
?>