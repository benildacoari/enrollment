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
        include ("conexion.php");
        //datos personales
        $iddp = $_POST['id'];

        $nombres = ucwords(mb_strtolower($_POST['nombres']));
        $paterno = ucwords(mb_strtolower($_POST['a_paterno']));
        $materno = ucwords(mb_strtolower($_POST['a_materno']));
        $fecha_nac = $_POST['fecha_nac'];
        $sexo = $_POST['sexo'];
        $email = strtolower($_POST['email']);
        $nro_cel = $_POST['nro_cel'];
        $nro_tel = $_POST['nro_tel'];
        //datos direccion
        $direccion = ucwords(mb_strtolower($_POST[ 'direccion' ]));
        $denominacion = ucwords(mb_strtolower($_POST['denominacion']));
        $departamento = ucwords(mb_strtolower($_POST['departamento']));
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

        $result =mysqli_query($link,$actualizar); 
        	if (!$result) {
      	   	die('Complete los datos: '.mysqli_error($link));
      		}else{
            header("location:actualizard.php?idni=".$iddp);  
        	}
      ?>
    </div>
  </div>
</div>
</body>
</html>