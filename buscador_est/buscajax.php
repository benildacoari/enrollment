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
  <div class="col-lg-0"></div>
    <div class="col-lg-12">
      <div class="panel panel-primary">
        <div class="panel-heading text-center ">
          BUSQUEDA POR DNI O APELLIDO PATERNO: <input type="text" id="bus"  class="text-primary" name="bus" onkeyup="loadXMLDoc()"  />
        </div>
        <div class="panel-body" id="myDiv"> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>