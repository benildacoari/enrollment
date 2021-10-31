<?php
include ("encabezado.html");

  session_start();
  if (!$_SESSION) {
    echo "<script languaje=javascript>
    alert ('Usted no se ha registrado.')
    self.location='index.php'</script>";
  }
?>
<div class="container">
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
	    <?php
  			require ("conexion.php");
  			$idfr=$_GET['idf'];
  			$idcr=$_GET['idc'];

        $consul="SELECT nota FROM notas WHERE idmatricula=".$idfr;
        $retry_val =mysqli_query($link,$consul);
        $array=mysqli_fetch_row($retry_val);
        $nota=$array[0];
        if ($nota==00) {
          $consul_n="DELETE FROM notas WHERE idmatricula=".$idfr;
          $respuesta_n =mysqli_query($link,$consul_n);
          if (!$respuesta_n){
            die('Error: ' . mysqli_error($link));
          }else{ 
            $consulta="DELETE FROM matricula WHERE idmatricula=".$idfr;
            $retry_value =mysqli_query($link,$consulta);
              if (!$retry_value) {
                echo "<script languaje=javascript>
                  alert ('No se pudo eliminar, debido a que ya se ingreso un pago.')
                  self.location='mostrarm.php?idc='+$idcr</script>";
              }else{
                header("location:mostrarm.php?idc=".$idcr);
              }
          }
        }else if($nota==NULL){
            $consulta="DELETE FROM matricula WHERE idmatricula=".$idfr;
      			$retry_value =mysqli_query($link,$consulta);
      				if (!$retry_value) {
                echo "<script languaje=javascript>
                  alert ('No se pudo eliminar, debido a que ya se ingreso pago.')
                  self.location='mostrarm.php?idc='+$idcr</script>";
              }else{
      					header("location:mostrarm.php?idc=".$idcr);
      				}
        }else{
          echo "<script languaje=javascript>
          alert ('No se pudo eliminar, debido a que se ingreso una nota mayor a cero.')
          self.location='mostrarm.php?idc='+$idcr</script>";
        }

      ?>
    </div>
  </div>
</div>

</body>
</html>