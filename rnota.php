<?php
include ("conexion.php");

$nespec=$_POST['espec'];
$idn=$_POST['nota'];
$mat=$_POST['idmat'];
$n=count($idn);

$i=0;

	while($i<$n){
		$consulta="INSERT INTO notas (id_especialidad,idmatricula,nota) VALUES(".$nespec.",".$mat[$i].",'".$idn[$i]."')";
		$retry_value =mysqli_query($link,$consulta);
		$i++;
	}
	if (!$retry_value) {
	   		die('Error: ' . mysqli_error($link));
	}else{
			header("location:vernotas.php?nespec=".$nespec);
	}
	
mysqli_close($con);
		
?>
