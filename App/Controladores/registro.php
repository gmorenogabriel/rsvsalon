<?php

include('../conexion/dbConfig.php');

$ced=htmlspecialchars($_POST['ced']);
$nombre=htmlspecialchars($_POST['usuario']);
$tipo=htmlspecialchars($_POST['sangre']);
$correo=htmlspecialchars($_POST['correo']);
$telefono=htmlspecialchars($_POST['telefono']);

// $consulta="SELECT cedula from paciente where cedula=$ced";
$consulta="SELECT ci from usuarios where ci=$ced";
$query1=mysqli_query($conn,$consulta);
$i=0;

if($query21=mysqli_fetch_array($query1)){
    $i++;
}

if($i>0){
  echo "<script>Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'Cedula ya Existe',
	timer: 3000
  })</script>";
}else{
    //$agregar="INSERT into paciente(nombre_paciente,cedula,telefono,email,id_tipo) values('$nombre',$ced,$telefono,'$correo',$tipo)";
	$ahora = date('Y-m-d H:i:s');
	$agregar="INSERT into Usuarios (ci,password,nombre,email,id_rol,pago,activo, fecha_alta, fecha_edit, fecha_baja)
	   values($ced, 'eldiaquemequieras','$nombre','$correo', 'Usuario Común', null, '1', '$ahora', null, null);";
    $query=mysqli_query($conn,$agregar);
    if($query){
        echo "<script>Swal.fire({
            icon: 'success',
            title: 'Exito',
            text: 'Usuario Guardado',
			timer: 3000
          });</script> ";
    }else{
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Error en el servidor',
			timer: 3000
          })</script>";
    }
}

?>