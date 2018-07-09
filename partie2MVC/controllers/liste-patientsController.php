<?php
//==========> Suppression d'un patient
$patientRemove = new patients();
$removeSuccess = false;


if (isset($_GET['idRemove'])) {
    $patientRemove->id = $_GET['idRemove'];
    if ($patientRemove->patientRemove()) {
        $removeSuccess = true;
    }
}
//==========> Pagination
$patients = new patients();
//par défault la première page
$page = 1;
//on limit l'affichage à 5 patients
$limit = 5;
if (!empty($_GET['page'])) {
    $page = $_GET['page'];
}
$start = ($page - 1) * $limit;
$patientsList = $patients->getPatientListPagination($start);

$patientCount = $patients->countPatient();
$maxPagination = ceil($patientCount->numberOfPatient/$limit);
?>