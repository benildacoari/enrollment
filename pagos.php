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
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
      <?php
        require ("conexion.php");
        $iddat=$_GET['idni'];

        $cons='SELECT fecha_b from pagos as pa INNER JOIN matricula as ma 
        WHERE pa.detalle_p="Matricula" and ma.idmatricula=pa.idmatricula and ma.iddat_pers='.$iddat.' ORDER BY idpagos DESC';

        $resu= mysqli_query($link,$cons);
        $array=mysqli_fetch_row($resu);
        $fecha=date('Y-m-d');
        $fecha=$array[0];

        $hoy=date("Y-m-d");

        $nuevafecha = strtotime ( '+3 month' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-d' , $nuevafecha );

        $res= ((strtotime($nuevafecha)-strtotime($hoy))/86400);

        if($fecha==NULL){
          echo "<script languaje=javascript>
            alert ('No realizó el pago de matrícula.')
          </script>";
        }elseif ($fecha) {
          if ($res<1) {
          echo "<script languaje=javascript>
            alert ('El pago de matrícula ya caducó.')
          </script>";
          }
        }

        echo "<div class='panel panel-primary'>";
          $consulta='SELECT CONCAT(nombres," ",ap_paterno," ",ap_materno) as nombres from dat_personales where iddat_pers='.$iddat;
          $resultado= mysqli_query($link,$consulta);
          $array=mysqli_fetch_row($resultado);
          $nombres=$array[0];
          echo "<div class='panel-heading'>Reporte de pagos - ".$nombres."</div>";
          
          echo "<div class='panel-body'>
            <table class='table table-striped table-bordered'>
              <thead><tr><th>ESPECIALIDAD</th><th>FECHA</th><th>N° BOLETA</th><th>DETALLE</th><th>MONTO</th><th colspan='2'></th></tr></thead><tr>";
              $query_p='SELECT es.nombre_espec,pa.fecha_b,pa.num_boleta,pa.detalle_p, pa.cantidad, pa.observacion, pa.idpagos, ma.idmatricula
              from matricula as ma INNER JOIN pagos as pa INNER JOIN especialidad as es 
              where ma.idmatricula=pa.idmatricula and ma.id_especialidad=es.id_especialidad and ma.iddat_pers='.$iddat.' ORDER BY pa.fecha_b ASC';
                  
              $resultado1=mysqli_query($link,$query_p);
              
              while($dato=mysqli_fetch_array($resultado1)){
                echo "<td>".$dato['nombre_espec']."</td>
                <td>".$dato['fecha_b']."</td>
                <td>".$dato['num_boleta']."</td>
                <td>".$dato['detalle_p']."</td>
                <td class='text-right'>".$dato['cantidad']."</td>
                <td><p class='text-muted'>".$dato['observacion']."</p></td>
                <td  WIDTH='190'><a href='for_up_pag.php?idp=".$dato['idpagos']."&idpers=".$iddat."&?idm=".$dato['idmatricula']."' target='_blank' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-edit'></span> Modificar</a>
                <a href='del_pag.php?idp=".$dato['idpagos']."&idni=".$iddat."'";?> 
                onclick="return confirm('¿Realmente quiere eliminar el registro?');"  class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-edit"></span> Eliminar</a></td></tr>
                <?php
              }

            echo "</table>";
            if ($res>=1) {
              echo "Faltan ".$res." días para que caduque el pago de matrícula.";
            }
            
          echo"</div>
          <div class='panel-footer text-center'>
            <form action='' method='POST' >
              <button class='btn btn-primary' name='n_pago'>Nuevo pago</button>
            </form>
          </div>
          </div>
        </div>
    </div>
  </div>";

  echo "<div class='row'>
    <div class='col-lg-2 col-md-1 col-sm-1 col-xs-2'></div>
    <div class='col-lg-8 col-md-10 col-sm-10 col-xs-10'>";
  
      if(isset($_REQUEST['n_pago'])){
        echo "<form action='rpago.php' method='POST' class='form-horizontal' role='form'>
          <div class='form-group'>
            <label class='col-lg-6 col-md-6 col-sm-6 col-xs-3 control-label'>Especialidad:</label>
            <div class='col-lg-4 col-md-4 col-sm-4 col-xs-6'>
              <select name='espec' class='form-control'>";
              
                $query="SELECT * FROM dat_personales as dp INNER JOIN matricula as ma INNER JOIN especialidad as es
                WHERE dp.iddat_pers=ma.iddat_pers and ma.id_especialidad=es.id_especialidad and dp.iddat_pers=".$iddat."";

                $resultado =mysqli_query($link,$query) or die("Problemas en el select:".mysqli_error($link));

                while($row = mysqli_fetch_array($resultado)){
                  echo "<OPTION VALUE=".$row['id_especialidad']." >".$row['nombre_espec']."</OPTION>";
                }
              echo "</select>
            </div>
          </div>

          <div class='form-group'>
            <input type='number' name='iddat' class='sr-only' value=".$iddat.">
            <label class='col-lg-6 col-md-6 col-sm-6 col-xs-3 control-label'>Fecha:</label>
            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-5'>
              <input type='date' name='nfecha' class='form-control' placeholder='0000-00-00' maxlength='10' required>
            </div>
          </div>

          <div class='form-group'> 
            <label class='col-lg-6 col-md-6 col-sm-6 col-xs-3 control-label'>Número de boleta:</label>
            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-5'>
              <input type='text' name='nboleta' class='form-control' maxlength='11'>
            </div>
          </div>
          <div class='form-group'> 
            <label class='col-lg-6 col-md-6 col-sm-6 col-xs-3 control-label'>Detalle:</label>
            <div class='col-lg-4 col-md-3 col-sm-3 col-xs-5'>
              <input type='radio' name='det_pag' value='Mensualidad' checked>Mensualidad</br>
              <input type='radio' name='det_pag' value='Matricula'>Matricula</br>
              <input type='radio' name='det_pag' value='Certificado'>Certificado
            </div>
          </div>
            
          <div class='form-group'> 
            <label class='col-lg-6 col-md-6 col-sm-6 col-xs-3 control-label'>Monto S/.</label>
            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-5'>
              <input type='text' name='npago' class='form-control' placeholder='00.00' maxlength='7' required>
            </div>
          </div>

          <div class='form-group'> 
            <label class='col-lg-6 col-md-6 col-sm-6 col-xs-3 control-label'>Observaciones:</label>
            <div class='col-lg-4 col-md-4 col-sm-4 col-xs-6'>
              <input type='text' name='nobsr' class='form-control' maxlength='50'>
            </div>
          </div>

          <div class='col-lg-12 text-center'>
            <button type='submit' class='btn btn-primary'>Registrar</button>
          </div>
        </form>";
      }
    echo "</div>
  </div>";
  
?>
</br>
</div>

</body>
</html>