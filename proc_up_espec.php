<?php
include ("conexion.php");

$idespec = $_POST['idespec'];

$idcurso = $_POST['curso'];
if (!$idcurso){
		header("location:info_espec.php?idc=".$idespec);
}else{
	$idcurso = $_POST['curso'];
	
	$fecha_i = $_POST['fecha_i'];
	$fecha_f = $_POST['fecha_f'];
	$duracion = $_POST['duracion'];
	$frecuencia = $_POST['frecuencia'];
	$horario = ucwords(mb_strtolower($_POST['horario']));
	$nombre_espec = ucwords(mb_strtolower($_POST['nom_e']));

	$up_value = 'UPDATE especialidad SET nombre_espec="'.$nombre_espec.'",fecha_inicio="'.$fecha_i.'",fecha_fin="'.$fecha_f.'",nro_horas="'.$duracion.'",frecuencia="'.$frecuencia.'",horario="'.$horario.'" WHERE id_especialidad='.$idespec.'';

	$retry_value = mysqli_query($link,$up_value);
		if (!$retry_value) {
		   		die('Error: ' . mysqli_error($link));
		}else{
			$consulta='DELETE FROM espec_cur WHERE id_especialidad='.$idespec.'';
			$retry_value = mysqli_query($link,$consulta);
			if (!$retry_value) {
			   		die('Error: ' . mysqli_error($link));
			}else{
				for ($i=0; $i <count($idcurso) ; $i++) { 
					$consulta1='INSERT INTO espec_cur (id_especialidad,iddat_curso) VALUES ('.$idespec.','.$idcurso[$i].')';
					
					$retry_value1 = mysqli_query($link,$consulta1);
				}
					if (!$retry_value1) {
				   		die('Error: ' . mysqli_error($link));
					}else{
						header("location:info_espec.php?idc=".$idespec);
					}
			} 
		}
}
mysqli_close($link);
?>
