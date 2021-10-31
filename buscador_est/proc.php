<?php

require ("../conexion.php");

$q=$_POST['q'];
$sql="select * from dat_personales where dni LIKE '".$q."%' or ap_paterno LIKE '".$q."%'";
$res=mysqli_query($link,$sql);

if(mysqli_num_rows($res)==0){

 echo "<b>No hay sugerencias</b>";

}else{

echo "<b>Sugerencias:</b><br />";
echo "<table class='table table-bordered'><thead><tr><th>Nombres y apellidos</th><th>DNI</th><th colspan='5'></th></tr></thead><tr>";


while($fila=mysqli_fetch_array($res)){
	echo "<tr><td>".$fila['nombres']." ".$fila['ap_paterno']." ".$fila['ap_materno']."</td><td>".$fila['dni']."</td>
	<td><a href='../actualizard.php?idni=".$fila['iddat_pers']."' target='_blank' class='btn btn-default btn-sm'>
		<span class='glyphicon glyphicon-edit'></span> Modificar datos</a></td>
	<td><a href='detalles_e.php?idni=".$fila['iddat_pers']."' target='_blank' class='btn btn-default btn-sm'>
		<span class='glyphicon glyphicon-menu-hamburger'></span> Historial de cursos</a></td>
	<td><a href='detalles.php?idni=".$fila['iddat_pers']."' target='_blank' class='btn btn-default btn-sm'>
		<span class='glyphicon glyphicon-folder-open'></span> Ver Notas</a></td>
	<td><a href='../pagos.php?idni=".$fila['iddat_pers']."' target='_blank' class='btn btn-default btn-sm'>
		<span class='glyphicon glyphicon-tags'></span> Ver Pagos</a></td>
	<td><a href='../especialidad_e.php?idni=".$fila['iddat_pers']."' target='_blank' class='btn btn-default btn-sm'>
		<span class='glyphicon glyphicon-book'></span> Matricular curso</a></td></tr>";
}
echo "</table>";

}

?>


