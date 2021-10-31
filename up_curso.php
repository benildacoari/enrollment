<?php
include ("conexion.php");

$idcurso = $_POST['id_curso'];
$name = ucwords(mb_strtolower($_POST['name_curso']));
	
	$up_value = 'UPDATE dat_curso SET nombre_curso="'.$name.'" WHERE iddat_curso='.$idcurso.'';

	$retry_value = mysqli_query($link,$up_value);
		if (!$retry_value) {
		   		die('Error: ' . mysqli_error($link));
		}else{
			header("location:admin_cursos.php");
			
		}

mysqli_close($link);
?>
