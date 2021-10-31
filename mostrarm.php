
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
    <div class="col-lg-1 col-md-0"></div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <?php
        require ("conexion.php");
        $idc=$_GET['idc'];
        
      	$resultado=mysqli_query($link,"SELECT nombre_espec FROM especialidad WHERE id_especialidad=".$idc."");
        $array=mysqli_fetch_row($resultado);
        $nombre_espec=$array[0];  
        echo "<div class='panel panel-primary'>
          <div class='panel-heading'>ESPECIALIDAD: ".$nombre_espec."</div>";
          echo "<div class='panel-body'>";         
          $resultado2 =mysqli_query($link,"SELECT * FROM dat_personales as dp inner join matricula as m inner join especialidad as es 
          WHERE dp.iddat_pers=m.iddat_pers AND m.id_especialidad=es.id_especialidad AND es.id_especialidad=".$idc."");
          $total =mysqli_num_rows($resultado2);
          $mat=1;
      			echo " <table class=' table table-striped'><thead><tr><th>NOMBRES Y APELLIDOS</th><th>DNI</th><th colspan='2'></th></tr></thead><tr>";         
              while ($matriculados=mysqli_fetch_array($resultado2)){
                echo "<td>".$mat.".- ".$matriculados['nombres']." ". $matriculados['ap_paterno']." ".$matriculados['ap_materno']."</td>
                <td>".$matriculados['dni']."</td>
                <td><a href='recibir_del.php?idf=".$matriculados['idmatricula']."&idc=".$idc."' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-trash'></span> Eliminar Registro</a></td>
                <td><a href='mostrart.php?idf=".$matriculados['idmatricula']."&idc=".$idc."' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-transfer'></span> Trasladar</button>
                    </form>
                </td>
                <td><form action='' method='POST'class='form-horizontal'>
                      <input type='number' name='idf' class='sr-only' value=".$matriculados['idmatricula'].">
                      <button name='imprimir' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-print'></span> Imprimir Ficha</button>
                    </form>
                </td>
                </tr>";
                $mat=$mat+1;
              }  
            echo '</table>
          </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
    </br>
    </br>
    </br>';
      if(isset($_REQUEST['imprimir'])){
        $idm=$_POST['idf'];
        $hoy=date("Y-m-d");
        echo "<form action='imprimirficha.php' target='_blank' method='GET' class='form-horizontal'>
          <div class='form-group col-lg-12 col-md-12 col-sm-6 col-xs-4 text-center'>
            <label class='control-label'>Ingrese fecha:</label>
          </div>
          <div class='form-group col-lg-12 col-md-12 col-sm-3 col-xs-4 text-center'>
            <input type='date' name='fecha' size='45'  placeholder='0000-00-00' value=".$hoy.">
            <input type='number' name='idf' class='sr-only' value=".$idm.">
          </div>
          <div class='form-group col-lg-12 col-md-12 col-sm-3 col-xs-4 text-center'>
            <button type='submit' class='btn btn-info'><span class='glyphicon glyphicon-print'></span> Ver</button>
          </div>
        </form>";
      }    

      ?>
    </div>
  </div>
</div>

</body>
</html>
