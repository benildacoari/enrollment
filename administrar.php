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
        <div class="panel-heading">REPORTE DE ESTUDIANTES POR ESPECIALIDAD: </div>
        <div class="panel-body">
          <?php
          require ("conexion.php");

            if(isset($_REQUEST['ver_t'])){

              $resultado=mysqli_query($link,"SELECT * FROM especialidad WHERE NOT fecha_inicio='NULL' ORDER BY fecha_inicio DESC");

            echo "<table class='table table-hover'><thead><tr><th>Especialidad</th><th>Fecha de inicio</th><th></th></tr></thead><tr>";
              while($dato = mysqli_fetch_array($resultado)){
                echo "<td>".$dato['nombre_espec'] ."</td>
                <td>".$dato['fecha_inicio'] ."</td>
                <td><a href='phpexcel/index.php?idc=".$dato['id_especialidad']."'><span class='glyphicon glyphicon-download-alt'></span> Exportar Excel</a></td></tr>";
              }  
            echo "</table>";
            }else{
              $resultado=mysqli_query($link,"SELECT * FROM especialidad WHERE NOT fecha_inicio='NULL' ORDER BY fecha_inicio DESC LIMIT 10");

            echo "<table class='table table-hover'><thead><tr><th>Especialidad</th><th>Fecha de inicio</th><th></th></tr></thead><tr>";
              while($dato = mysqli_fetch_array($resultado)){ 
                echo "<td>".$dato['nombre_espec'] ."</td>
                <td>".$dato['fecha_inicio'] ."</td>
                <td><a href='phpexcel/index.php?idc=".$dato['id_especialidad']."'><span class='glyphicon glyphicon-download-alt'></span> Exportar Excel</a></td></tr>";
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
