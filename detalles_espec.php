<?php
include ("encabezado.html");

  session_start();
  if (!$_SESSION) {
    echo "<script languaje=javascript>
    alert ('Usted no se ha registrado.')
    self.location='index.php'</script>";
  }
  require ("conexion.php");
    echo "<div class='container'>
      <div class='row'>
        <div class='col-lg-2 col-md-1 col-sm-0 col-xs-0'></div>
        <div class='col-lg-8 col-md-10 col-sm-12 col-xs-12'>
          <form action='' method='POST'class='form-horizontal'>
            <div class='form-group col-lg-2 col-md-2 col-sm-2 '>
              <button class='btn btn-info' name='n_curso'>Nuevo Curso</button>
            </div>
          </form>";

        if(isset($_REQUEST['n_curso'])){
          echo "<form action='registro.php' method='POST' class='form-inline' role='form'>
            <div class='form-group col-lg-7 col-md-7 col-sm-7 col-xs-7'>
              <input type='text' name='nombre_curso' class='form-control' placeholder='Ingrese un nuevo nombre de curso' size='54'>
            </div>
            <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-2'>
              <button type='submit' class='btn btn-info' >Registrar</button>
            </div>
          </form>";
        }
      ?>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
      <?php 
        echo "<form action='espec_curso.php' method='POST' class='form-horizontal' id='forma' role='form'>
          <div class='col-lg-8 col-md-10 col-sm-12 col-xs-12'>";
            echo "<div class='panel panel-primary'>";   
              

                $curso=mysqli_query($link,"select * from dat_curso ORDER BY iddat_curso DESC"); 
                
                echo "<div class='panel-body'>
                  <div class='row'>
                    <div class='col-lg-4 col-md-6 col-sm-5 col-xs-5'>
                      <div class='form-group'>
                        <label class='col-lg-6 col-md-6 control-label'>Cursos:</label>
                        <div class='col-lg-12 col-md-12'>";
                        while ($noc=mysqli_fetch_array($curso)){ 
                          echo "<input type='checkbox' name='curso[]' value='".$noc['iddat_curso']."'> ".$noc['nombre_curso']."</br>"; 
                        } 
                        echo "</div>
                      </div>
                    </div>

                    <div class='col-lg-8 col-md-6 col-sm-7 col-xs-7'>
                      <div class='form-group'>
                          <label class='col-lg-5 col-md-5 col-sm-5  col-xs-8 control-label'>Especialidad:</label>
                          <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
                            <input type='text' name='nombre_espec' class='form-control' placeholder='Ingrese un nuevo curso de especialización...' required>
                          </div>
                      </div>                    
                    
                      <div class='form-group'>
                        <label class='col-lg-5 col-md-5 col-sm-5 col-xs-8 control-label'>Fecha Inicio:</label>
                        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-7'>
                          <input type='date' name='fecha_i' class='form-control' placeholder='0000-00-00' required>
                        </div>
                      </div>

                      <div class='form-group'>
                        <label class='col-lg-5 col-md-5 col-sm-5 col-xs-8 control-label'>Fecha fin:</label>
                        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-7 '>
                          <input type='date' name='fecha_f' class='form-control' placeholder='0000-00-00'>
                        </div>
                      </div>

                      <div class='form-group'>
                        <label class='col-lg-5 col-md-5 col-sm-5  col-xs-8 control-label'>Duracion:</label>
                        <div class='col-lg-4 col-md-4 col-sm-4  col-xs-6 '>
                          <input type='number' min='1' max='150' name='duracion' class='form-control'  pattern='[0-9]' title='Ingrese solo numeros y no mayor a tres cifras' placeholder='horas' required>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='col-lg-5 col-md-5 col-sm-5  col-xs-8 control-label'>Frecuencia:</label>
                        <div class='col-lg-7 col-md-7 col-sm-7  col-xs-7'>
                          <input type='Radio' name='frecuencia' value='Mañana'>Mañana</br>
                          <input type='Radio' name='frecuencia' value='Tarde' checked>Tarde</br>
                          <input type='Radio' name='frecuencia' value='Noche'>Noche
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='col-lg-5 col-md-5 col-sm-5  col-xs-8 control-label'>Horario:</label>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
                          <input type='text' name='horario' class='form-control'>
                        </div>
                      </div>
                      <div class='col-lg-12 text-center'>
                        <button type='submit' class='btn btn-primary' >Aperturar</button>
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