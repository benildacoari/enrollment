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
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <?php
        require ("conexion.php");
       
        $esp= $_GET["idc"];
        $query_e="SELECT * FROM notas WHERE id_especialidad=".$esp."";
        $res=mysqli_query($link,$query_e);
        $c=mysqli_num_rows($res);
        
        if ($c==0) {
          $consulta="SELECT nombre_espec FROM especialidad WHERE id_especialidad=".$esp."";
          $resultado= mysqli_query($link,$consulta);
          $array=mysqli_fetch_row($resultado);
          $nombre_espec=$array[0];  
              
          echo "<div class='panel panel-primary'>";
            echo "<div class='panel-heading'>ESPECIALIDAD: ".$nombre_espec."</div>";
              $resultado1=mysqli_query($link,"SELECT CONCAT(nombres,' ',ap_paterno,' ',ap_materno) AS nom,idmatricula,id_especialidad 
                FROM matricula as ma INNER JOIN dat_personales as dp 
              WHERE ma.iddat_pers=dp.iddat_pers and ma.id_especialidad=".$esp."");
              $cont = 1;
            echo "<div class='panel-body'>
              <form action='rnota.php' method='POST' role='form'>
                <table class='table table-bordered'><tr><th>Nombres y apellidos</th><th>Nota</th></tr>";
                  while($dato = mysqli_fetch_array($resultado1)){
                    echo "<td>".$cont.".- ".$dato['nom']."</td>
                    <input type='number' name='idmat[]' class='sr-only' value=".$dato['idmatricula'].">
                    <input type='number' name='espec' class='sr-only' value=".$dato['id_especialidad'].">
                    <td class='text-center'>
                    <input type='number' min='00' max='20' name='nota[]' size='2' pattern='[0-9]{2}' class='text-center' placeholder='00' required>
                    </td></tr>";
                    $cont++;
                  }
                echo "</table>
                <div class='col-lg-12 text-center'>
                  <button type='submit' class='btn btn-success'>Ingresar</button>
                </div>
              </form>
            </div>
          </div>";
        }else{
          $consulta="SELECT nombre_espec FROM especialidad WHERE id_especialidad=".$esp."";
          $resultado= mysqli_query($link,$consulta);
          $array=mysqli_fetch_row($resultado);
          $nombre_espec=$array[0];

          echo "<div class='panel panel-primary'>
            <div class='panel-heading'>ESPECIALIDAD: ".$nombre_espec."</div>";
              
            $consulta2="SELECT CONCAT(nombres,' ',ap_paterno,' ',ap_materno) AS nom, no.nota,no.idmatricula,no.id_especialidad 
              FROM matricula as ma INNER JOIN dat_personales as dp INNER JOIN notas AS no
            WHERE ma.iddat_pers=dp.iddat_pers AND ma.idmatricula=no.idmatricula and no.id_especialidad=".$esp."";  
            $resultado2=mysqli_query($link,$consulta2);
            $cont=1;  
            echo "<div class='panel-body'>
              <form action='nota_up.php' method='POST' role='form'>
                <table class='table table-bordered'><tr><th>Nombres y apellidos</th><th class='text-center'>Nota</th></tr>";
                  while($dato = mysqli_fetch_array($resultado2)){
                    echo "<td>".$cont.".- ".$dato['nom']."</td>
                    <input type='number' name='idmat[]' class='sr-only' value=".$dato['idmatricula'].">
                    <input type='number' name='espec' class='sr-only' value=".$dato['id_especialidad'].">
                    <td class='text-center'>
                    <input type='number' min='00' max='20' name='nota[]' size='2' pattern='[0-9]{2}' class='text-center' value=".$dato['nota']." class='text-center' required>
                    </td></tr>";
                    $cont++;  
                  }
                echo "</table>
                <div class='col-lg-12 text-center'>
                  <button type='submit' class='btn btn-warning'>Actualizar</button>
                </div>
              </form>
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