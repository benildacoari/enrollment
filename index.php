<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
    <title>ENEI-Matricula</title>
    <link rel="icon" href="images/im.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/index.css">
    <link href="css/bootstrap-3.3.5/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">  
    
</head>
<body>

  <header class="containerb">
    <section class="contentb">
      
      <p class="blackt">
        <img src="images/inei.png" alt="logo inei" style="float:center;width:60px;height:60px;">
        INSTITUTO NACIONAL DE ESTADÍSTICA E INFORMÁTICA
      </p>
      <p class="blacks">
        <a href="https://www.inei.gob.pe/enei/cursos-programados/9/" target="_blank"><img src="images/enei.png" alt="logo inei" style="float:center;width:80px;height:80px;"></a>
        Escuela Nacional de Estadística e Infórmatica
      </p>

      <p class="sub-title">SISTEMA DE MATRICULA</p>

    <?php
      session_start();
      if (!$_SESSION) {
        echo "<form action='' method='POST'class='form-horizontal'>
          <div class='form-group col-lg-12 col-md-12 col-sm-12 text-center'>
            <button class='butn' name='accede'><span class='glyphicon glyphicon-eject'></span> ACCEDER</button>
          </div>
        </form>";

          if(isset($_REQUEST['accede'])){
            echo "<div class='col-lg-4 col-md-3 col-sm-2 '></div><div class='col-lg-4 col-md-6 col-sm-8 col-xs-12'>
            <form action='recibir_l.php' method='POST'class='form-horizontal'>
              <div class='form-group col-lg-6 col-md-6 col-sm-5 col-xs-6 text-right'>
                <label class='control-label tx'>USUARIO: </label>
              </div>
              <div class='form-group col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                <input type='text' class='form-control' name='user' placeholder='Usuario' autofocus>
              </div>
              <div class='form-group col-lg-6 col-md-6 col-sm-5 col-xs-6 text-right'>
                <label class='control-label tx'>PASSWORD: </label>
              </div>
              <div class='form-group col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                <input type='password' class='form-control' name='pass' placeholder='Password'>
              </div>
              
              <div class='form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>
                <button class='btn btn-info' name='ingresar'><span class='glyphicon glyphicon-log-in'></span> Ingresar</button>
              </div>
            </form></div>";
            }

      }else{
        echo '<a class="button" href="cursos.php"><span class="glyphicon glyphicon-th-list"></span> ESPECIALIDADES</a>
        <a class="button" href="matricula_espec.php"><span class="glyphicon glyphicon-cog"></span> MATRICULAS</a>
        <a class="button" href="administrar.php"><span class="glyphicon glyphicon-file"></span> REPORTES</a>
        <a class="button" href="notas.php"><span class="glyphicon glyphicon-pencil"></span> NOTAS<a>
        <a class="button" href="view_pagos.php"><span class="glyphicon glyphicon-usd"></span> PAGOS<a>
        <a class="button" href="buscador_est/buscajax.php"><span class="glyphicon glyphicon-search"></span> BUSQUEDA</a>
        <br/>
        </br><a href="u_main.php" class="btn btn-info" role="button"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesion</a>
        <p>Desarrollado por B. Coari</p>';

      }
      
      ?>
    </section>
  </header>
</body>
</html>