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

	$resultado=mysqli_query($link,"SELECT * FROM pagos WHERE id_especialidad=".$esp."");
	$num=mysqli_num_rows($resultado);
	if($num==0){
		echo "<script languaje=javascript>
	    alert ('El archivo no contiene registros.')
	    self.location='../view_pagos.php'</script>";
	}else{

	$objXLS = new PHPExcel();
	$objXLS->getProperties()->setCreator("B. Coari")
    ->setLastModifiedBy("B. Coari")
    ->setTitle("Reporte de pagos por Especialidad")
    ->setSubject("Reporte Excel")
    ->setDescription("Reporte de pagos")
    ->setKeywords("Reporte pagos por especialidad")
    ->setCategory("Reporte");

	$objSheet= $objXLS->setActiveSheetIndex(0);

	$objSheet->setCellValue('A1','AP_PATERNO');
	$objSheet->setCellValue('B1','AP_MATERNO');
	$objSheet->setCellValue('C1','NOMBRES');
	$objSheet->setCellValue('D1','DNI');

	$objSheet->setCellValue('E1','ESPECIALIDAD');
	$objSheet->setCellValue('F1','FECHA DE BOLETA');
	$objSheet->setCellValue('G1','NRO_BOLETA');
	$objSheet->setCellValue('H1','DETALLE');
	$objSheet->setCellValue('I1','MONTO');
	$objSheet->setCellValue('J1','OBSERVACIONES');

	$objSheet->getColumnDimension('A')->setAutoSize(true);
	$objSheet->getColumnDimension('B')->setAutoSize(true);
	$objSheet->getColumnDimension('C')->setAutoSize(true);
	$objSheet->getColumnDimension('D')->setAutoSize(true);
	$objSheet->getColumnDimension('E')->setAutoSize(true);
	$objSheet->getColumnDimension('F')->setAutoSize(true);
	$objSheet->getColumnDimension('G')->setAutoSize(true);
	$objSheet->getColumnDimension('H')->setAutoSize(true);
	$objSheet->getColumnDimension('I')->setAutoSize(true);
	$objSheet->getColumnDimension('J')->setAutoSize(true);
	
	$objSheet->getStyle('A1:D1')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'B8E4AD')
	        )
	    )
	);

	$objSheet->getStyle('E1:J1')->applyFromArray(
	    array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'ADCEE4')
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
	
	$objSheet->getStyle('A1:J1')->applyFromArray($styleArray);

	$objSheet -> getStyle ( 'D' )-> getNumberFormat ()-> setFormatCode ('00000000');
	$objSheet -> getStyle ( 'I' )-> getNumberFormat ()-> setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$y=1;
	
	$grupo1=mysqli_query($link,'SELECT * FROM pagos as pa inner join especialidad as e inner join matricula as m inner join dat_personales as dap 
		where  pa.idmatricula=m.idmatricula and e.id_especialidad=m.id_especialidad and m.iddat_pers=dap.iddat_pers and pa.id_especialidad='.$esp.'') or die (mysqli_error($link));
	while ($dato=mysqli_fetch_array($grupo1)) {
		$y++;

		$objSheet->setCellValue('A'.$y,$dato['ap_paterno']);
		$objSheet->setCellValue('B'.$y,$dato['ap_materno']);
		$objSheet->setCellValue('C'.$y,$dato['nombres']);
		$objSheet->setCellValue('D'.$y,$dato['dni']);	
	
		$objSheet->setCellValue('E'.$y,$dato['nombre_espec']);
		$objSheet->setCellValue('F'.$y,$dato['fecha_b']);
		$objSheet->setCellValue('G'.$y,$dato['num_boleta']);
		$objSheet->setCellValue('H'.$y,$dato['detalle_p']);
		$objSheet->setCellValue('I'.$y,$dato['cantidad']);
		$objSheet->setCellValue('J'.$y,$dato['observacion']);
	
	$espe_nombre=utf8_decode($dato['nombre_espec']);
	}
	
	$objXLS->getActiveSheet()->setTitle("registro de pagos");
	$objXLS->setActiveSheetIndex(0);

	$d=date("mdHi");
	$objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel2007');
	$objWriter->save('D:Escuela Nacional de Estadìstica e Informàtica\pagos\Reg_pagos_'.$espe_nombre.'_'.$d.'.xlsx');

	echo "<script languaje=javascript>
    alert ('El archivo se descargo en la carpeta [Escuela Nacional de Estadistica e Informatica] de la unidad D ')
    self.location='../view_pagos.php'</script>";

	exit;
	}
mysqli_close($link);
?>
		