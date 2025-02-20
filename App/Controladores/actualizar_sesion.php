<?php
session_start(); // Asegura que se use la sesión activa

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cedula'])) {
        $_SESSION['cedula'] = $_POST['cedula']; // Guardar en sesión
    }
    if (isset($_POST['nombre'])) {
        $_SESSION['nombre'] = $_POST['nombre']; // Guardar en sesión
    }

    echo json_encode(["status" => "success", "message" => "Sesión actualizada"]);
} else {
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
}
?>
