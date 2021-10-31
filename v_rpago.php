<?php
include ("conexion.php");

$fecha = $_POST['nfecha'];
$boleta = $_POST['nboleta'];
$pago = $_POST['npago'];
$det=$_POST['det_pag'];
$observacion = $_POST['nobsr'];
$iddat =$_POST['iddat'];
$idespec =$_POST['espec'];
$idmat=$_POST['mat'];

$fecha_s=strftime( "%Y-%m-%d-%H-%M-%S", time() );

$insert_value = 'INSERT INTO pagos (id_especialidad,idmatricula,fecha_b,num_boleta,detalle_p,cantidad,observacion,fecha_sis_p) 
VALUES ('.$idespec.','.$idmat.',"'.$fecha.'","'.$boleta.'","'.$det.'",'.$pago.',"'.$observacion.'","'.$fecha_s.'")';

$retry_value =mysqli_query($link,$insert_value);
	if (!$retry_value) {
	   		die('Error: ' . mysqli_error($link));
		}else{
			header("location:v_pagos.php?idni=".$iddat."&idesp=".$idespec."&idm=".$idmat);
		}

mysql_close($link);
		
?>