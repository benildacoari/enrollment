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
    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <table class='table table-hover'>
        <tr>
          <td class='text-center'>
            <form action='' method='POST'class='form-horizontal'>
              <div class='form-group col-lg-10 col-md-12 col-sm-9 col-xs-12'>
                <input type='search' name='busqueda' placeholder='Búsqueda por DNI'>
              </div>
              <div class='form-group col-lg-2 col-md-12 col-sm-2 col-xs-12 text-center'>
                <button class='btn btn-info' name='sdni'>Buscar</button>
              </div>
            </form>
          </td>
        </tr>
      </table>
      <?php
        require ("conexion.php");
        $idss=$_GET['ide'];
          if(isset($_REQUEST['sdni'])){
            echo '<div class="panel panel-primary">
              <div class="panel-heading">RESULTADO(S): </div>
              <div class="panel-body">';

                $q=$_POST['busqueda'];
                $sql="select CONCAT(nombres,' ',ap_paterno) as nombre, dni,iddat_pers from dat_personales WHERE dni LIKE '".$q."%'";
                $res=mysqli_query($link,$sql);
                if(mysqli_num_rows($res)==0){
                  echo "<b>No hay sugerencias</b>";
                }else{
                  echo "<table class='table table-hover'><thead><tr><th>Nombres</th><th>DNI</th></tr></thead><tr>";
                      while($fila=mysqli_fetch_array($res)){
                        echo "<td>".$fila['nombre']."</td><form action='actualizar.php' method='POST'class='form-horizontal'>
                        <td><input class='sr-only' name='idni' value=".$fila['iddat_pers'].">
                        <input class='sr-only' name='ides' value=".$idss.">
                        <button type='submit' class='btn btn-info'>".$fila['dni']."</button></form></td></tr>";
                      }
                  echo "</table>";
                }
              echo "</div>
            </div>";
          }
      ?> 
    </div>
    <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
      <form action="recibir_dp.php" method="POST" class="form-horizontal" role="form" >

        <?php
          $resultado=mysqli_query($link,'SELECT nombre_espec FROM especialidad WHERE id_especialidad='.$idss.'');
          $array=mysqli_fetch_row($resultado);
          $nombre_espec=$array[0]; 

          echo "<fieldset class='col-lg-10'>
            <legend class='text-primary leg'>ESPECIALIDAD-".$nombre_espec."</legend></fieldset>
            <input type='text' class='sr-only form-control'  name='idespec' value=".$idss.">";
        ?>
          <fieldset class="col-lg-10 "><legend class="text-primary leg"><strong>Datos Personales</strong></legend>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label" >Nombres:</label>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="nombres" class="form-control" pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ']{2,34})" maxlength="34" required autofocus>
              </div>

              <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1 control-label text-info">(*)</label>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Apellido paterno:</label>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="a_paterno" class="form-control" pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ']{2,25})" maxlength="34" required >
              </div>
              <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1 control-label text-info">(*)</label>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Apellido materno:</label>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="a_materno" class="form-control" pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ']{2,25})" maxlength="34">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">DNI:</label>
              <div class="col-lg-3 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="dni" class="form-control" pattern="[0-9]{8}" title='Ingrese números de 8 cifras.' required>
              </div>
              <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1 control-label text-info">(*)</label>
            </div>

            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Fecha de Nacimiento:</label>
              <div class="col-md-4 col-md-4 col-sm-4 col-xs-8">
                <input type="date" name="fecha_nac" class="form-control" placeholder="0000-00-00" maxlength="10" maxlength="10">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Sexo:</label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                  <input type="radio" name="sexo" value="F" required>Femenino
                 <input type="radio" name="sexo" value="M" required>Masculino
                </div>
                <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1 control-label text-info">(*)</label>
            </div>     

            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Correo Electronico:</label>
              <div class="col-lg-6 col-md-4 col-sm-4 col-xs-8">
                <input type="email" name="email" class="form-control" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" maxlength="45"> 
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Número de Celular:</label>
              <div class="col-lg-3 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="nro_cel" class="form-control" pattern="[0-9]{9}" title="Ingrese números." maxlength="12">
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Número de Teléfono:</label>
              <div class="col-lg-3 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="nro_tel" class="form-control" pattern="[0-9]{6,10}" title="Ingrese números." maxlength="12">
              </div>
            </div>
          </fieldset>
                
          <fieldset class="col-lg-10"><legend class="text-primary leg"><strong>Datos de Domicilio</strong></legend>
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Direccion:</label>
              <div class="col-lg-6 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="direccion" class="form-control" maxlength="50">
              </div>
            </div>
              
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Urb. /Barrio /Otro:</label>
              <div class="col-lg-6 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="denominacion" class="form-control" maxlength="45" >
              </div>
            </div>
              
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Departamento:</label>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="departamento" class="form-control" pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ']{2,25})" maxlength="45" value="Puno">
              </div>
            </div>
              
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Provincia:</label>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="provincia" class="form-control" pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ']{2,25})" maxlength="45" value="Puno">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Distrito:</label>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="distrito" class="form-control" pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ']{2,25})" maxlength="45" required>
              </div>
              <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1 control-label text-info">(*)</label>
            </div>
          </fieldset>

          <fieldset class="col-lg-10"><legend class="text-primary leg"><strong>Datos Laborales</strong></legend>

            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Nombre de empresa:</label>
              <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="nom_empresa" class="form-control" maxlength="40">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Cargo actual:</label>
              <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="cargo_actual" class="form-control" maxlength="45">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Area de trabajo:</label>
              <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="area_trabajo" class="form-control" maxlength="45">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Tiempo de servicios:</label>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <input type="text" name="t_servicio" class="form-control" maxlength="25">
              </div>
            </div>   

            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Direcciòn de empresa:</label>
              <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="direccion_e" class="form-control" maxlength="45">
              </div>
            </div>   

            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Procedencia:</label>
              <div class="col-lg-5 col-md-5 col-sm-5 col-xs-8">
                <input type="Radio" name="proced" value="Publico">Publico
                <input type="Radio" name="proced" value="Privado">Privado
                <input type="Radio" name="proced" value="Ninguno" checked>Ninguno
              </div>
            </div>   

            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Telefono:</label>
              <div class="col-lg-3 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="telefono_t" class="form-control" maxlength="12" pattern="[0-9]{6,10}">
              </div>
            </div>
          </fieldset>

          <fieldset class="col-lg-10"><legend class="text-primary leg"><strong>Datos de Nivel de Estudio</strong></legend>

            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Nivel de estudio:</label>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-8">
                  <input type="Radio" name="niv_estudio" value="Secundaria">Secundaria<br/>
                  <input type="Radio" name="niv_estudio" value="Superior Universitario">Superior Universitario<br/>
                  <input type="Radio" name="niv_estudio" value="Superior No Universitario">Superior No Universitario
                  <input type="Radio" name="niv_estudio" class="sr-only" value="Ninguno" checked>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Grado academico:</label>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                <input type="Radio" name="grado_acad" value="Titulado">Titulado<br/>
                <input type="Radio" name="grado_acad" value="Bachiller Egresado">Bachiller Egresado<br/>
                <input type="Radio" name="grado_acad" value="Estudiante">Estudiante
                <input type="Radio" name="grado_acad" class="sr-only" value="Ninguno" checked>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Entidad Educativa:</label>
              <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="entidad_educ" maxlength="70" class="form-control">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Procedencia educativa:</label>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                <input type="Radio" name="proced_e" value="Publico">Publico
                <input type="Radio" name="proced_e" value="Privado">Privado
                <input type="Radio" name="proced_e" class="sr-only" value="Ninguno" checked>
              </div>
            </div> 

            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Especialidad:</label>
              <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="espec" maxlength="70" class="form-control">
              </div>
            </div>   

            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Maestria:</label>
              <div class="col-lg-5 col-md-5 col-sm-5 col-xs-8">
                <input type="Radio" name="maestria" value="Estudio no concluido">Estudio no concluido<br/>
                <input type="Radio" name="maestria" value="Estudio concluido">Estudio concluido<br/>
                <input type="Radio" name="maestria" value="Grado academico">Grado academico<br/>
                <input type="Radio" name="maestria" value="Ninguno" checked>Ninguno
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Doctorado:</label>
              <div class="col-lg-5 col-md-5 col-sm-5 col-xs-8">
                <input type="Radio" name="doctorado" value="Estudio no concluido">Estudio no concluido<br/>
                <input type="Radio" name="doctorado" value="Estudio concluido">Estudio concluido<br/>
                <input type="Radio" name="doctorado" value="Grado academico">Grado academico<br/>
                <input type="Radio" name="doctorado" value="Ninguno" checked>Ninguno
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Nombre entidad educativa:</label>
              <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="nombre_ee" maxlength="45" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Especialidad de Post Grado:</label>
              <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                <input type="text" name="espec_postg" maxlength="70" class="form-control">
              </div>
            </div>
          </fieldset>
          
          <fieldset class="col-lg-10"><legend class="text-primary leg"><strong>Condicion de Pago</strong></legend>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8 form-group"></div>
              <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-group">
                <input type="Radio" name="cpago" value="Pagado">Pagado
                <input type="Radio" name="cpago" value="Media Beca">Media Beca
                <input type="Radio" name="cpago" value="Beca">Beca
                <input type="Radio" name="cpago" class="sr-only" value="Ninguno" checked>
            </div>
          </fieldset>

          <fieldset class="col-lg-10"><legend class="text-primary leg"><strong>Sistema de Pago</strong></legend>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8 form-group"></div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-group">
              <input type="Radio" name="spago" value="Contado">Contado
              <input type="Radio" name="spago" value="Partes">Partes
              <input type="Radio" name="spago" class="sr-only" value="Ninguno" checked>
            </div>
          </fieldset>
          
          <div class="form-group">
              <div class="col-lg-10 text-center">
                <button type="submit" class="btn btn-primary">Matricular</button>
              </div>
          </div>
      </form>
    </div>
  </div>
  </br>
</div>

</body>
</html>