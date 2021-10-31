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
    <div class="col-lg-8">
      <?php
        include ("conexion.php");
        //datos personales
        $iddp = $_POST['id'];

        $nombres = ucwords(mb_strtolower($_POST['nombres']));
        $paterno = ucwords(mb_strtolower($_POST['a_paterno']));
        $materno = ucwords(mb_strtolower($_POST['a_materno']));
        //$dni = $_POST[ 'dni' ];
        $fecha_nac = $_POST['fecha_nac'];
        $sexo = $_POST['sexo'];
        $email = strtolower($_POST['email']);
        $nro_cel = $_POST['nro_cel'];
        $nro_tel = $_POST['nro_tel'];
        //datos direccion
        $direccion = ucwords(mb_strtolower($_POST[ 'direccion' ]));
        $denominacion = ucwords(mb_strtolower($_POST[ 'denominacion' ]));
        $departamento = ucwords(mb_strtolower($_POST[ 'departamento' ]));
        $provincia = ucwords(mb_strtolower($_POST[ 'provincia' ]));
        $distrito = ucwords(mb_strtolower($_POST[ 'distrito' ]));
        //datos de empresa
        $nom_empresa =ucwords(mb_strtolower($_POST['nom_empresa']));
        $cargo_actual =ucwords(mb_strtolower($_POST['cargo_actual']));
        $area_trabajo =ucwords(mb_strtolower($_POST['area_trabajo']));
        $t_servicio =$_POST['t_servicio'];
        $direccion_e =ucwords(mb_strtolower($_POST['direccion_e']));
        $proced =$_POST['proced'];
        $telefono_t =$_POST['telefono_t'];

        //datos de estudio
        $niv_estudio =$_POST['niv_estudio'];
        $grado_acad =$_POST['grado_acad'];
        if ($grado_acad=="") {
          $grado_acad ="Ninguno";
        }
        $entidad_educ =ucwords(mb_strtolower($_POST['entidad_educ']));
        $proced_e =$_POST['proced_e'];
        $espec =ucwords(mb_strtolower($_POST['espec']));
        $maestria =$_POST['maestria'];
        if ($maestria=="") {
          $maestria ="Ninguno";
        }
        $doctorado =$_POST['doctorado'];
        $nombre_ee =ucwords(mb_strtolower($_POST['nombre_ee']));
        $espec_postg =ucwords(mb_strtolower($_POST['espec_postg']));

        $actualizar = 'UPDATE dat_personales as dp INNER JOIN dat_domicilio as dd ON dp.iddat_dom=dd.iddat_dom 
        INNER JOIN dat_labs as dl ON dp.iddat_labs=dl.iddat_labs
        INNER JOIN niv_educativo as ne ON dp.idniv_educ=ne.idniv_educ
        SET nombres="'.$nombres.'" ,ap_paterno="'.$paterno.'",ap_materno="'.$materno.'",fecha_nac="'.$fecha_nac.'",
        sexo="'.$sexo.'",email="'.$email.'",nro_cel="'.$nro_cel.'",nro_tel="'.$nro_tel.'" ,direccion="'.$direccion.'", denominacion="'.$denominacion.'", 
        departamento="'.$departamento.'", provincia="'.$provincia.'",distrito="'.$distrito.'" , nombre_empresa="'.$nom_empresa.'",
        cargo_actual="'.$cargo_actual.'",area_trabajo="'.$area_trabajo.'",tiempo_servicios="'.$t_servicio.'", direccion_empresa="'.$direccion_e.'",
        procedencia_dl="'.$proced_e.'",telefono ="'.$telefono_t.'",niv_educ_alcanzado="'.$niv_estudio.'", grado_academico="'.$grado_acad.'",
        entidad_educ="'.$entidad_educ.'",procedencia_ne="'.$proced_e.'", especialidad="'.$espec.'", maestria="'.$maestria.'", doctorado="'.$doctorado.'", 
        ent_educ_maestria="'.$nombre_ee.'", especialidad_maestria="'.$espec_postg.'" WHERE dp.iddat_pers='.$iddp.''; 

        $result =mysqli_query($link,$actualizar) 
            or die ("Falló Consulta"); 

        $ides=$_POST['ides'];
        $spago = $_POST['spago'];
        $cpago = $_POST['cpago'];
        $fecha = strftime( "%Y-%m-%d-%H-%M-%S", time());


        $insertar6 = 'INSERT INTO matricula (fecha,iddat_pers,id_especialidad,sistema_pago,condicion_pago)
        	VALUES ( "'.$fecha.'", "'.$iddp.'","'.$ides.'","'.$spago.'","'.$cpago.'")';

        $retry_value6=mysqli_query($link,$insertar6);
        $idm=mysqli_insert_id($link);
      		if (!$retry_value6) {
      	   		die('Error: ' . mysqli_error($link));
      		}else{
            echo "<div class='panel panel-primary'>";
              $consulta='SELECT nombre_espec FROM especialidad as es INNER JOIN matricula as ma 
                WHERE ma.id_especialidad=es.id_especialidad and es.id_especialidad='.$ides;
              $resul=mysqli_query($link,$consulta);
              $array=mysqli_fetch_row($resul);
              $list=$array[0];
              
                echo "<div class='panel-heading'>ESPECIALIDAD: ".$list."</div>";
                $consulta='SELECT * FROM dat_personales as dp INNER JOIN matricula as ma INNER JOIN especialidad as es
                  WHERE ma.iddat_pers=dp.iddat_pers and ma.id_especialidad=es.id_especialidad and es.id_especialidad='.$ides.' ORDER BY ma.idmatricula ASC';
                $result=mysqli_query($link,$consulta);
                $hoy=date("Y-m-d");
                echo "<div class='panel-body'>
                  <table class='table'><thead><tr><th>Nombres y apellidos</th><th colspan='2'></th></tr></thead><tr>";
                    while ($lista=mysqli_fetch_array($result)) {
                      echo "<td>".$lista['nombres']." ".$lista['ap_paterno']." ".$lista['ap_materno']."</td>
                      <td><a href='v_pagos.php?idni=".$lista['iddat_pers']."&idesp=".$lista['id_especialidad']."&idm=".$lista['idmatricula']."' target='_blank' class='btn btn-default btn-sm'>
                      <span class='glyphicon glyphicon-credit-card'></span> Realizar pago</a></td>
                      <td><a href='imprimirficha.php?idf=".$lista['idmatricula']."&fecha=".$hoy."' target='_blank' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-print'></span> Imprimir ficha</a></td></tr>";

                    }
                  echo "</table>
                </div>
              </div>";
        	}
      ?>
    </div>
  </div>
</div>
</body>
</html>