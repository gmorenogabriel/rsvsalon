<?php

include('../conexion/dbConfig.php');
include('../conexion/seguridad.php');

$id=htmlspecialchars($_POST['id']);

$eliminarFecha="DELETE from cita where id_cita=$id ";
$queryfecha=mysqli_query($conn,$eliminarFecha);

if($queryfecha){
    echo "<script>Swal.fire({
        icon: 'success',
        title: 'Exito',
        text: 'Eliminada Cita',
		timer: 3000
      });  </script> ";
}else{
    echo "<script>Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Error en la eliminacion',
		timer: 3000
      })</script>";
}

?>