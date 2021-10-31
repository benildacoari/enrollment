<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ENEI-Matricula</title>
    <link rel="icon" href="images/im.png" type="image/x-icon" />
    <script type="text/javascript" src="ajax.js"></script>
    <link rel="stylesheet" href="../css/css.css">  
    <link href="../css/bootstrap-3.3.5/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">  
    <script src="../css/bootstrap-3.3.5/js/tests/vendor/jquery.min.js"></script>
    <script src="../css/bootstrap-3.3.5/dist/js/bootstrap.min.js"></script>
</head>
  
<body class="body">
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="col-lg-1"></div>
      <div class="col-lg-10"> 
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>

          <a class="navbar-brand" href="../index.php"><span class="glyphicon glyphicon-home"></span> INICIO</a>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">  
          <ul class="nav nav-pills nav-justified">
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href=""><span class="glyphicon glyphicon-th-list"></span> ESPECIALIDADES <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../cursos.php">Especialidades</a></li>
                <li><a href="../admin_cursos.php">Cursos</a></li>
              </ul>
            </li>
            <li><a href="../matricula_espec.php"><span class="glyphicon glyphicon-cog"></span> MATRICULA</a></li>
            <li><a href="../administrar.php"><span class="glyphicon glyphicon-file"></span> REPORTES</a></li>
            <li><a href="../notas.php"><span class="glyphicon glyphicon-pencil"></span> NOTAS</a></li>
            <li><a href="../view_pagos.php"><span class="glyphicon glyphicon-usd"></span> PAGOS</a></li>
            <li><a href="buscajax.php"><span class="glyphicon glyphicon-search"></span> BUSQUEDA</a></li>
            <li><a href="../u_main.php" class="btn btn-link"><span class="glyphicon glyphicon-off"> </span> SALIR</a></li>
          </ul>
        </div>
      </div>
    </div>   
  </nav>
  
<?php
  session_start();
  if (!$_SESSION) {
    echo "<script languaje=javascript>
    alert ('Usted no se ha registrado.')
    self.location='../index.php'</script>";
  }
?>

<div class="container"> 
  <div class="row">
    <div class="col-lg-2">.</div>
    <div class="col-lg-8 col-md-4">
      <div class="panel panel-primary">
      <?php
      	require ("../conexion.php");
        $iddat=$_GET['idni'];
    	  
        $consulta="SELECT CONCAT(nombres,' ',ap_paterno,' ',ap_materno) as nom,dni FROM dat_personales where iddat_pers=".$iddat."";
        $resultado= mysqli_query($link,$consulta);
        $array=mysqli_fetch_row($resultado);
        $nombres=$array[0];
        $dn=$array[1];
        echo "<div class='panel-heading'><b>HISTORIAL DE CURSOS - ".$nombres."</b></div>";

        $consul='SELECT nombre_espec,nro_horas,fecha_inicio FROM especialidad as es inner join matricula as ma 
        where es.id_especialidad=ma.id_especialidad and ma.iddat_pers='.$iddat.'';
        $resultado1=mysqli_query($link,$consul);
        echo "<div class='panel-body'>" ;
      		echo "<table class='table' >
            <thead><tr><th>Especialidad</th><th>Duración</th><th>Fecha</th></tr></thead></tr>";
            while($dato1 = mysqli_fetch_array($resultado1)){ 
              echo "<td>".$dato1['nombre_espec']."</td>
              <td>".$dato1['nro_horas']." horas</td>
              <td>".$dato1['fecha_inicio']."</td></tr>";
            }  
          echo "</table>";
      ?>
    </div>
  </div>
</div>

</body>
</html>