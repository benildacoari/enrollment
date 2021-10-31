<?php
	require ("conexion.php");
	
	$idcurso=$_GET['idc'];

  $consul="SELECT * FROM espec_cur WHERE iddat_curso=".$idcurso;
  $retry_val =mysqli_query($link,$consul);
  $esp_cur=mysqli_num_rows($retry_val);
  if ($esp_cur>0) {
    echo "<script languaje=javascript>
    alert ('No se pudo eliminar, debido a que pertenece a alguna especialidad')
    self.location='admin_cursos.php'</script>";
  }else{
    $consulta="DELETE FROM dat_curso WHERE iddat_curso=".$idcurso;
    $retry_value =mysqli_query($link,$consulta);
    if (!$retry_value) {
      die('Error al eliminar curso: ' . mysqli_error($link));
    }else{
      header("location:admin_cursos.php");
    }
  }

?>