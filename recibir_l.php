<?php
session_start();
?>
	 
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
		$username = $_POST['user'];
		$password = $_POST['pass'];

			if ($username=='enei' && $password=='Abc123') {
				$_SESSION['username'] = $username;
				header('location: index.php');
			}else {
				echo "<script languaje=javascript>
				alert ('Usuario o Password es incorrecto, por favor verifique.')
				self.location='index.php'</script>";
			}
		?>
	</section>
  </header>
</body>
</html>
