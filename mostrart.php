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
    <div class="col-lg-3 col-md-10 col-sm-10 col-xs-12">
      <form action='' method='POST'class='form-horizontal'>
        <div class='form-group col-lg-12 col-md-12 col-sm-12 text-center'>
          <button class='btn btn-info' name='ver_t_e'>Ver mas</button>
        </div>
      </form>
    </div>

    <div class='col-lg-6 col-md-10 col-sm-10 col-xs-12 '>
      <?php
        require ("conexion.php");
        $idc=$_GET['idc'];
        $idmat=$_GET['idf'];
        
      	$resultado=mysqli_query($link,"SELECT nombre_espec FROM especialidad WHERE id_especialidad=".$idc."");
        $array=mysqli_fetch_row($resultado);
        $nombre_espec=$array[0];  
        
        $resultado1=mysqli_query($link,"SELECT CONCAT(nombres,' ',ap_paterno,' ',ap_materno) FROM dat_personales AS dp INNER JOIN matricula AS ma WHERE ma.iddat_pers=dp.iddat_pers and ma.idmatricula=".$idmat."");
        $array1=mysqli_fetch_row($resultado1);
        $estudiante=$array1[0];  
        
        echo "<div class='panel panel-primary'>
          <div class='panel-heading'>TRASLADO DE ESTUDIANTE: ".$estudiante." </br>DE LA ESPECIALIDAD ".$nombre_espec." </br>A LA ESPECIALIDAD de</div>";
          echo "<div class='panel-body'>";         
            if(isset($_REQUEST['ver_t_e'])){
                $resultado=mysqli_query($link,"SELECT * FROM especialidad WHERE NOT fecha_inicio='NULL' ORDER BY fecha_inicio DESC");

              echo "<table class='table table-hover'><tr>";
                while($dato = mysqli_fetch_array($resultado)){ 
                  echo "<td><form action='procesar_t.php' method='POST'class='form-horizontal'>
                    <input type='number' name='ide' class='sr-only' value=".$dato['id_especialidad'].">
                    <input type='number' name='idm' class='sr-only' value=".$idmat.">
                    <button class='btn btn-link'><span class='glyphicon glyphicon-transfer'></span> ".$dato['nombre_espec']." - ".$dato['fecha_inicio']."</button>
                  </form></td></tr>";
                }  
              echo "</table>";
              }else{
                $resultado=mysqli_query($link,"SELECT * FROM especialidad WHERE NOT fecha_inicio='NULL' ORDER BY fecha_inicio DESC LIMIT 10");

              echo "<table class='table table-hover'><tr>";
                while($dato = mysqli_fetch_array($resultado)){ 
                  echo "<td><form action='procesar_t.php' method='POST'class='form-horizontal'>
                    <input type='number' name='ide' class='sr-only' value=".$dato['id_especialidad'].">
                    <input type='number' name='idm' class='sr-only' value=".$idmat.">
                    <button class='btn btn-link'><span class='glyphicon glyphicon-transfer'></span> ".$dato['nombre_espec']." - ".$dato['fecha_inicio']."</button>
                  </form></td></tr>";
                }  
              echo "</table>";  
            }
          echo '</div>
        </div>
    </div>';
   

      ?>
    </div>
  </div>
</div>

</body>
</html>
