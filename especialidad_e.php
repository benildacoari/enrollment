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
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
      <form action='' method='POST'class='form-horizontal'>
        <div class='form-group col-lg-12 col-md-12 col-sm-12 text-center'>
          <button class='btn btn-info' name='ver_e'>Ver todo</button>
        </div>
      </form>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">
      <?php 
        require ("conexion.php");
        $idper=$_GET['idni'];

        echo "<form action='actualizar.php' method='POST' class='form-horizontal' role='form'>";
        if(isset($_REQUEST['ver_e'])){
          $rs=mysqli_query($link,"SELECT * FROM especialidad WHERE NOT fecha_inicio='NULL' ORDER BY fecha_inicio DESC"); 
        
          echo "<div class='panel panel-primary'>
            <div class='panel-heading'>Seleccione la especialidad</div>
            <div class='panel-body'>
                <input type='number' name='idni' class='sr-only' value=".$idper.">";
              while ($es=mysqli_fetch_array($rs)){ 
                echo "<input type='radio' name='ides' value=".$es['id_especialidad']." required> <strong>".$es['nombre_espec']."</strong> (".$es['fecha_inicio'].")<br/>";
              } 
              echo "<div class='col-lg-12 text-center'>
                <button type='submit' class='btn btn-primary'>Continuar</button>
              </div>
            </div>
          </div>";
        }else{
          $rs=mysqli_query($link,"SELECT * FROM especialidad WHERE NOT fecha_inicio='NULL' ORDER BY fecha_inicio DESC LIMIT 10"); 
        
          echo "<div class='panel panel-primary'>
            <div class='panel-heading'>Seleccione la especialidad</div>
            <div class='panel-body'>
                <input type='number' name='idni' class='sr-only' value=".$idper.">";
              while ($es=mysqli_fetch_array($rs)){ 
                echo "<input type='radio' name='ides' value=".$es['id_especialidad']." required> <strong>".$es['nombre_espec']."</strong> (".$es['fecha_inicio'].")<br/>";
              } 
              echo "<div class='col-lg-12 text-center'>
                <button type='submit' class='btn btn-primary'>Continuar</button>
              </div>
            </div>
          </div>";
        }
        echo "</form>";
      ?>
    </div>
  </div>
</div>

</body>
</html>