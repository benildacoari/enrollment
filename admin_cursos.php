<?php
include ("encabezado.html");

  session_start();
  if (!$_SESSION) {
    echo "<script languaje=javascript>
    alert ('Usted no se ha registrado.')
    self.location='index.php'</script>";
  }else{
  require ("conexion.php");

    echo '<div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
          <form action="" method="POST" class="form-horizontal">
            <div class="form-group col-lg-12 col-md-12 col-sm-12 text-center">
              <button class="btn btn-info" name="ver_cur">Ver todo</button>
            </div>
          </form>
        </div>';
        if(isset($_REQUEST['mod'])){
            $idcurso=$_GET['id_curso'];
            
              echo '<div class="col-lg-6 col-md-8 col-sm-8 col-xs-10">
                <div class="panel panel-primary">
                  <div class="panel-body">
                    <form action="up_curso.php" method="POST" class="form-horizontal">';
                    $res=mysqli_query($link,"SELECT * FROM dat_curso WHERE iddat_curso=".$idcurso."");
                    while($dato = mysqli_fetch_array($res)){
                      echo '<div class="form-group">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-10 text-left">
                          <label class="control-label text-left">Nombre de curso:</label>
                        </div>
                        <div class="col-lg-9 col-md-10 col-sm-9 col-xs-9">
                          <input type="text" name="id_curso" class="sr-only" value="'.$dato['iddat_curso'].'">
                          <input type="text" name="name_curso" class="form-control" value="'.$dato['nombre_curso'].'" required>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                          <button class="btn btn-primary">Actualizar</button>
                        </div>
                      </div>
                      
                    </form>
                  </div>
                </div>
              </div>';  
            }
      echo '</div>
      <div class="row">
        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2"></div>';
        }

        if (isset($_REQUEST['ver_cur'])){
          echo '<div class="col-lg-6 col-md-8 col-sm-8 col-xs-10">
            <div class="panel panel-primary">
              <div class="panel-heading">LISTADO DE CURSOS: </div>
              <div class="panel-body">';
                $cont=1;
                $resultado=mysqli_query($link,"SELECT * FROM dat_curso ");
                echo "<table class='table table-hover'><thead><tr><th>Nombre de curso</th><th colspan='2'></th></tr></thead><tr>";
                  while($dato = mysqli_fetch_array($resultado)){ 
                    echo "<td>".$cont.".- ".$dato['nombre_curso'] ."</td>
                    <td><form action='' method='GET'> <input type='text' name='id_curso' class='sr-only' value='".$dato['iddat_curso']."'><button class='btn btn-default btn-sm' name='mod'></form><span class='glyphicon glyphicon-edit'></span> Moficicar</a></td>
                    <td><a href='del_curso.php?idc=".$dato['iddat_curso']."' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-trash'></span> Eliminar</a></td></tr>";
                    $cont++;
                  }
                echo "</table>
              </div>
            </div>
          </div>";
        }else{
          echo '<div class="col-lg-6 col-md-8 col-sm-8 col-xs-10">
            <div class="panel panel-primary">
              <div class="panel-heading">LISTADO DE CURSOS: </div>
              <div class="panel-body">';
                $cont=1;
                $resultado=mysqli_query($link,"SELECT * FROM dat_curso LIMIT 10");
                echo "<table class='table table-hover'><thead><tr><th>Nombre de curso</th><th colspan='2'></th></tr></thead><tr>";
                  while($dato = mysqli_fetch_array($resultado)){ 
                    echo "<td>".$cont.".- ".$dato['nombre_curso'] ."</td>
                    <td><form action='' method='GET'> <input type='text' name='id_curso' class='sr-only' value='".$dato['iddat_curso']."'><button class='btn btn-default btn-sm' name='mod'></form><span class='glyphicon glyphicon-edit'></span> Moficicar</a></td>
                    <td><a href='del_curso.php?idc=".$dato['iddat_curso']."' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-trash'></span> Eliminar </a></td></tr>";
                    $cont++;

                  }
                echo "</table>
              </div>
            </div>
          </div>";
        }
      echo "</div>
    </div>";
  }
?>
    
</body>
</html>
