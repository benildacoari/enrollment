<?php
include ("encabezado.html");

  session_start();
  if (!$_SESSION) {
    echo "<script languaje=javascript>
    alert ('Usted no se ha registrado.')
    self.location='index.php'</script>";
  }
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-1 col-md-1 col-sm-3 col-xs-2"></div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-8">
      <?php
        require ("conexion.php");
        $idespec=$_GET['idc'];
        
        $consulta='SELECT nombre_espec from especialidad where id_especialidad='.$idespec;
        $resultado= mysqli_query($link,$consulta);
        $array=mysqli_fetch_row($resultado);
        $nombres=$array[0];
        echo "<div class='panel panel-primary'>
          <div class='panel-heading'>Datos del curso ".$nombres."</div>
          <div class='panel-body'>";
                
            $curso=mysqli_query($link,"select * from dat_curso AS dc INNER JOIN espec_cur AS ec
              WHERE dc.iddat_curso=ec.iddat_curso and ec.id_especialidad=".$idespec.""); 

            echo "<div class='form-group'>
              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>
                <label class='control-label'>Cursos:</label>
              </div>
              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
              while ($noc=mysqli_fetch_array($curso)){ 
                echo "<p> - ".$noc['nombre_curso']."</p>"; 
              } 
              echo "</div>
            </div>";

            $query_p='SELECT * from especialidad where id_especialidad='.$idespec.'';
            $resultado1=mysqli_query($link,$query_p);
            while($dato=mysqli_fetch_array($resultado1)){ 
            echo "<div class='form-group'>
              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>
                <label class='control-label'>Fecha Inicio:</label>
              </div>
              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                <p>".$dato['fecha_inicio']."</p>
              </div>
            </div>
            <div class='form-group'>
              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>
                <label class='control-label'>Fecha fin:</label>
              </div>
              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                <p>".$dato['fecha_fin']."</p>
              </div>
            </div>
            <div class='form-group'>
              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>
                <label class='control-label'>Duracion:</label>
              </div>
              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                <p>".$dato['nro_horas']." horas</p>
              </div>
            </div>
            <div class='form-group'>
              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>
                <label class='control-label'>Frecuencia:</label>
              </div>
              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                <p>".$dato['frecuencia']."</p>
              </div>
            </div>
            <div class='form-group'>
              <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>
                <label class='control-label'>Horario:</label>
              </div>
              <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <p>".$dato['horario']."</p>
              </div>
            </div>";
            }
          echo "</div>

          <div class='panel-footer text-center'>
            <form action='' method='GET' >
              <input type='number' name='idc' class='sr-only' value='".$idespec."'>
              <button class='btn btn-primary' name='up_info'> <span class='glyphicon glyphicon-edit'></span> Modificar Datos</button>
            </form>
          </div>
        </div>";
      ?>
    </div>
    
<?php

  if (isset($_REQUEST['up_info'])) {
    $ide =$_GET['idc'];
    
    echo "<div class='col-lg-6 col-md-6 col-sm-10 col-xs-10'>
      <div class='row'>
        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
          <form action='' method='POST' class='form-inline' role='form'>
              <button class='btn btn-info' name='n_curso'>Nuevo Curso</button>
          </form>
        </div>";

        if(isset($_REQUEST['n_curso'])){
        echo "<div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'>
          <form action='registroc.php' method='POST' class='form-inline' role='form'>
            <div class='form-group'>
              <input type='text' name='idespec' class='sr-only' value=".$ide.">
              <input type='text' name='nombre_curso' class='form-control' placeholder='Ingrese un nuevo curso' >
            </div>
            <button type='submit' class='btn btn-info' >Registrar</button>
          </form>
        </div>";
        }
      echo "</div>";
  
      echo "<div class='row'>
        <div class='col-lg-12 col-md-10 col-sm-12 col-xs-12'>";
          $espec=mysqli_query($link,"select nombre_espec from especialidad WHERE id_especialidad=".$ide.""); 
          $array=mysqli_fetch_row($espec);
          $nombres=$array[0];
          echo "<form action='proc_up_espec.php' method='POST' class='form-horizontal' role='form'>
            <div class='panel panel-primary'>
              <div class='panel-heading'>MODIFICAR DATOS DE ESPECIALIDAD: ".$nombres." </div>
              <div class='panel-body'>
                <div class='row'>

                  <div class='col-lg-5 col-md-12 col-sm-5 col-xs-5'>
                    <div class='form-group'>
                      <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>
                        <label class='control-label'>Cursos:</label>
                      </div>
                      <div class='col-lg-12 col-md-12 col-sm-6 col-xs-6'>";
                        $curso=mysqli_query($link,"select * from dat_curso ORDER BY iddat_curso DESC"); 
                          while ($noc=mysqli_fetch_array($curso)){ 
                            echo "<input type='checkbox' name='curso[]' value='".$noc['iddat_curso']."' > ".$noc['nombre_curso']."</br>"; 
                          } 
                      echo "</div>
                    </div>
                  </div>";
                  
                  echo "<div class='col-lg-7 col-md-12 col-sm-7 col-xs-7'>";
                  $especialidad=mysqli_query($link,"select * from especialidad WHERE id_especialidad=".$ide.""); 
                  while ($esp=mysqli_fetch_array($especialidad)){ 
                    echo "<div class='form-group'>
                      <div class='col-lg-8 col-md-8 col-sm-8 col-xs-10 text-left'>
                        <label class='control-label text-left'>Nombre de especialidad:</label>
                      </div>
                      <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <input type='number' class='sr-only'  name='idespec' value=".$esp['id_especialidad'].">
                        <input type='text' name='nom_e' class='form-control' placeholder='Nombre de curso' value='".$esp['nombre_espec']."' required>
                      </div>
                    </div>

                    <div class='form-group'>
                      <div class='col-lg-5 col-md-5 col-sm-6 col-xs-6 text-right'>
                        <label class='control-label text-left'>Fecha Inicio:</label>
                      </div>
                      <div class='col-lg-6 col-md-5 col-sm-5 col-xs-6'>
                        <input type='date' name='fecha_i' class='form-control' placeholder='0000-00-00' value='".$esp['fecha_inicio']."' required>
                      </div>
                    </div>

                    <div class='form-group'>
                      <div class='col-lg-5 col-md-5 col-sm-6 col-xs-6 text-right'>
                        <label class='control-label'>Fecha fin:</label>
                      </div>
                      <div class='col-lg-6 col-md-5 col-sm-5 col-xs-6'>
                        <input type='date' name='fecha_f' class='form-control' placeholder='0000-00-00' value='".$esp['fecha_fin']."'>
                      </div>
                    </div>

                    <div class='form-group'>
                      <div class='col-lg-5 col-md-5 col-sm-6 col-xs-6 text-right'>
                        <label class='control-label'>Duracion:</label>
                      </div>
                      <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                        <input type='number' min='1' max='300' name='duracion' class='form-control'  pattern='[0-9]' title='Ingrese solo numeros y no mayor a tres cifras' placeholder='horas' value='".$esp['nro_horas']."' required>
                      </div>
                    </div>

                    <div class='form-group'>
                      <div class='col-lg-5 col-md-5 col-sm-6 col-xs-6 text-right'>
                        <label class='control-label'>Frecuencia:</label>
                      </div>
                      <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";?>
                        <input type='Radio' name='frecuencia' value='Mañana' <?php if($esp["frecuencia"]=="Mañana")echo 'checked="checked"';?> >Mañana</br>
                        <input type='Radio' name='frecuencia' value='Tarde' <?php if($esp["frecuencia"]=="Tarde")echo 'checked="checked"';?> >Tarde</br>
                        <input type='Radio' name='frecuencia' value='Noche' <?php if($esp["frecuencia"]=="Noche")echo 'checked="checked"';?>>Noche
                      <?php
                      echo "</div>
                    </div>

                    <div class='form-group'>
                      <div class='col-lg-5 col-md-5 col-sm-6 col-xs-6 text-right'>
                        <label class='control-label'>Horario:</label>
                      </div>
                      <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <input type='text' name='horario' class='form-control' value='".$esp['horario']."'>
                      </div>
                    </div>";
                  }
                    echo "<div class='col-lg-12 text-center'>
                      <button type='submit' class='btn btn-primary'>Actualizar</button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>";
  }
?>


  </div>
</br>
</div>
</body>
</html>