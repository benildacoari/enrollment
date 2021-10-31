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
    <div class="col-md-2">
      <form action='' method='POST'class='form-horizontal'>
        <div class='form-group col-lg-12 col-md-12 col-sm-12 text-center'>
          <button class='btn btn-info' name='ver_t'>Ver todo</button>
        </div>
      </form>
    </div>
    <div class="col-md-8">
      <div class="panel panel-primary">
        <div class="panel-heading">REPORTE DE PAGOS POR ESPECIALIDAD: </div>
        <div class="panel-body">
          <?php
            require ("conexion.php");
            if(isset($_REQUEST['ver_t'])){
         		$resultado=mysqli_query($link,"SELECT * FROM especialidad WHERE NOT fecha_inicio='NULL' ORDER BY fecha_inicio DESC");
              echo "<table class='table table-hover'><thead><tr><th>Especialidad</th><th>Fecha de inicio</th><th></th></tr></thead><tr>";
                while($dato = mysqli_fetch_array($resultado)){ 
                  $esp=$dato['id_especialidad'];
                  $dis=mysqli_query($link,"SELECT * FROM matricula as ma INNER JOIN especialidad as es WHERE ma.id_especialidad=es.id_especialidad and ma.id_especialidad=".$esp."");
                  $cant=mysqli_num_rows($dis);

                  echo "<tr><td>".$dato['nombre_espec'] ."</td>
                  <td>".$dato['fecha_inicio'] ."</td>
                  <td><a href='det_pagos.php?idc=".$dato['id_especialidad']."' class='btn btn-default btn-sm' ";if($cant==0){echo "disabled";} echo "><span class='glyphicon glyphicon-usd' ></span> Detalle de pagos</a></td>
                  <td><a href='phpexcel/pagos_excel.php?idc=".$dato['id_especialidad']."' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-download-alt'></span> Exportar</a></td></tr>";
                }  
              echo "</table>";
            }else{
              $resultado=mysqli_query($link,"SELECT * FROM especialidad WHERE NOT fecha_inicio='NULL' ORDER BY fecha_inicio DESC LIMIT 10");
              echo "<table class='table table-hover'><thead><tr><th>Especialidad</th><th>Fecha de inicio</th><th></th></tr></thead><tr>";
                while($dato = mysqli_fetch_array($resultado)){
                  $esp=$dato['id_especialidad'];
                  $dis=mysqli_query($link,"SELECT * FROM matricula as ma INNER JOIN especialidad as es WHERE ma.id_especialidad=es.id_especialidad and ma.id_especialidad=".$esp."");
                  $cant=mysqli_num_rows($dis);

                  echo "<tr><td>".$dato['nombre_espec'] ."</td>
                  <td>".$dato['fecha_inicio'] ."</td>
                  <td><a href='det_pagos.php?idc=" . $dato['id_especialidad'] ."' class='btn btn-default btn-sm' ";if($cant==0){echo "disabled";} echo "><span class='glyphicon glyphicon-usd' ></span> Detalle de pagos</a></td>
                  <td><a href='phpexcel/pagos_excel.php?idc=".$dato['id_especialidad']."' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-download-alt'></span> Exportar</a></td></tr>";
                }  
              echo "</table>";
            }

          ?>
        </div>
      </div>
    </div>
  
  </div>
</br>
</div>

</body>
</html>
