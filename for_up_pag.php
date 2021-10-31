<?php
include ("encabezado.html");

  session_start();
  if (!$_SESSION) {
    echo "<script languaje=javascript>
    alert ('Usted no se ha registrado.')
    self.location='index.php'</script>";
  }?>
    <div class='container'>
      <div class='row'>
        <div class='col-lg-3 col-md-2 col-sm-1 col-xs-0'></div>
        <div class='col-lg-6 col-md-8 col-sm-10 col-xs-12'>
      <?php 
        require ("conexion.php");
        $idpa =$_GET['idp'];
        $idpers =$_GET['idpers'];

        $pers=mysqli_query($link,"select CONCAT(nombres,' ',ap_paterno,' ',ap_materno) as nombres from dat_personales WHERE iddat_pers=".$idpers.""); 
          echo "<form action='proc_up_pag.php' method='POST' class='form-horizontal' role='form'>
            <div class='panel panel-primary'>";   
              while ($es=mysqli_fetch_array($pers)){ 
                echo "<div class='panel-heading'>Reporte de pagos - ".$es['nombres']." - (Modificar pago)</div>
                  <input type='number' class='sr-only'  name='idpers' value=".$idpers.">
                  <input type='number' class='sr-only'  name='idpa' value=".$idpa.">";
              }
              echo "<div class='panel-body'>
                <div class='form-group'>
                  <label class='col-lg-4 col-md-4 col-sm-4 col-xs-3 control-label'>Especialidad:</label>
                  <div class='col-lg-8 col-md-5 col-sm-7 col-xs-8'>";
                    
                    $query="SELECT ma.idmatricula,es.id_especialidad,es.nombre_espec,ma.idmatricula FROM dat_personales as dp INNER JOIN matricula as ma INNER JOIN especialidad as es
                    WHERE dp.iddat_pers=ma.iddat_pers and ma.id_especialidad=es.id_especialidad and dp.iddat_pers=".$idpers."";

                    $resultado =mysqli_query($link,$query) or die("Problemas en el select:".mysqli_error($link));
                    while($row = mysqli_fetch_array($resultado)){
                      echo "<input type='radio' name='espec' VALUE=".$row['id_especialidad']." required>".$row['nombre_espec']."</br>";
                    }
                  echo "</div>
                </div>";
               
                $pagos=mysqli_query($link,"select * from pagos WHERE idpagos=".$idpa.""); 
                while ($pag=mysqli_fetch_array($pagos)){
                echo "<div class='form-group'>
                 <label class='col-lg-4 col-md-4 col-sm-4 col-xs-3 control-label'>Fecha de boleta:</label>
                  <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                    <input type='date' name='nfecha' class='form-control' placeholder='0000-00-00' maxlength='10' value='".$pag['fecha_b']."' required>
                  </div>
                </div>
                <div class='form-group'>
                  <label class='col-lg-4 col-md-4 col-sm-4 col-xs-3 control-label'>N° boleta:</label>
                    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                      <input type='text' name='nboleta' class='form-control' maxlength='11' value='".$pag['num_boleta']."' required>
                    </div>
                </div>
               <div class='form-group'>
                <label class='col-lg-4 col-md-4 col-sm-4 col-xs-3 control-label'>Procedencia:</label>
                  <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";?>
                    <input type="Radio" name="det_pag" value="Mensualidad" <?php if($pag["detalle_p"]=="Mensualidad")echo 'checked="checked"';?>>Mensualidad</br>
                    <input type="Radio" name="det_pag" value="Matricula" <?php if($pag["detalle_p"]=="Matricula")echo 'checked="checked"';?>>Matricula</br>
                    <input type="Radio" name="det_pag" value="Certificado" <?php if($pag["detalle_p"]=="Certificado")echo 'checked="checked"';?>>Certificado
              <?php
                  echo "</div>   
              </div>
                <div class='form-group'>
                  <label class='col-lg-4 col-md-4 col-sm-4 col-xs-3 control-label'>Monto:</label>
                  <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                    <input type='text' name='npago' class='form-control' placeholder='00.00' maxlength='7' value='".$pag['cantidad']."' required>
                  </div>
                </div>
                <div class='form-group'>
                  <label class='col-lg-4 col-md-4 col-sm-4 col-xs-3 control-label'>Observación:</label>
                  <div class='col-lg-8 col-md-5 col-sm-7 col-xs-8'>
                    <input type='text' name='obser' class='form-control' value='".$pag['observacion']."'>
                  </div>
                </div>";
                }
                  echo "<div class='col-lg-12 text-center'>
                    <button type='submit' class='btn btn-success' >Actualizar</button>
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