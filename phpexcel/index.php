<?php
  session_start();
  if (!$_SESSION) {
    echo "<script languaje=javascript>
    alert ('Usted no se ha registrado.')
    self.location='../index.php'</script>";
  }
	//error_reporting(E_ALL);
	include_once 'Classes/PHPExcel.php';
	require "../conexion.php";
	$esp= $_GET["idc"];

	$resultado=mysqli_query($link,"SELECT * FROM matricula WHERE id_especialidad=".$esp."");
	$num=mysqli_num_rows($resultado);
	if($num==0){
		echo "<script languaje=javascript>
	    alert ('El archivo no contiene registros.')
	    self.location='../administrar.php'</script>";
	}else{

	$objXLS = new PHPExcel();
	$objXLS->getProperties()->setCreator("B. Coari")
    ->setLastModifiedBy("B. Coari")
    ->setTitle("Reporte de Especialidad")
    ->setSubject("Reporte Excel")
    ->setDescription("Reporte de estudiantes")
    ->setKeywords("Reporte estudiantes por especialidad")
    ->setCategory("Reporte");

	$objSheet= $objXLS->setActiveSheetIndex(0);

	$objSheet->setCellValue('A1','AP_PATERNO');
	$objSheet->setCellValue('B1','AP_MATERNO');
	$objSheet->setCellValue('C1','NOMBRES');
	$objSheet->setCellValue('D1','DNI');
	$objSheet->setCellValue('E1','CORREO_ELECTRONICO');
	$objSheet->setCellValue('F1','DIA');
	$objSheet->setCellValue('G1','MES');
	$objSheet->setCellValue('H1','AÃ‘O');
	$objSheet->setCellValue('I1','SEXO');

	$objSheet->setCellValue('J1','DIRECCION');
	$objSheet->setCellValue('K1','DISTRITO');
	$objSheet->setCellValue('M1','TEL_CELULAR');
	$objSheet->setCellValue('L1','TEL_FIJO');

	$objSheet->setCellValue('N1','CURSO');
	$objSheet->setCellValue('O1','FECHA_INICIO');
	$objSheet->setCellValue('P1','FECHA_TERMINO');
	$objSheet->setCellValue('Q1','NRO_HORAS');

	$objSheet->setCellValue('R1','MODO_PAGO');
	$objSheet->setCellValue('S1','CONDICION_PAGO');

	$objSheet->setCellValue('T1','NOMBRE_EMPRESA');
	$objSheet->setCellValue('U1','CARGO_ACTUAL');
	$objSheet->setCellValue('V1','AREA_TRABAJO');
	$objSheet->setCellValue('W1','TIEMPO_SERVICIOS');
	$objSheet->setCellValue('X1','DIRECCION_EMPRESA');
	$objSheet->setCellValue('Y1','PROCEDENCIA');
	$objSheet->setCellValue('Z1','TELEFONO');

	$objSheet->setCellValue('AA1','NIVEL EDUCATIVO');
	$objSheet->setCellValue('AB1','GRADO ACADEMICO');
	$objSheet->setCellValue('AC1','ENTIDAD EDUCATIVA');
	$objSheet->setCellValue('AD1','PROCEDENCIA');
	$objSheet->setCellValue('AE1','ESPECIALIDAD');

	$objSheet->setCellValue('AF1','MAESTRIA');
	$objSheet->setCellValue('AG1','DOCTORADO');
	$objSheet->setCellValue('AH1','NOMBRE_ENTIDAD_EDUCATIVA');
	$objSheet->setCellValue('AI1','ESPECIALIDAD_POST_GRADO');

	$objSheet->getColumnDimension('A')->setAutoSize(true);
	$objSheet->getColumnDimension('B')->setAutoSize(true);
	$objSheet->getColumnDimension('C')->setAutoSize(true);
	$objSheet->getColumnDimension('D')->setWidth(10);
	$objSheet->getColumnDimension('E')->setAutoSize(true);
	$objSheet->getColumnDimension('F')->setAutoSize(true);
	$objSheet->getColumnDimension('G')->setAutoSize(true);
	$objSheet->getColumnDimension('H')->setAutoSize(true);
	$objSheet->getColumnDimension('I')->setAutoSize(true);
	$objSheet->getColumnDimension('J')->setAutoSize(true);
	$objSheet->getColumnDimension('K')->setAutoSize(true);
	$objSheet->getColumnDimension('L')->setAutoSize(true);
	$objSheet->getColumnDimension('M')->setAutoSize(true);
	$objSheet->getColumnDimension('N')->setAutoSize(true);
	$objSheet->getColumnDimension('O')->setAutoSize(true);
	$objSheet->getColumnDimension('P')->setAutoSize(true);
	$objSheet->getColumnDimension('Q')->setAutoSize(true);
	$objSheet->getColumnDimension('R')->setAutoSize(true);
	$objSheet->getColumnDimension('S')->setAutoSize(true);
	$objSheet->getColumnDimension('T')->setAutoSize(true);
	$objSheet->getColumnDimension('U')->setAutoSize(true);
	$objSheet->getColumnDimension('V')->setAutoSize(true);
	$objSheet->getColumnDimension('W')->setAutoSize(true);
	$objSheet->getColumnDimension('X')->setAutoSize(true);
	$objSheet->getColumnDimension('Y')->setAutoSize(true);
	$objSheet->getColumnDimension('Z')->setAutoSize(true);
	$objSheet->getColumnDimension('AA')->setAutoSize(true);
	$objSheet->getColumnDimension('AB')->setAutoSize(true);
	$objSheet->getColumnDimension('AC')->setAutoSize(true);
	$objSheet->getColumnDimension('AD')->setAutoSize(true);
	$objSheet->getColumnDimension('AE')->setAutoSize(true);
	$objSheet->getColumnDimension('AF')->setAutoSize(true);
	$objSheet->getColumnDimension('AG')->setAutoSize(true);
	$objSheet->getColumnDimension('AH')->setAutoSize(true);
	$objSheet->getColumnDimension('AI')->setAutoSize(true);

	$objSheet->getStyle('A1:I1')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'B8E4AD')
	        )
	    )
	);

	$objSheet->getStyle('J1:M1')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'ADCEE4')
	        )
	    )
	);

	$objSheet->getStyle('N1:Q1')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'D7E4AD')
	        )
	    )
	);

	$objSheet->getStyle('R1:S1')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'C7C8C5')
	        )
	    )
	);

	$objSheet->getStyle('T1:Z1')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'A7B6D5')
	        )
	    )
	);

	$objSheet->getStyle('AA1:AE1')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'A9C9BC')
	        )
	    )
	);

	$objSheet->getStyle('AF1:AI1')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'D8F078')
	        )
	    )
	);

	$styleArray = array(
	    'borders' => array(
	        'top' => array(
	            'style' => PHPExcel_Style_Border::BORDER_THIN,
	        ),
	    ),
	);
	 
	$objSheet->getStyle('A1:AA1')->applyFromArray($styleArray);

	$objSheet->getStyle('D')->getNumberFormat()->setFormatCode('00000000');
	$objSheet->getStyle('F')->getNumberFormat()->setFormatCode('00');
	$objSheet->getStyle('G')->getNumberFormat()->setFormatCode('00');


	$grupo=mysqli_query($link,'SELECT * FROM especialidad as e inner join matricula as m inner join dat_personales as dap inner join dat_domicilio as dom inner join dat_labs as dl inner join niv_educativo as ne
		where  e.id_especialidad=m.id_especialidad and m.iddat_pers=dap.iddat_pers and dap.iddat_dom=dom.iddat_dom and dap.iddat_labs=dl.iddat_labs and dap.idniv_educ=ne.idniv_educ and e.id_especialidad='.$esp.'');
	$y=1;
	while ($dato=mysqli_fetch_array($grupo)) {
		$y++;

		$dia = date("d",strtotime($dato['fecha_nac']));
		$mes = date("m",strtotime($dato['fecha_nac']));
		$anio = date("Y",strtotime($dato['fecha_nac']));

			$objSheet->setCellValue('A'.$y,$dato['ap_paterno']);
			$objSheet->setCellValue('B'.$y,$dato['ap_materno']);
			$objSheet->setCellValue('C'.$y,$dato['nombres']);
			$objSheet->setCellValue('D'.$y,$dato['dni']);	
			$objSheet->setCellValue('E'.$y,$dato['email']);
			$objSheet->setCellValue('F'.$y,$dia);
			$objSheet->setCellValue('G'.$y,$mes);
			$objSheet->setCellValue('H'.$y,$anio);
			$objSheet->setCellValue('I'.$y,$dato['sexo']);
			$objSheet->setCellValue('L'.$y,$dato['nro_cel']);
			$objSheet->setCellValue('M'.$y,$dato['nro_tel']);

			$objSheet->setCellValue('J'.$y,$dato['direccion']);
			$objSheet->setCellValue('K'.$y,$dato['distrito']);
			
	
			$objSheet->setCellValue('N'.$y,$dato['nombre_espec']);
			$objSheet->setCellValue('O'.$y,$dato['fecha_inicio']);
			$objSheet->setCellValue('P'.$y,$dato['fecha_fin']);
			$objSheet->setCellValue('Q'.$y,$dato['nro_horas']);
	
		if ($dato['sistema_pago']=='Ninguno') {
			$dato['sistema_pago']='';
		}
		if ($dato['condicion_pago']=='Ninguno') {
			$dato['condicion_pago']='';
		}
			$objSheet->setCellValue('R'.$y,$dato['sistema_pago']);
			$objSheet->setCellValue('S'.$y,$dato['condicion_pago']);

		if ($dato['procedencia_dl']=='Ninguno') {
			$dato['procedencia_dl']='';
		}
		if ($dato['tiempo_servicios']==0) {
			$dato['tiempo_servicios']='';
		}
			$objSheet->setCellValue('T'.$y,$dato['nombre_empresa']);
			$objSheet->setCellValue('U'.$y,$dato['cargo_actual']);
			$objSheet->setCellValue('V'.$y,$dato['area_trabajo']);
			$objSheet->setCellValue('W'.$y,$dato['tiempo_servicios']);
			$objSheet->setCellValue('X'.$y,$dato['direccion_empresa']);
			$objSheet->setCellValue('Y'.$y,$dato['procedencia_dl']);
			$objSheet->setCellValue('Z'.$y,$dato['telefono']);
	
		if ($dato['niv_educ_alcanzado']=='Ninguno') {
			$dato['niv_educ_alcanzado']='';
		}
		if ($dato['grado_academico']=='Ninguno') {
			$dato['grado_academico']='';
		}
		if ($dato['procedencia_ne']=='Ninguno') {
			$dato['procedencia_ne']='';
		}
		if ($dato['maestria']=='Ninguno') {
			$dato['maestria']='';
		}
		if ($dato['doctorado']=='Ninguno') {
			$dato['doctorado']='';
		}
			$objSheet->setCellValue('AA'.$y,$dato['niv_educ_alcanzado']);
			$objSheet->setCellValue('AB'.$y,$dato['grado_academico']);
			$objSheet->setCellValue('AC'.$y,$dato['entidad_educ']);
			$objSheet->setCellValue('AD'.$y,$dato['procedencia_ne']);
			$objSheet->setCellValue('AE'.$y,$dato['especialidad']);

			$objSheet->setCellValue('AF'.$y,$dato['maestria']);
			$objSheet->setCellValue('AG'.$y,$dato['doctorado']);
			$objSheet->setCellValue('AH'.$y,$dato['ent_educ_maestria']);
			$objSheet->setCellValue('AI'.$y,$dato['especialidad_maestria']);
	$espe_nombre=utf8_decode($dato['nombre_espec']);
	}

	$objXLS->getActiveSheet()->setTitle("datos personales");
	$objXLS->setActiveSheetIndex(0);
	$d=date("mdHi");
	$objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel2007');
	$objWriter->save('D:Escuela Nacional de Estadìstica e Informàtica\cursos\Reg_matricula_'.$espe_nombre.'_'.$d.'.xlsx');

	echo "<script languaje=javascript>
    alert ('El archivo se descargo en la carpeta [Escuela Nacional de Estadistica e Informatica] de la unidad D ')
    self.location='../administrar.php'</script>";

	exit;
	}
mysqli_close($link);
?>
		