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

				$idespecialidad = $_POST['idespec'];
				//datos personales
				$nombres = ucwords(mb_strtolower($_POST['nombres']));
				$paterno = ucwords(mb_strtolower($_POST[ 'a_paterno']));
				$materno = ucwords(mb_strtolower($_POST['a_materno']));
				$dni = $_POST[ 'dni' ];
			   		$sq="SELECT dni FROM dat_personales WHERE dni=".$dni."";
			   		$ress=mysqli_query($link,$sq);
			   		$coun=mysqli_num_rows($ress);
					if ($coun==1) {
						echo "<script languaje=javascript>
					    alert ('El DNI ".$dni." ya se ingreso!')
					    self.location='datosp.php?ide=".$idespecialidad."'</script>";
					}

				$fecha_nac = $_POST['fecha_nac'];
				$sexo = $_POST['sexo'];
				$email = strtolower($_POST['email']);
				$nro_cel = $_POST['nro_cel'];
				$nro_tel = $_POST['nro_tel'];
				//datos direccion
				$direccion = ucwords(mb_strtolower($_POST['direccion']));
				$denominacion = ucwords(mb_strtolower($_POST['denominacion']));
				$departamento = ucwords(mb_strtolower($_POST['departamento']));
				$provincia = ucwords(mb_strtolower($_POST['provincia']));
				$distrito = ucwords(mb_strtolower($_POST['distrito']));
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
				$entidad_educ =ucwords(mb_strtolower($_POST['entidad_educ']));
				$proced_e =$_POST['proced_e'];
				$espec =ucwords(mb_strtolower($_POST['espec']));
				$maestria =$_POST['maestria'];
				$doctorado =$_POST['doctorado'];
				$nombre_ee =ucwords(mb_strtolower($_POST['nombre_ee']));
				$espec_postg =ucwords(mb_strtolower($_POST['espec_postg']));

				$insertar2 = 'INSERT INTO dat_domicilio (direccion,denominacion,distrito,provincia,departamento)
					VALUES ( "'.$direccion.'", "'.$denominacion.'", "'.$distrito.'","'.$provincia.'","'.$departamento.'")';
				$retry_value2 =mysqli_query($link,$insertar2);
						if (!$retry_value2) {
					   		die('Error: 1' . mysqli_error($link));
						}
				$iddomicilio=mysqli_insert_id($link);

				$insertar3 = 'INSERT INTO dat_labs (nombre_empresa,cargo_actual,area_trabajo,tiempo_servicios,direccion_empresa,procedencia_dl,telefono)
					VALUES ("'.$nom_empresa.'", "'.$cargo_actual.'", "'.$area_trabajo.'","'.$t_servicio.'","'.$direccion_e.'","'.$proced.'","'.$telefono_t.'")';
				$retry_value3 =mysqli_query($link,$insertar3);
						if (!$retry_value3) {
					   		die('Error: 2' . mysqli_error($link));
						}
				$idempresa=mysqli_insert_id($link);

				$insertar4 = 'INSERT INTO niv_educativo (niv_educ_alcanzado,grado_academico,entidad_educ,procedencia_ne,especialidad,maestria,doctorado,ent_educ_maestria,especialidad_maestria)
					VALUES ("'.$niv_estudio.'", "'.$grado_acad.'",  "'.$entidad_educ.'", "'.$proced_e.'","'.$espec.'","'.$maestria.'","'.$doctorado.'","'.$nombre_ee.'","'.$espec_postg.'")';
				$retry_value4 =mysqli_query($link,$insertar4);
						if (!$retry_value4) {
					   		die('Error: 3' . mysqli_error($link));
						}

				$idestudio=mysqli_insert_id($link);

				$insertar = 'INSERT INTO dat_personales (nombres,ap_paterno,ap_materno,dni,fecha_nac,sexo,email,iddat_dom,iddat_labs,idniv_educ,nro_cel,nro_tel)
					VALUES ("'.$nombres.'", "'.$paterno.'", "'.$materno.'","'.$dni.'","'.$fecha_nac.'","'.$sexo.'","'.$email.'","'.$iddomicilio.'","'.$idempresa.'","'.$idestudio.'","'.$nro_cel.'","'.$nro_tel.'")';
				$retry_value =mysqli_query($link,$insertar);
						if (!$retry_value) {
					   		die('Error: 4' . mysqli_error($link));
						}
				$iddp=mysqli_insert_id($link);

				$cpago = $_POST['cpago'];
				$spago = $_POST['spago'];
				$fecha =strftime( "%Y-%m-%d-%H-%M-%S", time());
				
				$insertar6 = 'INSERT INTO matricula (fecha,iddat_pers,id_especialidad,sistema_pago,condicion_pago)
					VALUES ( "'.$fecha.'", "'.$iddp.'","'.$idespecialidad.'","'.$spago.'","'.$cpago.'")';

				$retry_value6 =mysqli_query($link,$insertar6);
				$idm=mysqli_insert_id($link);

					if (!$retry_value6) {
				   		die('Error: 5' . mysqli_error($link));
					}else{
						echo  "<div class='panel panel-primary'>";
							$consulta='SELECT nombre_espec FROM especialidad as es INNER JOIN matricula as ma 
								WHERE ma.id_especialidad=es.id_especialidad and es.id_especialidad='.$idespecialidad;
							$resul=mysqli_query($link,$consulta);
							$array=mysqli_fetch_row($resul);
							$list=$array[0];
							
							echo "<div class='panel-heading'>".$list."</div>";
							
							$consulta='SELECT * FROM dat_personales as dp INNER JOIN matricula as ma INNER JOIN especialidad as es
								WHERE ma.iddat_pers=dp.iddat_pers and ma.id_especialidad=es.id_especialidad and es.id_especialidad='.$idespecialidad.'';
							$result=mysqli_query($link,$consulta);
							$hoy=date("Y-m-d");
							echo "<div class='panel-body'>
								<table class='table'><tr><th>Nombres y apellidos</th><th colspan='2'></th><tr>";
									while ($lista=mysqli_fetch_array($result)) {
										echo "<td>".$lista['nombres']." ".$lista['ap_paterno']." ".$lista['ap_materno']."</td>
										<td><a href='v_pagos.php?idni=".$lista['iddat_pers']."&idesp=".$lista['id_especialidad']."&idm=".$lista['idmatricula']."' class='btn btn-default btn-sm'>
											<span class='glyphicon glyphicon-usd'></span> Realizar pago</a></td>
										<td><form action='imprimirficha.php' target='_blank' method='GET'>
										        <input type='date' name='fecha' class='sr-only' value=".$hoy.">
										        <input type='number' name='idf' class='sr-only' value=".$idm.">
										        <button type='submit' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-print'></span> Ver Ficha</button>
										</form> </td></tr>";
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