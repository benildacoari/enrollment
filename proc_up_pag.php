<?php
include ("conexion.php");

$idespec =$_POST['espec'];
$fecha = $_POST['nfecha'];
$boleta = $_POST['nboleta'];
$pago = $_POST['npago'];
$observacion = $_POST['obser'];

$iddat =$_POST['idpers'];
$idpa =$_POST['idpa'];
$detalle =$_POST['det_pag'];

$fecha_s=strftime( "%Y-%m-%d-%H-%M-%S", time());

$cons="SELECT idmatricula FROM matricula as ma WHERE iddat_pers=".$iddat." and id_especialidad=".$idespec."";
$resultado=mysqli_query($link,$cons);
$array=mysqli_fetch_row($resultado);
$idm=$array[0];

$insert_value = 'UPDATE pagos SET id_especialidad='.$idespec.',idmatricula='.$idm.',fecha_b="'.$fecha.'",num_boleta="'.$boleta.'",detalle_p="'.$detalle.'",cantidad='.$pago.',observacion="'.$observacion.'",fecha_sis_p="'.$fecha_s.'" WHERE idpagos='.$idpa.'';

$retry_value =mysqli_query($link,$insert_value);
	if (!$retry_value) {
	   		die('Error: ' . mysqli_error($link));
		}else{
			header("location:pagos.php?idni=".$iddat);
		}

mysql_close($link);
		
?>