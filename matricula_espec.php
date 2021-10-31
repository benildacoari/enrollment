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
    <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
      <table class='table table-hover'>
        <tr>
          <td>
            <form action="" method="POST" role="form">
              <a href='detalles_espec.php' class='btn btn-primary btn-block' name='n_espec'><span class="glyphicon glyphicon-book"></span> Curso de Especialización</a>
            </form>
          </td>
        </tr>
        <tr>
          <td>
            <form action="" method="POST" role="form">
              <button class='btn btn-primary btn-block text-left' name='n_curso'><span class="glyphicon glyphicon-modal-window"></span> Curso Ordinario</button>
            </form>
          </td>
        </tr>
        <tr>
          <td>
            <form action="" method="POST" role="form">
              <button class='btn btn-primary btn-block' name='ver_t'><span class="glyphicon glyphicon-list-alt"></span> Ver Especialidades</button>
            </form>
          </td>
        </tr>
        <tr>
          <td>
            <form action="" method="POST" role="form">
             <button class='btn btn-primary btn-block' name='n_matricula'><span class="glyphicon glyphicon-user"></span> Nueva Matricula</button>
            </form>
          </td>
        </tr>
      </table>  
    </div>
  
      <?php 
        if(isset($_REQUEST['n_curso'])){
          echo "<div class='col-lg-6 col-md-7 col-sm-9 col-xs-8'>
            <div class='panel panel-primary'>
                <div class='panel-body'>
                 
                  <form action='espec_curso_co.php' method='POST' class='form-horizontal' role='form'>
                    <div class='form-group'>
                      <label class='col-lg-4 col-md-4 col-sm-4 col-xs-8 control-label'>Nombre de curso:</label>
                      <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 '>
                        <input type='text' name='nombre_espec' class='form-control' placeholder='Ingrese un nuevo curso...' required/>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-lg-4 col-md-4 col-sm-4 col-xs-8 control-label'>Fecha inicio:</label>
                      <div class='col-lg-6 col-md-6 col-sm-6 col-xs-7'>
                        <input type='date' name='fecha_i' class='form-control' placeholder='0000-00-00' required>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-lg-4 col-md-4 col-sm-4 col-xs-8 control-label'>Fecha fin:</label>
                      <div class='col-lg-6 col-md-6 col-sm-6 col-xs-7 '>
                        <input type='date' name='fecha_f' class='form-control' placeholder='0000-00-00'>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-lg-4 col-md-4 col-sm-4  col-xs-8 control-label'>Duracion:</label>
                      <div class='col-lg-4 col-md-4 col-sm-4  col-xs-6 '>
                        <input type='number' min='1' max='150' name='duracion' class='form-control' placeholder='horas' required pattern='[0-9]' title='Ingrese solo numeros y no mayor a tres cifras'>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-lg-4 col-md-4 col-sm-4  col-xs-8 control-label'>Frecuencia:</label>
                      <div class='col-lg-7 col-md-7 col-sm-7  col-xs-7'>
                        <input type='Radio' name='frecuencia' value='Mañana'>Mañana</br>
                        <input type='Radio' name='frecuencia' value='Tarde' checked>Tarde</br>
                        <input type='Radio' name='frecuencia' value='Noche'>Noche
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-lg-4 col-md-4 col-sm-4  col-xs-8 control-label'>Horario:</label>
                      <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 '>
                        <input type='text' name='horario' class='form-control'>
                      </div>
                    </div>

                    <div class='col-lg-12 text-center'>
                      <button type='submit' class='btn btn-success'>Aperturar</button>
                    </div>
                    
                  </form>
                  </div>
                </div>
              </div>
          </div>";

        }
        require ("conexion.php");
        if(isset($_REQUEST['n_matricula'])){
          echo '<div class="col-lg-7">';
            $rs=mysqli_query($link,"select * from especialidad WHERE fecha_inicio NOT LIKE 'NULL' ORDER BY fecha_inicio DESC LIMIT 10");
            echo "<div class='panel panel-primary'>
              <div class='panel-heading text-center'>
                <form action='' method='POST' role='form'>
                  ESPECIALIDADES:<button class='btn btn-info' name='ver_mm'>Ver todo</button>
                </form></div>
              <div class='panel-body'>
                <table class='table table-hover'><tr>";
                  while ($es=mysqli_fetch_array($rs)){ 
                    echo "<td>".$es['nombre_espec']."</td>
                    <td>".$es['fecha_inicio']."</td>
                    <td><a href='datosp.php?ide=".$es['id_especialidad']."'><span class='glyphicon glyphicon-edit'></span> Inscribir</a></td></tr>"; 
                  } 
                echo "</table>
              </div>
            </div>
          </div>";
        }

        if(isset($_REQUEST['ver_mm'])){
          echo '<div class="col-lg-7">';
            $rs=mysqli_query($link,"select * from especialidad ORDER BY fecha_inicio DESC");
            echo "<div class='panel panel-primary'>
              <div class='panel-heading'>ESPECIALIDADES:</div>
              <div class='panel-body'>
                <table class='table table-hover'><tr>";
                  while ($es=mysqli_fetch_array($rs)){ 
                    echo "<td>".$es['nombre_espec']."</td>
                    <td>".$es['fecha_inicio']."</td>
                    <td><a href='datosp.php?ide=".$es['id_especialidad']."'><span class='glyphicon glyphicon-edit'></span> Inscribir</a></td></tr>"; 
                  } 
                echo "</table>
              </div>
            </div>
          </div>";
        }

        if(isset($_REQUEST['ver_t'])){

          echo "<div class='col-lg-7'>
            <div class='panel panel-primary'>
              <div class='panel-heading text-center'>
                <form action='' method='POST' role='form'>
                  ESPECIALIDADES:<button class='btn btn-info' name='ver_m'>Ver todo</button>
                </form>
              </div>
              <div class='panel-body'>";
                $rs=mysqli_query($link,"select MAX(id_especialidad) as id_especialidad,nombre_espec,MAX(fecha_inicio) AS fecha_inicio from especialidad GROUP BY nombre_espec ORDER BY fecha_inicio DESC LIMIT 10");  
                  echo "<table class='table table-hover'><tr>";
                    while ($es=mysqli_fetch_array($rs)){ 
                      echo "<td>".$es['nombre_espec']."</td>
                      <td>".$es['fecha_inicio']."</td>
                      <td><a href='detalles_espec_ins.php?ide=".$es['id_especialidad']."'><span class='glyphicon glyphicon-duplicate '></span> Aperturar</a></td></tr>"; 
                    } 
                  echo "</table>
              </div>
            </div>
          </div>";
         
        }

        if(isset($_REQUEST['ver_m'])){
          echo "<div class='col-lg-7'>
            <div class='panel panel-primary'>
            <div class='panel-heading'>ESPECIALIDADES:</div>
              <div class='panel-body'>";
                  $rs=mysqli_query($link,"select MAX(id_especialidad) as id_especialidad,nombre_espec,MAX(fecha_inicio) AS fecha_inicio from especialidad GROUP BY nombre_espec ORDER BY fecha_inicio DESC");  
                    echo "<table class='table table-hover'><tr>";
                      while ($es=mysqli_fetch_array($rs)){ 
                        echo "<td>".$es['nombre_espec']."</td>
                        <td>".$es['fecha_inicio']."</td>
                        <td><a href='detalles_espec_ins.php?ide=".$es['id_especialidad']."'><span class='glyphicon glyphicon-duplicate '></span> Aperturar</a></td></tr>"; 
                      } 
                    echo "</table>
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