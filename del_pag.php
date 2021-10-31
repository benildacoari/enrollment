<?php
	require ("conexion.php");
	
	$idpag=$_GET['idp'];
  
  $iddat=$_GET['idni'];
  $idespec=$_GET['idesp'];
  $idmt=$_GET['idm'];

 $consul="DELETE FROM pagos WHERE idpagos=".$idpag;
  $retry_val =mysqli_query($link,$consul);
      if (!$retry_val) {
        die('Error 3: ' . mysqli_error($link));
      }else{
        header("location:v_pagos.php?idni=".$iddat."&idesp=".$idespec."&idm=".$idmt);
      }

  
?> 