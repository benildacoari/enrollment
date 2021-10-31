<?php
include ("encabezado.html");

  session_start();
  if (!$_SESSION) {
    echo "<script languaje=javascript>
    alert ('Usted no se ha registrado.')
    self.location='index.php'</script>";
  }
echo "<div class='container-fluid'>
  <div class='row'>
   <div class='col-lg-4 col-md-4 col-sm-3 col-xs-10'>
    <table class='table table-hover table-bordered table-condensed'>
      <tr>
        <td>
          <form action='' method='POST'class='form-horizontal'>
            <div class='form-group'>
              <div class='col-lg-9 col-md-8 col-sm-12 col-xs-10'>
                <input type='search' name='busqueda' class='form-control' placeholder='Buscar por nombre de Especialidad' required>
              </div>
              <div class='col-lg-2 col-md-2 col-sm-12 col-xs-2 text-center'>
                <button class=' btn btn-info' name='n_curso'>Buscar</button>
              </div>
            </div>
          </form>
        </td>
      </tr>";

    $antes=date('Y-m-d', strtotime('-6 month')) ;
    $hoy=date("Y-m-d");
      
      echo "<tr>
        <td>
        <label class='control-label'>Buscar por rango de fechas:</label>
          <form action='' method='POST'class='form-horizontal'>
            <div class='form-group '>
              <label class='control-label col-lg-4 col-md-5 col-sm-3 col-xs-1 text-muted'>Desde:</label>
              <div class='col-lg-5 col-md-6 col-sm-9 col-xs-4'>
                <input type='date' name='fecha_c' class='form-control' placeholder='0000-00-00' value=".$antes.">
              </div>
              
              <label class='control-label col-lg-4 col-md-5 col-sm-3 col-xs-1 text-muted'>Hasta:</label>
              <div class='col-lg-5 col-md-6 col-sm-9 col-xs-4'>
                <input type='date' name='fecha_f' class='form-control' placeholder='0000-00-00' value=".$hoy.">
              </div>
              
              <div class='col-lg-2 col-md-12 col-sm-12 col-xs-2 text-center'>
                <button class='btn btn-info' name='fechas'>Buscar</button>
              </div>
            </div>
          </form>
        </td>
      </tr>";
  ?>

      <tr>
        <td>
          <form action="" method="POST" class='form-horizontal'>
            <div class="form-group">
            <label class='control-label col-lg-4 col-md-6 col-sm-8 col-xs-4'>Buscar por Mes:</label>
            <div class="col-lg-5 col-md-5 col-sm-9 col-xs-6 text-left">
              <select class="form-control" name="meses" >
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
              </select>
            </div>
            <div class='col-lg-2 col-md-12 col-sm-12 col-xs-2 text-center'>
              <button class='btn btn-info' name='mes'>Buscar</button>
            </div>
          </form>
        </td>
      </tr>
      <tr>
        <td class='text-center'>
          <form action='' method='POST'class='form-horizontal'>
            <div class='col-lg-12 col-md-12 col-sm-12 text-center'>
              <button class='btn btn-info ' name='ver_t'>VER TODO</button>
            </div>
          </form>
        </td>
      </tr>
    </table>
  </div>

  <div class='col-lg-8 col-md-8 col-sm-9 col-xs-12 '>
    <?php
    require ("conexion.php");
      if(isset($_REQUEST['n_curso'])){
        echo '<div class="panel panel-primary">
          <div class="panel-heading">LISTADO DE ESPECIALIDADES: </div>
          <div class="panel-body">';

            $q=$_POST['busqueda'];
            $sql="select * from especialidad WHERE fecha_inicio NOT LIKE 'NULL' AND nombre_espec LIKE '%".$q."%' ORDER BY fecha_inicio DESC";
            $res=mysqli_query($link,$sql);
            if(mysqli_num_rows($res)==0){
              echo "<b>No hay sugerencias</b>";
            }else{
              echo "<table class='table table-hover'><thead><tr><th>Especialidad</th><th>Fecha de inicio</th><th></th></tr></thead><tr>";
                while($fila=mysqli_fetch_array($res)){
                  $esp=$fila['id_especialidad'];
                  $dis=mysqli_query($link,"SELECT * FROM matricula as ma INNER JOIN especialidad as es WHERE ma.id_especialidad=es.id_especialidad and ma.id_especialidad=".$esp."");
                  $cant=mysqli_num_rows($dis);
                  
                  echo "<td>".$fila['nombre_espec']."</td>
                  <td>".$fila['fecha_inicio']."</td>
                  <td><a href='mostrarm.php?idc=".$fila['id_especialidad']."' target='_blank' class='btn btn-default btn-sm' ";if($cant==0){echo "disabled";} echo "><span class='glyphicon glyphicon-th-list'></span> Ver lista</a></td>
                  <td><a href='info_espec.php?idc=".$fila['id_especialidad']."' target='_blank' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-info-sign'></span> Datos del curso</a></td>
                  <td><a href='del_espec.php?idc=".$fila['id_especialidad']."' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-trash'></span> Eliminar</a></td></tr>";
                }
              echo "</table>";
            }
          echo "</div>
        </div>";
      }

    if(isset($_REQUEST['ver_t'])){
      echo '<div class="panel panel-primary">
        <div class="panel-heading">LISTADO DE TODAS LAS ESPECIALIDADES: </div>
        <div class="panel-body">';
          
         		$resultado=mysqli_query($link,"SELECT * FROM especialidad WHERE fecha_inicio NOT LIKE 'NULL' ORDER BY fecha_inicio DESC");

            if(mysqli_num_rows($resultado)==0){
              echo "<b>No hay sugerencias</b>";
            }else{
            echo "<table class='table table-hover'><thead><tr><th>Especialidad</th><th>Fecha de inicio</th><th></th></tr></thead><tr>";
              while($dato = mysqli_fetch_array($resultado)){ 
                $esp=$dato['id_especialidad'];
                $dis=mysqli_query($link,"SELECT * FROM matricula as ma INNER JOIN especialidad as es WHERE ma.id_especialidad=es.id_especialidad and ma.id_especialidad=".$esp."");
                $cant=mysqli_num_rows($dis);

                echo "<td>".$dato['nombre_espec'] ."</td>
                <td>".$dato['fecha_inicio'] ."</td>
                <td><a href='mostrarm.php?idc=".$dato['id_especialidad']."' target='_blank' class='btn btn-default btn-sm' ";if($cant==0){echo "disabled";} echo "><span class='glyphicon glyphicon-th-list'></span> Ver lista</a></td>
                <td><a href='info_espec.php?idc=".$dato['id_especialidad']."' target='_blank' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-info-sign'></span> Datos del curso</a></td>
                <td><a href='del_espec.php?idc=".$dato['id_especialidad']."' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-trash'></span> Eliminar</a></td></tr>";
              }
            }  
            echo "</table>
          
        </div>
      </div>";
    }

    if(isset($_REQUEST['fechas'])){
      $fc=$_POST['fecha_c'];
      $ff=$_POST['fecha_f'];
      
      echo '<div class="panel panel-primary">
        <div class="panel-heading">Lista de Especialidades que empezaron del '.$fc.' al '.$ff.' </div>
        <div class="panel-body">';
          
            $resultado=mysqli_query($link,"SELECT * FROM especialidad WHERE fecha_inicio BETWEEN '".$fc."' AND '".$ff."' ORDER BY fecha_inicio DESC");
             if(mysqli_num_rows($resultado)==0){
              echo "<b>No hay sugerencias</b>";
            }else{  
            echo "<table class='table table-hover'><thead><tr><th>Especialidad</th><th>Fecha de inicio</th><th></th></tr></thead><tr>";
              while($dato = mysqli_fetch_array($resultado)){
                $esp=$dato['id_especialidad'];
                $dis=mysqli_query($link,"SELECT * FROM matricula as ma INNER JOIN especialidad as es WHERE ma.id_especialidad=es.id_especialidad and ma.id_especialidad=".$esp."");
                $cant=mysqli_num_rows($dis);

                echo "<td>".$dato['nombre_espec'] ."</td>
                <td>".$dato['fecha_inicio'] ."</td>
                <td><a href='mostrarm.php?idc=".$dato['id_especialidad']."' target='_blank' class='btn btn-default btn-sm' ";if($cant==0){echo "disabled";} echo "><span class='glyphicon glyphicon-th-list'></span> Ver lista</a></td>
                <td><a href='info_espec.php?idc=".$dato['id_especialidad']."' target='_blank' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-info-sign'></span> Datos del curso</a></td>
                <td><a href='del_espec.php?idc=".$dato['id_especialidad']."' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-trash'></span> Eliminar</a></td></tr>";
              }
            }  
            echo "</table>
          
        </div>
      </div>";
    }

    if(isset($_REQUEST['mes'])){
      $ms=$_POST['meses'];
      
      function nombremes($mes){
        setlocale(LC_TIME, 'spanish');  
        $nombre=strtoupper(strftime("%B",mktime(0, 0, 0, $mes, 1, 2016))); 
        return $nombre;
      }
      $mes=nombremes($ms);
      
      echo '<div class="panel panel-primary">
        <div class="panel-heading">ESPECIALIDADES DEL MES DE: '.$mes.'</div>
        <div class="panel-body">';
            $resultado=mysqli_query($link,"SELECT * FROM especialidad WHERE month(fecha_inicio)=".$ms." ORDER BY fecha_inicio DESC");
             if(mysqli_num_rows($resultado)==0){
              echo "<b>No hay sugerencias</b>";
            }else{
            echo "<table class='table table-hover'><thead><tr><th>Especialidad</th><th>Fecha de inicio</th><th></th></tr></thead><tr>";
              while($dato = mysqli_fetch_array($resultado)){
                $esp=$dato['id_especialidad'];
                $dis=mysqli_query($link,"SELECT * FROM matricula as ma INNER JOIN especialidad as es WHERE ma.id_especialidad=es.id_especialidad and ma.id_especialidad=".$esp."");
                $cant=mysqli_num_rows($dis);

                echo "<td>".$dato['nombre_espec'] ."</td>
                <td>".$dato['fecha_inicio'] ."</td>
                <td><a href='mostrarm.php?idc=".$dato['id_especialidad']."' target='_blank' class='btn btn-default btn-sm' ";if($cant==0){echo "disabled";} echo "><span class='glyphicon glyphicon-th-list'></span> Ver lista</a></td>
                <td><a href='info_espec.php?idc=".$dato['id_especialidad']."' target='_blank' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-info-sign'></span> Datos del curso</a></td>
                <td><a href='del_espec.php?idc=".$dato['id_especialidad']."' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-trash'></span> Eliminar</a></td></tr>";
              }
            }  
            echo "</table>
        </div>
      </div>";
    }
        ?>
    </div>
  </div>
</br>
</div>

</body>
</html>
