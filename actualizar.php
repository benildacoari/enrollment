
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
        require ("conexion.php");
        $idpers=$_POST['idni'];
        $ide=$_POST['ides'];
        echo '<form action="recibir_up.php" method="POST" class="form-horizontal" role="form">
          
              <input type="text" name="ides" class="sr-only" value="'.$ide.'">';
        echo '<fieldset class="col-lg-10"><legend class="text-primary leg"><strong>Datos Personales</strong></legend>';
              $resultado=mysqli_query($link,"SELECT * FROM dat_personales where iddat_pers= ".$idpers."");
          
            while($dato = mysqli_fetch_array($resultado)){
                echo '<input type="text" name="id" class="sr-only" value="'.$dato['iddat_pers'].'">
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Nombres:</label>
                <div class="col-lg-5 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="nombres" class="form-control"  pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,34})" maxlength="34" value="'.$dato['nombres'].'" required autofocus>
                </div>
                <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1 control-label text-info">(*)</label>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Apellido paterno:</label>
                <div class="col-lg-5 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="a_paterno" class="form-control" value="'.$dato['ap_paterno'].'" pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})" maxlength="34" required >
                </div>
                <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1 control-label text-info">(*)</label>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Apellido materno:</label>
                <div class="col-lg-5 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="a_materno" class="form-control" value="'.$dato['ap_materno'].'" pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})" maxlength="34">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">DNI:</label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="dni" class="form-control" value='.$dato['dni'].' disabled>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Fecha de Nacimiento:</label>
                <div class="col-md-4 col-md-4 col-sm-4 col-xs-8">
                  <input type="date" name="fecha_nac" class="form-control" value="'.$dato['fecha_nac'].'" placeholder="0000-00-00" maxlength="10">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Sexo:</label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">';?>
                  <input type="Radio" name="sexo" value="Femenino" <?php if($dato["sexo"]=="F")echo 'checked="checked"';?> required>Femenino
                  <input type="Radio" name="sexo" value="Masculino" <?php if($dato["sexo"]=="M")echo 'checked="checked"';?> required>Masculino
              <?php
              echo '</div>
                <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1 control-label text-info">(*)</label>
              </div>     

              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Correo Electronico:</label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="email" class="form-control" value="'.$dato['email'].'" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" maxlength="45">
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Número de Celular:</label>
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="nro_cel" class="form-control" pattern="[0-9]{9}" title="Ingrese números." value="'.$dato['nro_cel'].'" maxlength="12">
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Número de Teléfono:</label>
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="nro_tel" class="form-control" pattern="[0-9]{6,10}" title="Ingrese números." value="'.$dato['nro_tel'].'" maxlength="12">
                </div>
              </div></fieldset>

            <fieldset class="col-lg-10"><legend class="text-primary leg"><strong>Datos de domicilio</strong></legend>';
            }
          
            $resultado1=mysqli_query($link,'SELECT * FROM dat_personales as dp INNER JOIN dat_domicilio as dd 
              where dd.iddat_dom=dp.iddat_pers and dp.iddat_pers= '.$idpers.'');
          
            while($dato = mysqli_fetch_array($resultado1)){
          
              echo '<div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Direccion:</label>
                <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="direccion" class="form-control" value="'.$dato['direccion'].'" maxlength="50">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Denominacion:</label>
                <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="denominacion" class="form-control" value="'.$dato['denominacion'].'" maxlength="45">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Departamento:</label>
                <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="departamento" class="form-control" value="'.$dato['departamento'].'" pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})" maxlength="45">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Provincia:</label>
                <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="provincia" class="form-control" value="'.$dato['provincia'].'" pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})" maxlength="45">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Distrito:</label>
                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="distrito" class="form-control" value="'.$dato['distrito'].'" pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})" required maxlength="45">
                </div>
                <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1 control-label text-info">(*)</label>
              </div></fieldset>

          <fieldset class="col-lg-10"><legend class="text-primary leg"><strong>Datos Laborales</strong></legend>';
            }

          $resultado2=mysqli_query($link,"SELECT * FROM dat_personales as dp INNER JOIN dat_labs as dl 
            where dl.iddat_labs=dp.iddat_pers and dp.iddat_pers= ".$idpers."");
          
            while($dato = mysqli_fetch_array($resultado2)){
        
              echo '<div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Nombre de empresa:</label>
                <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="nom_empresa" class="form-control" value="'.$dato['nombre_empresa'].'" maxlength="40">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Cargo actual:</label>
                <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="cargo_actual" class="form-control" value="'.$dato['cargo_actual'].'" maxlength="45">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Area de trabajo:</label>
                <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="area_trabajo" class="form-control" value="'.$dato['area_trabajo'].'" maxlength="45">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Tiempo de servicios:</label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="t_servicio" class="form-control" value="'.$dato['tiempo_servicios'].'" maxlength="25">
                </div>
              </div>   

              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Direcciòn de empresa:</label>
                <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="direccion_e" class="form-control" value="'.$dato['direccion_empresa'].'" maxlength="45">
                </div>
              </div>   

              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Procedencia:</label>
                  <div class="col-lg-5 col-md-4 col-sm-4 col-xs-8">';?>
                    <input type="Radio" name="proced" value="Publico" <?php if($dato["procedencia_dl"]=="Publico")echo 'checked="checked"';?>>Publico
                    <input type="Radio" name="proced" value="Privado" <?php if($dato["procedencia_dl"]=="Privado")echo 'checked="checked"';?>>Privado
                    <input type="Radio" name="proced" value="Ninguno" <?php if($dato["procedencia_dl"]=="Ninguno")echo 'checked="checked"';?>>Ninguno
              <?php
                  echo '</div>   
              </div>
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Teléfono:</label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="telefono_t" class="form-control" value="'.$dato['telefono'].'" pattern="[0-9]{6,10}" maxlength="12">
                </div>
              </div></fieldset>

          <fieldset class="col-lg-10"><legend class="text-primary leg"><strong>Datos de nivel de estudio</strong></legend>';
            }

            $vari="SELECT * FROM dat_personales as dp INNER JOIN niv_educativo as ne where ne.idniv_educ=dp.iddat_pers and dp.iddat_pers= ".$idpers."";
            $resultado3=mysqli_query($link,$vari);
            while($dato = mysqli_fetch_array($resultado3)){
        
              echo '<div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Nivel de estudio:</label>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">';?>
                    <input type="Radio" name="niv_estudio" value="Secundaria" <?php if($dato["niv_educ_alcanzado"]=="Secundaria")echo 'checked="checked"';?>>Secundaria<br/>
                    <input type="Radio" name="niv_estudio" value="Superior Universitario" <?php if($dato["niv_educ_alcanzado"]=="Superior Universitario")echo 'checked="checked"';?>>Superior Universitario<br/>
                    <input type="Radio" name="niv_estudio" value="Superior No Universitario" <?php if($dato["niv_educ_alcanzado"]=="Superior No Universitario")echo 'checked="checked"';?>>Superior No Universitario
                    <input type="Radio" name="niv_estudio" value="Ninguno" class="sr-only" <?php if($dato["niv_educ_alcanzado"]=="Ninguno")echo 'checked="checked"';?>>
                  <?php
                  echo '</div>
              </div>
            
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Grado academico:</label>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">';?>                
                    <input type="Radio" name="grado_acad" value="Titulado" <?php if($dato["grado_academico"]=="Titulado") echo 'checked="checked"';?>>Titulado<br/>
                    <input type="Radio" name="grado_acad" value="Bach_e" <?php if($dato["grado_academico"]=="Bach_e") echo 'checked="checked"';?>>Bachiller Egresado<br/>
                    <input type="Radio" name="grado_acad" value="Estudiante" <?php if($dato["grado_academico"]=="Estudiante") echo 'checked="checked"';?>>Estudiante
                    <input type="Radio" name="grado_acad" value="Ninguno" class="sr-only" <?php if($dato["grado_academico"]=="Ninguno") echo 'checked="checked"';?>>
                <?php
                echo '</div>
              </div>
            
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Entidad Educativa:</label>
                <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="entidad_educ" class="form-control" value="'.$dato['entidad_educ'].'" maxlength="45">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Procedencia educativa</label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">';?>
                    <input type="Radio" name="proced_e" value="Publico" <?php if($dato["procedencia_ne"]=="Publico") echo 'checked="checked"';?>>Publico
                    <input type="Radio" name="proced_e" value="Privado" <?php if($dato["procedencia_ne"]=="Privado") echo 'checked="checked"';?>>Privado
                    <input type="Radio" name="proced_e" value="Ninguno" class="sr-only" <?php if($dato["procedencia_ne"]=="Ninguno") echo 'checked="checked"';?>>
                <?php
                echo '</div>
              </div>

              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Especialidad:</label>
                <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="espec" class="form-control" value="'.$dato['especialidad'].'" maxlength="70">
                </div>
              </div>   

             <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Maestria:</label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">';?>
                  <input type="Radio" name="maestria" value="Est_nc" <?php if($dato['maestria']=="Est_nc")echo 'checked="checked"';?>>Estudio no concluido<br/>
                  <input type="Radio" name="maestria" value="Est_c" <?php if($dato['maestria']=="Est_c")echo 'checked="checked"';?>>Estudio concluido<br/>
                  <input type="Radio" name="maestria" value="grado_a" <?php if($dato['maestria']=="grado_a")echo 'checked="checked"';?>>Grado academico<br/>
                  <input type="Radio" name="maestria" value="Ninguno" <?php if($dato['maestria']=="Ninguno")echo 'checked="checked"';?>>Ninguno
                <?php
                echo '</div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Doctorado:</label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">';?>
                  <input type="Radio" name="doctorado" value="Est_nc" <?php if($dato["doctorado"]=="Est_nc")echo 'checked="checked"';?>>Estudio no concluido<br/>
                  <input type="Radio" name="doctorado" value="Est_c" <?php if($dato["doctorado"]=="Est_c")echo 'checked="checked"';?>>Estudio concluido<br/>
                  <input type="Radio" name="doctorado" value="grado_a" <?php if($dato["doctorado"]=="grado_a")echo 'checked="checked"';?>>Grado academico<br/>
                  <input type="Radio" name="doctorado" value="Ninguno" <?php if($dato["doctorado"]=="Ninguno")echo 'checked="checked"';?>>Ninguno
                <?php
                echo '</div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Nombre entidad educativa:</label>
                <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="nombre_ee" class="form-control" value="'.$dato['ent_educ_maestria'].'" maxlength="45">
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-5 col-md-5 col-sm-5 col-xs-3 control-label">Especialidad de Post Grado:</label>
                <div class="col-lg-7 col-md-4 col-sm-4 col-xs-8">
                  <input type="text" name="espec_postg" class="form-control" value="'.$dato['especialidad_maestria'].'" maxlength="70">
                </div>
              </div></fieldset>';
            }  
              echo '<fieldset class="col-lg-10"><legend class="text-primary leg"><strong>Condicion de Pago</strong></legend>
                <div class="col-lg-4 form-group"></div>
                <div class="col-lg-8 form-group">
                  <input type="Radio" name="cpago" value="Pagado" checked>Pagado
                  <input type="Radio" name="cpago" value="Media Beca">Media Beca
                  <input type="Radio" name="cpago" value="Beca">Beca
                  <input type="Radio" name="cpago" class="sr-only" value="Ninguno" checked>
                </div>
              </fieldset>
            
              <fieldset class="col-lg-10"><legend class="text-primary leg"><strong>Sistema de Pago</strong></legend>
                <div class="col-lg-4 form-group"></div>
                <div class="col-lg-8 form-group">
                  <input type="Radio" name="spago" value="Contado" checked>Contado 
                  <input type="Radio" name="spago" value="Partes">Partes
                  <input type="Radio" name="spago" class="sr-only" value="Ninguno" checked>
                </div></br>
               </fieldset>
              
              <div class="form-group">
                <div class="col-lg-10 text-center">
                  <button type="submit" class="btn btn-success">Matricular</button>
                </div>
              </div>
           
          </form>';
        ?>
    </div>
  </div>
</br>
</div>

</body>
</html>