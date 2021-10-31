<?php
	require ("conexion.php");
	
	$idespec=$_GET['idc'];

  $consul="SELECT * FROM matricula WHERE id_especialidad=".$idespec;
  $retry_val =mysqli_query($link,$consul);
  $matriculados=mysqli_num_rows($retry_val);
  if ($matriculados>0) {
    echo "<script languaje=javascript>
    alert ('No se pudo eliminar, debido a que se tiene inscritos')
    self.location='cursos.php?ver_t'</script>";
  }else{
    $consul_ec="SELECT * FROM espec_cur WHERE id_especialidad=".$idespec;
    $retry_val_ec =mysqli_query($link,$consul_ec);
    $cursos=mysqli_num_rows($retry_val_ec);
    
    if ($cursos>0) {
      $consul_n="DELETE FROM espec_cur WHERE id_especialidad=".$idespec;
      $respuesta_n =mysqli_query($link,$consul_n);
      if (!$respuesta_n){
        die('Error 1: ' . mysqli_error($link));
      }else{ 
        $consulta="DELETE FROM especialidad WHERE id_especialidad=".$idespec;
        $retry_value =mysqli_query($link,$consulta);
          if (!$retry_value) {
            die('Error 2: ' . mysqli_error($link));
          }else{
            header("location:cursos.php?ver_t");
          }
      }
    }else{
      $consulta="DELETE FROM especialidad WHERE id_especialidad=".$idespec;
      $retry_value =mysqli_query($link,$consulta);
      if (!$retry_value) {
        die('Error 3: ' . mysqli_error($link));
      }else{
        header("location:cursos.php?ver_t");
      }
    }
  }
?>