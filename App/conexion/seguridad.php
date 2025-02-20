<?php 
session_start();
 if (!isset($_SESSION['paciente']) ){
    header("Location: index.php");

}
?>