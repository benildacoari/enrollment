<?php
//ob_end_clean();
require ('includes/fpdf/fpdf.php');
require ("conexion.php");

class  MiPDF extends FPDF {
	public function Header(){
		$this->Image('images/inei1.png',8,7,20);
		$this->SetFont('Arial','BI',9);
		$this->SetTextColor(26,30,145);
   		$this->Cell(20,4,'',0,1,'C');
		$this->Cell(126,4,utf8_decode('ESCUELA NACIONAL DE ESTADÍSTICA '),0,0,'C');
		
		$this->Cell(20,4,'',0,0,'C');
		$this->Cell(126,4,utf8_decode('ESCUELA NACIONAL DE ESTADÍSTICA '),0,1,'C');
		$this->Cell(126,4,utf8_decode('E INFORMÁTICA - FILIAL PUNO'),0,0,'C');
		
		$this->Cell(20,4,'',0,0,'C');
		$this->Cell(126,4,utf8_decode('E INFORMÁTICA - FILIAL PUNO'),0,1,'C');
		$this->Image('images/enei1.png',120,-1,20);
		
		$this->Image('images/inei1.png',154,7,20);
		$this->SetFont('Arial','I',9);
		$this->SetTextColor(26,30,145);
		$this->Image('images/enei1.png',266,-1,20);
		
	}
	function footer(){
		$this ->setxy(8,192);
		//$hoy=date("d").' / '.date("m").' / '.date("y");
		$fec= $_GET['fecha'];
		$this->SetFont('Times','I',10);
		$this->Cell(20,4,'FECHA:',0,0,'C');
		$this->Cell(20,4,$fec,1,0,'C');
		$this->Cell(40,4,'FIRMA:',0,0,'R');
		$this->line(88,195,135,195);

		$this ->setxy(155,192);
		$this->Cell(20,4,'FECHA:',0,0,'C');
		$this->Cell(20,4,$fec,1,0,'C');
		$this->Cell(40,4,'FIRMA:',0,0,'R');
		$this->line(235,195,282,195);	
	}
}
$estudianteid= $_GET['idf'];

$mipdf = new MiPDF('L','mm','A4');
$mipdf -> addPage();

$mipdf -> SetFont('Times','B',10);
$mipdf->Cell(126,4,'',0,1,'C');
$mipdf->Cell(80,5,utf8_decode('FICHA DE MATRÍCULA'),0,0,'C');
$mipdf->Cell(10,5,'Nro. ',0,0,'R');
$mipdf->Cell(10,5,'_________',0,1,'L');

$mipdf->Cell(80,4,'',0,1,'C');
$mipdf -> SetFont('Times','B',10);
$mipdf->Cell(80,6,'1.1 DATOS PERSONALES',0,1,'L');

$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(36,4,'APELLIDO PATERNO',1,0,'C');
$mipdf->Cell(36,4,'APELLIDO MATERNO',1,0,'C');
$mipdf->Cell(54,4,'NOMBRES',1,1,'C');

	$consulta1 =mysqli_query($link,"SELECT * FROM dat_personales as dp inner join matricula as m INNER JOIN dat_domicilio AS dm INNER JOIN especialidad AS es inner join dat_labs AS dl inner join niv_educativo AS ne
	where dp.iddat_pers = m.iddat_pers AND dp.iddat_dom=dm.iddat_dom  AND m.id_especialidad=es.id_especialidad AND dp.iddat_labs=dl.iddat_labs and dp.idniv_educ=ne.idniv_educ and m.idmatricula='".$estudianteid."'");
	while ( $datos = mysqli_fetch_array($consulta1) )
	{   
		$mipdf -> SetFont('Arial','',8);
		$appaterno = utf8_decode($datos ['ap_paterno']);
		$mipdf->Cell(36,5,$appaterno,1,0,'C');

		$apmaterno = utf8_decode($datos ['ap_materno']);
		$mipdf->Cell(36,5,$apmaterno,1,0,'C');

		$nombres = utf8_decode($datos['nombres']);
		$mipdf->Cell(54,5,$nombres,1,1,'C');

	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(30,4,'D.N.I.',1,0,'C');
	$mipdf->Cell(54,4,utf8_decode('CORREO ELECTRÓNICO'),1,0,'C');
	$mipdf->Cell(42,4,'FECHA DE NACIMIENTO',1,1,'C');

		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(30,5,$datos['dni'],1,0,'C');
		$mipdf->Cell(54,5,utf8_decode($datos['email']),1,0,'C');
		$mipdf->Cell(42,5,$datos['fecha_nac'],1,1,'C');

$mipdf -> SetFont('Times','B',10);
$mipdf->Cell(80,5,'1.2 DATOS DEL DOMICILIO',0,1,'L');
$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(62,4,'AVENIDA, JIRON, CALLE, PASAJE',1,0,'C');
$mipdf->Cell(64,4,utf8_decode('URBANIZACIÓN / SECTOR'),1,1,'C');

	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(62,4,utf8_decode($datos['direccion']),1,0,'C');
	$mipdf->Cell(64,4,utf8_decode($datos['denominacion']),1,1,'C');

$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(15,5,'DISTRITO',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(30,5,utf8_decode($datos['distrito']),1,0,'C');

$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(17,5,utf8_decode('TELEFÓNO'),1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(22,5,$datos['nro_tel'],1,0,'C');

$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(20,5,'T. CELULAR',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(22,5,$datos['nro_cel'],1,1,'C');

$mipdf -> SetFont('Times','B',10);
$mipdf->Cell(80,6,utf8_decode('2. DATOS DEL CURSO DE CAPACITACIÓN'),0,1,'C');
$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(94,4,utf8_decode('NOMBRE DEL CURSO DE CAPACITACIÓN'),1,0,'C');
$mipdf->Cell(32,4,'FECHA DE INICIO',1,1,'C');

	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(94,5,utf8_decode($datos['nombre_espec']),1,0,'C');
	$mipdf->Cell(32,5,$datos['fecha_inicio'],1,1,'C');

$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(40,4,'FRECUENCIA:',1,0,'C');
$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(43,4,'SISTEMA DE PAGOS',1,0,'C');
$mipdf->Cell(43,4,utf8_decode('CONDICIÓN DE PAGOS'),1,1,'C');
	
	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(40,4,utf8_decode($datos ['frecuencia']),1,0,'C');
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(19,4,'CONTADO',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['sistema_pago']=='Contado'){
		$mipdf->Cell(4,4,'X',1,0,'C');
	}else{
		$mipdf->Cell(4,4,'',1,0,'C');
	}

	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(16,4,'PARTES',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['sistema_pago']=='Partes'){
		$mipdf->Cell(4,4,'X',1,0,'C');
	}else{
		$mipdf->Cell(4,4,'',1,0,'C');
	}

	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(10,4,'P',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['condicion_pago']=='Pagado'){
		$mipdf->Cell(4,4,'X',1,0,'C');
	}else{
		$mipdf->Cell(4,4,'',1,0,'C');
	}
	
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(11,4,'1/2 B',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['condicion_pago']=='Media Beca'){
		$mipdf->Cell(4,4,'X',1,0,'C');
	}else{
		$mipdf->Cell(4,4,'',1,0,'C');
	}
	
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(10,4,'B',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['condicion_pago']=='Beca'){
		$mipdf->Cell(4,4,'X',1,1,'C');
	}else{
		$mipdf->Cell(4,4,'',1,1,'C');
	}
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(26,4,'HORARIO',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(100,4,$datos['horario'],1,1,'C');

$mipdf -> SetFont('Times','B',10);
$mipdf->Cell(80,6,'3. DATOS LABORALES DEL PARTICIPANTE',0,1,'C');

	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(38,4,'NOMBRE DE LA EMPRESA',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(88,4,utf8_decode($datos['nombre_empresa']),1,1,'C');
	
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(38,4,'CARGO ACTUAL',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(88,4,utf8_decode($datos ['cargo_actual']),1,1,'C');
	
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(38,4,utf8_decode('ÁREA DE TRABAJO'),1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(30,4,utf8_decode($datos['area_trabajo']),1,0,'C');

	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(35,4,'TIEMPO DE SERVICIOS',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(23,4,utf8_decode($datos['tiempo_servicios']),1,1,'C');

$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(68,4,utf8_decode('DIRECCIÓN DE LA EMPRESA'),1,0,'C');
$mipdf->Cell(35,4,'PROCEDENCIA',1,0,'C');
$mipdf->Cell(23,4,utf8_decode('TELÉFONO'),1,1,'C');

	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(68,5,utf8_decode($datos['direccion_empresa']),1,0,'C');
	
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(13,5,utf8_decode('PÚBLICO'),1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['procedencia_dl']=='Publico'){
		$mipdf->Cell(4,5,'X',1,0,'C');
	}else{
		$mipdf->Cell(4,5,'',1,0,'C');
	}
	
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(14,5,'PRIVADO',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['procedencia_dl']=='Privado'){
		$mipdf->Cell(4,5,'X',1,0,'C');
	}else{
		$mipdf->Cell(4,5,'',1,0,'C');
	}
	$mipdf->Cell(23,5,$datos['telefono'],1,1,'C');

$mipdf -> SetFont('Times','B',10);
$mipdf->Cell(80,6,'4. NIVEL EDUCATIVO DEL PARTICIPANTE',0,1,'C');

$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(63,4,'NIVEL EDUCATIVO ALCANZADO',1,0,'C');
$mipdf->Cell(63,4,utf8_decode('GRADO DE INSTRUCCIÓN'),1,1,'C');

	$mipdf->Cell(14,4,'SECUND.',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['niv_educ_alcanzado']=='Secundaria'){
		$mipdf->Cell(4,4,'X',1,0,'C');
	}else{
		$mipdf->Cell(4,4,'',1,0,'C');
	}
	
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(16,4,'S. UNIVER.',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['niv_educ_alcanzado']=='Superior Universitario'){
		$mipdf->Cell(4,4,'X',1,0,'C');
	}else{
		$mipdf->Cell(4,4,'',1,0,'C');
	}

	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(21,4,'S. NO UNIVER.',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['niv_educ_alcanzado']=='Superior No Universitario'){
		$mipdf->Cell(4,4,'X',1,0,'C');
	}else{
		$mipdf->Cell(4,4,'',1,0,'C');
	}

	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(17,4,'TITULADO',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['grado_academico']=='Titulado'){
		$mipdf->Cell(4,4,'X',1,0,'C');
	}else{
		$mipdf->Cell(4,4,'',1,0,'C');
	}

	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(21,4,'BACH. EGRES.',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['grado_academico']=='Bachiller Egresado'){
		$mipdf->Cell(4,4,'X',1,0,'C');
	}else{
		$mipdf->Cell(4,4,'',1,0,'C');
	}

	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(13,4,'ESTUD.',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['grado_academico']=='Estudiante'){
		$mipdf->Cell(4,4,'X',1,1,'C');
	}else{
		$mipdf->Cell(4,4,'',1,1,'C');
	}

$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(84,5,'NOMBRE DE LA ENTIDAD EDUCATIVA',1,0,'C');
$mipdf->Cell(42,5,'PROCEDENCIA',1,1,'C');

	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(84,5,utf8_decode($datos['entidad_educ']),1,0,'C');

	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(14,5,'ESTATAL',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['procedencia_ne']=='Publico'){
		$mipdf->Cell(4,5,'X',1,0,'C');
	}else{
		$mipdf->Cell(4,5,'',1,0,'C');
	}
	
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(20,5,'PARTICULAR',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	if($datos['procedencia_ne']=='Privado'){
		$mipdf->Cell(4,5,'X',1,1,'C');
	}else{
		$mipdf->Cell(4,5,'',1,1,'C');
	}
	
   
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(32,5,'ESPECIALIDAD',1,0,'C');
	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(94,5,utf8_decode($datos ['especialidad']),1,1,'C');

$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(32,5,'EST. POST GRADO.',1,0,'C');
$mipdf->Cell(31,5,'EST. NO CONC.',1,0,'C');
$mipdf->Cell(32,5,'EST. CONC.',1,0,'C');
$mipdf->Cell(31,5,'GRADO. ACADE.',1,1,'C');
$mipdf->Cell(32,5,utf8_decode('MAESTRÍA'),1,0,'C');

	$mipdf -> SetFont('Arial','',8);
	if($datos['maestria']=='Estudio no concluido'){
		$mipdf->Cell(31,5,'X',1,0,'C');
	}else{
		$mipdf->Cell(31,5,'',1,0,'C');
	}
	
	if($datos['maestria']=='Estudio concluido'){
		$mipdf->Cell(32,5,'X',1,0,'C');
	}else{
		$mipdf->Cell(32,5,'',1,0,'C');
	}
	
	if($datos['maestria']=='Grado academico'){
		$mipdf->Cell(31,5,'X',1,1,'C');
	}else{
		$mipdf->Cell(31,5,'',1,1,'C');
	}

$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(32,5,'DOCTORADO',1,0,'C');

	$mipdf -> SetFont('Arial','',8);
	if($datos['doctorado']=='Estudio no concluido'){
		$mipdf->Cell(31,5,'X',1,0,'C');
	}else{
		$mipdf->Cell(31,5,'',1,0,'C');
	}
	
	if($datos['doctorado']=='Estudio concluido'){
		$mipdf->Cell(32,5,'X',1,0,'C');
	}else{
		$mipdf->Cell(32,5,'',1,0,'C');
	}
	
	if($datos['doctorado']=='Grado academico'){
		$mipdf->Cell(31,5,'X',1,1,'C');
	}else{
		$mipdf->Cell(31,5,'',1,1,'C');
	}

$mipdf -> SetFont('Times','B',8);
$mipdf->Cell(32,5,'ENTIDAD EDUCATIVA',1,0);

	$mipdf -> SetFont('Arial','',8);
	$mipdf->Cell(94,5,utf8_decode($datos['ent_educ_maestria']),1,1);
	
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(60,5,'NOMBRE O ESPECIALIDAD DEL P. GRADO',1,0);
	
	$mipdf -> SetFont('Arial','',8);
	$apmaterno = $datos ['ap_materno'];
	$mipdf->Cell(66,5,utf8_decode($datos['especialidad_maestria']),1,1);

/*---------------------------------------------------PAGINA 2----------------------------------------------------------*/

	$mipdf->setxy(156,18);
	$mipdf -> SetFont('Times','B',10);
	$mipdf->Cell(80,4,'',0,1,'C');

	$mipdf->setxy(156,26);
	$mipdf->Cell(80,5,utf8_decode('FICHA DE MATRÍCULA'),0,0,'C');
	$mipdf->Cell(10,5,'Nro. ',0,0,'R');
	$mipdf->Cell(10,5,'_________',0,1,'L');

	$mipdf->setxy(156,35);
	$mipdf -> SetFont('Times','B',10);
	$mipdf->Cell(80,6,'1.1 DATOS PERSONALES',0,1,'L');

	$mipdf->setxy(156,41);
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(42,4,'APELLIDO PATERNO',1,0,'C');
	$mipdf->Cell(42,4,'APELLIDO MATERNO',1,0,'C');
	$mipdf->Cell(42,4,'NOMBRES',1,1,'C');
	   
		
			$mipdf->setxy(156,45);
			$mipdf -> SetFont('Arial','',8);
			$appaterno = utf8_decode($datos ['ap_paterno']);
			$mipdf->Cell(42,5,$appaterno,1,0,'C');

			$apmaterno = utf8_decode($datos ['ap_materno']);
			$mipdf->Cell(42,5,$apmaterno,1,0,'C');

			$nombres = utf8_decode($datos['nombres']);
			$mipdf->Cell(42,5,$nombres,1,1,'C');
		
		$mipdf->setxy(156,50);
		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(30,4,'D.N.I.',1,0,'C');
		$mipdf->Cell(54,4,utf8_decode('CORREO ELECTRÓNICO'),1,0,'C');
		$mipdf->Cell(42,4,'FECHA DE NACIMIENTO',1,1,'C');

			$mipdf->setxy(156,54);
			$mipdf -> SetFont('Arial','',8);
			$mipdf->Cell(30,5,$datos['dni'],1,0,'C');
			$mipdf->Cell(54,5,utf8_decode($datos['email']),1,0,'C');
			$mipdf->Cell(42,5,$datos['fecha_nac'],1,1,'C');
		
	$mipdf->setxy(156,59);
	$mipdf -> SetFont('Times','B',10);
	$mipdf->Cell(80,5,'1.2 DATOS DEL DOMICILIO',0,1,'L');

	$mipdf->setxy(156,64);
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(62,4,'AVENIDA, JIRON, CALLE, PASAJE',1,0,'C');
	$mipdf->Cell(64,4,utf8_decode('URBANIZACIÓN / SECTOR'),1,1,'C');

		$mipdf->setxy(156,68);
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(62,4,utf8_decode($datos['direccion']),1,0,'C');
		$mipdf->Cell(64,4,utf8_decode($datos['denominacion']),1,1,'C');

	$mipdf->setxy(156,72);
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(15,5,'DISTRITO',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(30,5,utf8_decode($datos['distrito']),1,0,'C');

	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(17,5,utf8_decode('TELÉFONO'),1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(22,5,$datos['nro_tel'],1,0,'C');

	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(20,5,'T. CELULAR',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(22,5,$datos['nro_cel'],1,1,'C');
	
	$mipdf->setxy(156,77);
	$mipdf -> SetFont('Times','B',10);
	$mipdf->Cell(80,6,utf8_decode('2. DATOS DEL CURSO DE CAPACITACIÓN'),0,1,'C');
	$mipdf->setxy(156,83);
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(94,4,utf8_decode('NOMBRE DEL CURSO DE CAPACITACIÓN'),1,0,'C');
	$mipdf->Cell(32,4,'FECHA DE INICIO',1,1,'C');

		$mipdf->setxy(156,87);
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(94,5,utf8_decode($datos['nombre_espec']),1,0,'C');
		$mipdf->Cell(32,5,$datos['fecha_inicio'],1,1,'C');

	$mipdf->setxy(156,92);
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(40,4,'FRECUENCIA:',1,0,'C');
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(43,4,'SISTEMA DE PAGOS',1,0,'C');
	$mipdf->Cell(43,4,utf8_decode('CONDICIÓN DE PAGOS'),1,1,'C');

		$mipdf->setxy(156,96);
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(40,4,utf8_decode($datos ['frecuencia']),1,0,'C');
		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(19,4,'CONTADO',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['sistema_pago']=='Contado'){
			$mipdf->Cell(4,4,'X',1,0,'C');
		}else{
			$mipdf->Cell(4,4,'',1,0,'C');
		}

		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(16,4,'PARTES',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['sistema_pago']=='Partes'){
			$mipdf->Cell(4,4,'X',1,0,'C');
		}else{
			$mipdf->Cell(4,4,'',1,0,'C');
		}

		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(10,4,'P',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['condicion_pago']=='Pagado'){
			$mipdf->Cell(4,4,'X',1,0,'C');
		}else{
			$mipdf->Cell(4,4,'',1,0,'C');
		}
		
		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(11,4,'1/2 B',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['condicion_pago']=='Media Beca'){
			$mipdf->Cell(4,4,'X',1,0,'C');
		}else{
			$mipdf->Cell(4,4,'',1,0,'C');
		}
		
		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(10,4,'B',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['condicion_pago']=='Beca'){
			$mipdf->Cell(4,4,'X',1,1,'C');
		}else{
			$mipdf->Cell(4,4,'',1,1,'C');
		}

		$mipdf->setxy(156,100);
		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(26,4,'HORARIO',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(100,4,$datos['horario'],1,1,'C');
	
	$mipdf->setxy(156,104);
	$mipdf -> SetFont('Times','B',10);
	$mipdf->Cell(80,6,'3. DATOS LABORALES DEL PARTICIPANTE',0,1,'C');

		$mipdf->setxy(156,110);
		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(38,4,'NOMBRE DE LA EMPRESA',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(88,4,utf8_decode($datos['nombre_empresa']),1,1,'C');

		$mipdf->setxy(156,114);
		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(38,4,'CARGO ACTUAL',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(88,4,utf8_decode($datos ['cargo_actual']),1,1,'C');
		
		$mipdf->setxy(156,118);
		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(38,4,utf8_decode('ÁREA DE TRABAJO'),1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(30,4,utf8_decode($datos['area_trabajo']),1,0,'C');

		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(35,4,'TIEMPO DE SERVICIOS',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(23,4,utf8_decode($datos['tiempo_servicios']),1,1,'C');

	$mipdf->setxy(156,122);
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(68,4,utf8_decode('DIRECCIÓN DE LA EMPRESA'),1,0,'C');
	$mipdf->Cell(35,4,'PROCEDENCIA',1,0,'C');
	$mipdf->Cell(23,4,utf8_decode('TELÉFONO'),1,1,'C');

		$mipdf->setxy(156,126);
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(68,5,utf8_decode($datos['direccion_empresa']),1,0,'C');
		
		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(13,5,utf8_decode('PÚBLICO'),1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['procedencia_dl']=='Publico'){
			$mipdf->Cell(4,5,'X',1,0,'C');
		}else{
			$mipdf->Cell(4,5,'',1,0,'C');
		}
		
		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(14,5,'PRIVADO',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['procedencia_dl']=='Privado'){
			$mipdf->Cell(4,5,'X',1,0,'C');
		}else{
			$mipdf->Cell(4,5,'',1,0,'C');
		}
		$mipdf->Cell(23,5,$datos['telefono'],1,1,'C');
	
	$mipdf->setxy(156,131);
	$mipdf -> SetFont('Times','B',10);
	$mipdf->Cell(80,6,'4. NIVEL EDUCATIVO DEL PARTICIPANTE',0,1,'C');
	$mipdf->setxy(156,137);
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(63,4,'NIVEL EDUCATIVO ALCANZADO',1,0,'C');
	$mipdf->Cell(63,4,utf8_decode('GRADO DE INSTRUCCIÓN'),1,1,'C');

		$mipdf->setxy(156,141);
		$mipdf->Cell(14,4,'SECUND.',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['niv_educ_alcanzado']=='Secundaria'){
			$mipdf->Cell(4,4,'X',1,0,'C');
		}else{
			$mipdf->Cell(4,4,'',1,0,'C');
		}
		
		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(16,4,'S. UNIVER.',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['niv_educ_alcanzado']=='Superior Universitario'){
			$mipdf->Cell(4,4,'X',1,0,'C');
		}else{
			$mipdf->Cell(4,4,'',1,0,'C');
		}

		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(21,4,'S. NO UNIVER.',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['niv_educ_alcanzado']=='Superior No Universitario'){
			$mipdf->Cell(4,4,'X',1,0,'C');
		}else{
			$mipdf->Cell(4,4,'',1,0,'C');
		}

		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(17,4,'TITULADO',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['grado_academico']=='Titulado'){
			$mipdf->Cell(4,4,'X',1,0,'C');
		}else{
			$mipdf->Cell(4,4,'',1,0,'C');
		}

		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(21,4,'BACH. EGRES.',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['grado_academico']=='Bachiller Egresado'){
			$mipdf->Cell(4,4,'X',1,0,'C');
		}else{
			$mipdf->Cell(4,4,'',1,0,'C');
		}

		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(13,4,'ESTUD.',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['grado_academico']=='Estudiante'){
			$mipdf->Cell(4,4,'X',1,1,'C');
		}else{
			$mipdf->Cell(4,4,'',1,1,'C');
		}

	$mipdf->setxy(156,145);
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(84,5,'NOMBRE DE LA ENTIDAD EDUCATIVA',1,0,'C');
	$mipdf->Cell(42,5,'PROCEDENCIA',1,1,'C');

		$mipdf->setxy(156,150);
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(84,5,utf8_decode($datos['entidad_educ']),1,0,'C');

		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(14,5,'ESTATAL',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['procedencia_ne']=='Publico'){
			$mipdf->Cell(4,5,'X',1,0,'C');
		}else{
			$mipdf->Cell(4,5,'',1,0,'C');
		}
		
		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(20,5,'PARTICULAR',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		if($datos['procedencia_ne']=='Privado'){
			$mipdf->Cell(4,5,'X',1,1,'C');
		}else{
			$mipdf->Cell(4,5,'',1,1,'C');
		}
		$mipdf->setxy(156,155);
	    $mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(32,5,'ESPECIALIDAD',1,0,'C');
		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(94,5,utf8_decode($datos ['especialidad']),1,1,'C');

	$mipdf->setxy(156,160);
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(32,5,'EST. POST GRADO.',1,0,'C');
	$mipdf->Cell(31,5,'EST. NO CONC.',1,0,'C');
	$mipdf->Cell(32,5,'EST. CONC.',1,0,'C');
	$mipdf->Cell(31,5,'GRADO. ACADE.',1,1,'C');

	$mipdf->setxy(156,165);
	$mipdf->Cell(32,5,utf8_decode('MAESTRIA'),1,0,'C');

	$mipdf -> SetFont('Arial','',8);
		if($datos['maestria']=='Estudio no concluido'){
			$mipdf->Cell(31,5,'X',1,0,'C');
		}else{
			$mipdf->Cell(31,5,'',1,0,'C');
		}
		
		if($datos['maestria']=='Estudio concluido'){
			$mipdf->Cell(32,5,'X',1,0,'C');
		}else{
			$mipdf->Cell(32,5,'',1,0,'C');
		}
		
		if($datos['maestria']=='Grado academico'){
			$mipdf->Cell(31,5,'X',1,1,'C');
		}else{
			$mipdf->Cell(31,5,'',1,1,'C');
		}

	$mipdf->setxy(156,170);
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(32,5,'DOCTORADO',1,0,'C');

		$mipdf -> SetFont('Arial','',8);
		$mipdf -> SetFont('Arial','',8);
		if($datos['doctorado']=='Estudio no concluido'){
			$mipdf->Cell(31,5,'X',1,0,'C');
		}else{
			$mipdf->Cell(31,5,'',1,0,'C');
		}
		
		if($datos['doctorado']=='Estudio concluido'){
			$mipdf->Cell(32,5,'X',1,0,'C');
		}else{
			$mipdf->Cell(32,5,'',1,0,'C');
		}
		
		if($datos['doctorado']=='Grado academico'){
			$mipdf->Cell(31,5,'X',1,1,'C');
		}else{
			$mipdf->Cell(31,5,'',1,1,'C');
		}


	$mipdf->setxy(156,175);
	$mipdf -> SetFont('Times','B',8);
	$mipdf->Cell(32,5,'ENTIDAD EDUCATIVA',1,0);

		$mipdf -> SetFont('Arial','',8);
		$mipdf->Cell(94,5,utf8_decode($datos['ent_educ_maestria']),1,1);
		
		$mipdf->setxy(156,180);
		$mipdf -> SetFont('Times','B',8);
		$mipdf->Cell(60,5,'NOMBRE O ESPECIALIDAD DEL P. GRADO',1,0);
		
		$mipdf -> SetFont('Arial','',8);
		$apmaterno = $datos ['ap_materno'];
		$mipdf->Cell(66,5,utf8_decode($datos['especialidad_maestria']),1,1);

}

$mipdf -> Output();
?>