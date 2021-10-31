<?php
include ("conexion.php");

$fecha = $_POST['nfecha'];
$boleta = $_POST['nboleta'];
$pago = $_POST['npago'];
$observacion = $_POST['nobsr'];
$iddat =$_POST['iddat'];
$idespec =$_POST['espec'];
$detalle =$_POST['det_pag'];

$fecha_s=strftime( "%Y-%m-%d-%H-%M-%S", time() );
$consulta="SELECT idmatricula FROM matricula as ma WHERE ma.iddat_pers=".$iddat." and ma.id_especialidad=".$idespec."";

$resultado=mysqli_query($link,$consulta);
$array=mysqli_fetch_row($resultado);
$idmat=$array[0];

$insert_value = 'INSERT INTO pagos (id_especialidad,idmatricula,fecha_b,num_boleta,detalle_p,cantidad,observacion,fecha_sis_p) 
VALUES ('.$idespec.','.$idmat.',"'.$fecha.'","'.$boleta.'","'.$detalle.'",'.$pago.',"'.$observacion.'","'.$fecha_s.'")';

$retry_value =mysqli_query($link,$insert_value);
	if (!$retry_value) {
	   		die('Error: ' . mysqli_error($link));
		}else{
			header("location:pagos.php?idni=".$iddat);
		}

mysql_close($link);
		
?>