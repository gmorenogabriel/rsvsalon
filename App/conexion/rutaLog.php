<?php
// rutaLog.php - Configuración de la ruta del log
$logDir = $_SERVER['DOCUMENT_ROOT'] . "/rsvsalon/writeable/";

if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true); // Crea la carpeta con permisos adecuados
}

return [
    'base_url' => $_SERVER['DOCUMENT_ROOT'] . "/rsvsalon/",
    'ahora'    => date('Y-m-d H:i:s'),
    'archivo'  => date('Y-m-d') . "_rsvsalon.log",
    'ruta'     => $_SERVER['DOCUMENT_ROOT'] . "/rsvsalon/writeable/" . date('Y-m-d') . "_rsvsalon.log"
];
?>
