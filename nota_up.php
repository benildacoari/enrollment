<?php
include ("conexion.php");

$nespec=$_POST['espec'];
$idn=$_POST['nota'];
$mat=$_POST['idmat'];
$n=count($idn);

$i=0;

	while($i<$n){
		$consulta="UPDATE notas SET nota='".$idn[$i]."' WHERE idmatricula=".$mat[$i]."";
		$retry_value = mysqli_query($link,$consulta);
		$i++;
	}
	if (!$retry_value) {
	   		die('Error: ' . mysqli_error($link));
	}else{
			header("location:vernotas.php?nespec=".$nespec);
	}
mysqli_close($link);
		
?>
