<?php
$appointments = new appointments();
$removeSuccess = false;

if (isset($_GET['idRemove'])) {
    $appointments->idDelete = $_GET['idRemove'];
    if($appointments->removeRDV()){
        $removeSuccess = true;
    } 
}

$appointmentsList = $appointments->getAppointmentsList();

?>