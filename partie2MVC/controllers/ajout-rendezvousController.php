<?php

$patients = new patients();
$patientsList = $patients->getPatientList();

//on instancie un nouvel objet rdv
$RDV = new appointments();
//REGEX
$regexDate = '/^[0-9]{4}[\-]{1}[0-9]{2}[\-]{1}[0-9]{2}$/';
$regexHour = '/^[0-9]{2}[:][0-9]{2}[:][0-9]{2}$/';
//On crée un tableau dans lequel on va stocker les messages d'erreur
$formError = array();
//on initialise insertSuccess qui nous renvoiera un message si les données ont bien été prise en compte ou non
$insertSuccess = false;
//Je concatène la date et l'heure pour que les valeurs passe dans le champs dateHour

if (isset($_POST['patientSelect'])) {
    $RDV->patientSelect = htmlspecialchars($_POST['patientSelect']);
    if ($_POST['patientSelect'] == 0) {
        $formError['dateRDV'] = 'Sélectionnez un patient';
    }
}
if (isset($_POST['dateRDV'])) {
    $RDV->dateRDV = htmlspecialchars($_POST['dateRDV']);
    if (!preg_match($regexDate, $RDV->dateRDV)) {
        $formError['dateRDV'] = 'La date n\'est pas correcte';
    }
}
if (isset($_POST['hourRDV'])) {
    $RDV->hourRDV = htmlspecialchars($_POST['hourRDV']);
    if (!preg_match($regexHour, $RDV->hourRDV)) {
        $formError['hourRDV'] = 'L\'heure n\'est pas correcte';
    }
}

//On vérifie que le formulaire a bien été soumis et que le tableau $formError est vide (donc qu'il n'y a pas eu d'erreur dans le formaulaire)
if (isset($_POST['addRDV']) && count($formError) == 0) {
    $RDV->dateHour = $RDV->dateRDV . ' ' . $RDV->hourRDV;
    $RDV->idPatients = $_POST['patientSelect'];
    $checkAppointment = $RDV->checkFreeAppointment();
    //si c'est pas un objet
    if (!is_object($checkAppointment)) {
        $formError['checkAppointment'] = 'Veuillez contacter le support technique';
    } else {
        if ($checkAppointment->takenAppointment) {
            $formError['takenAppointment'] = 'Vous avez déjà un rendez-vous programmé ce jour au même horaire';
        } else {
            if (!$RDV->addAppointment()) {
                $formError['addDB'] = 'Il y a une erreur dans les données entrées';
            } else {
                $insertSuccess = true;
            }
        }
    }
}
?>