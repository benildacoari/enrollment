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
        $esp=$_GET['idc'];

          $consulta="SELECT nombre_espec FROM especialidad WHERE id_especialidad=".$esp."";
          $resultado= mysqli_query($link,$consulta);
          $array=mysqli_fetch_row($resultado);
          $nombre_espec=$array[0];  
              
          echo "<div class='panel panel-primary'>";
            echo "<div class='panel-heading'>ESPECIALIDAD: ".$nombre_espec."</div>";

              $resultado1=mysqli_query($link,"SELECT CONCAT(nombres,' ',ap_paterno,' ',ap_materno) AS nom, dp.iddat_pers, ma.id_especialidad,ma.idmatricula FROM matricula as ma INNER JOIN dat_personales as dp
              WHERE ma.iddat_pers=dp.iddat_pers and ma.id_especialidad=".$esp."");
              $cont=1;
              
              $total=0;
            echo "<div class='panel-body'>
              <table class='table table-bordered'><thead><tr><th>Nombres y apellidos</th><th>S/.</th><th></th></tr></thead><tr>";
                while($dato = mysqli_fetch_array($resultado1)){
                  $idmat=$dato['idmatricula'];
                  $iddt=$dato['iddat_pers'];
                  $espec=$dato['id_especialidad'];
                  echo "<td>".$cont.".- ".$dato['nom']."</td>";

                    $resultado2=mysqli_query($link,"SELECT SUM(cantidad) AS cant FROM pagos WHERE idmatricula=".$idmat."");
                    $array=mysqli_fetch_row($resultado2);
                    $cant=$array[0];
                    if (!$resultado2) {
                        echo "<td> </td>";
                    }else{
                       echo "<td class='text-right'>".$cant."</td>";
                       $total=$total+$cant;
                    }
                 
                  echo "<td><a href='v_pagos.php?idni=".$iddt."&idesp=".$espec."&idm=".$idmat."' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-plus-sign'></span>  Mas detalles</a>
                  </td></tr>";
                  $cont++;
                }
                 $totalf=number_format($total, 2, '.', '.');
              echo "</table>
            </div>
            <div class='panel-footer text-center'>MONTO TOTAL:  S/.".$totalf."</div>
          </div>";
        
      ?>
    </div>    
  </div>
</br>

</div>

</body>
</html>