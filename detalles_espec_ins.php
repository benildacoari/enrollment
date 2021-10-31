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
      <?php
        require ("conexion.php");
        $ide =$_GET['ide'];

        echo "<form action='espec_curso_ins.php' method='POST' class='form-horizontal' id='forma' role='form'>
          <div class='container col-lg-8'>";
          $espec=mysqli_query($link,"select id_especialidad,nombre_espec from especialidad WHERE id_especialidad=".$ide.""); 
            echo "<div class='panel panel-primary'>";   
              while ($es=mysqli_fetch_array($espec)){ 
                echo "<div class='panel-heading'>ESPECIALIDAD: ".$es['nombre_espec']." </div>
                  <input type='text' class='sr-only'  name='nombre_espec' value=".$es['nombre_espec'].">
                  <input type='number' class='sr-only'  name='idespec' value=".$es['id_especialidad'].">";
              }

                $curso=mysqli_query($link,"select * from dat_curso AS dc INNER JOIN espec_cur AS ec
                  WHERE dc.iddat_curso=ec.iddat_curso and ec.id_especialidad=".$ide.""); 
                
                echo "<div class='panel-body'>
                  <div class='row'>
                    <div class='container col-lg-5'>";
                      while ($noc=mysqli_fetch_array($curso)){ 
                        echo "<input type='checkbox' name='curso[]' value='".$noc['iddat_curso']."' checked>".$noc['nombre_curso']."</br>"; 
                      } 
                    echo "</div>
                    <div class='container col-lg-5'>
                      <div class='form-group'>
                        <label class='col-lg-5 control-label'>Fecha Inicio:</label>
                          <div class='col-md-7'>
                            <input type='date' name='fecha_i' class='form-control' placeholder='0000-00-00' required>
                          </div>
                      </div>
                      <div class='form-group'>
                        <label class='col-lg-5 control-label'>Fecha fin:</label>
                        <div class='col-md-7'>
                          <input type='date' name='fecha_f' class='form-control' placeholder='0000-00-00'>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='col-lg-5 control-label'>Duracion:</label>
                        <div class='col-lg-7'>
                          <input type='number' min='1' max='150' name='duracion' class='form-control' placeholder='horas' required pattern='[0-9]' title='Ingrese solo numeros y no mayor a tres cifras'>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='col-lg-5 control-label'>Frecuencia:</label>
                        <div class='col-lg-7'>
                          <input type='Radio' name='frecuencia' value='Mañana'>Mañana</br>
                          <input type='Radio' name='frecuencia' value='Tarde' checked>Tarde</br>
                          <input type='Radio' name='frecuencia' value='Noche'>Noche
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='col-lg-5 control-label'>Horario:</label>
                        <div class='col-lg-7'>
                          <input type='text' name='horario' class='form-control'>
                        </div>
                      </div>
                      <div class='col-lg-12 text-center'>
                        <button type='submit' class='btn btn-success'>Aperturar</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </form>
  </div>";
  ?>
</br>
</div>
</body>
</html>
