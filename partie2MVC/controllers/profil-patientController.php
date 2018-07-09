<?php

//On instancie l'objet patients 
//puis on vérifie que toutes la variables $_POST existent
//puis on assigne la valeur des $_POST dans les attributs de l'objet patients
$patientsModify = new patients();

//REGEX
$regexText = '/^[a-zA-ZàáâãäåçèéêëìíîïðòóôõöùúûüýÿÂÊÎÔÛÄËÏÖÜÀÆæÇÉÈŒœÙğ_-]+$/';
$regexDate = '/^[0-9]{4}[\-]{1}[0-9]{2}[\-]{1}[0-9]{2}$/';
$regexPhone = '/^0[1-79][0-9]{8}$/';
$regexMail = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';

//On crée ubn tableau dans lequel on va stocker les messages d'erreur
$formError = array();
$insertSuccess = false;

if (isset($_POST['lastname'])) {
    $patientsModify->lastname = htmlspecialchars($_POST['lastname']);
    if (!preg_match($regexText, $patientsModify->lastname)) {
        $formError['lastname'] = 'Le nom n\'est pas correct';
    }
}
if (isset($_POST['firstname'])) {
    $patientsModify->firstname = htmlspecialchars($_POST['firstname']);
    if (!preg_match($regexText, $patientsModify->firstname)) {
        $formError['firstname'] = 'Le prénom n\'est pas correct';
    }
}
if (isset($_POST['birthdate'])) {
    $patientsModify->birthdate = htmlspecialchars($_POST['birthdate']);
    if (!preg_match($regexDate, $patientsModify->birthdate)) {
        $formError['birthdate'] = 'La date n\'est pas correcte';
    }
}
if (isset($_POST['phone'])) {
    $patientsModify->phone = htmlspecialchars($_POST['phone']);
    if (!preg_match($regexPhone, $patientsModify->phone)) {
        $formError['phone'] = 'Le numéro de téléphone n\'est pas correct';
    }
}
if (isset($_POST['mail'])) {
    $patientsModify->mail = htmlspecialchars($_POST['mail']);
    if (!preg_match($regexMail, $patientsModify->mail)) {
        $formError['mail'] = 'Le mail n\'est pas correct';
    }
}

//On vérifie que le formulaire a bien été soumis et que le tableau $formError est vide (donc qu'il n'y a pas eu d'erreur dans le formaulaire)
if (isset($_POST['submit']) && count($formError) == 0) {
    $patientsModify->id = $_GET['id'];

    if (!$patientsModify->modifyPatient()) {
        $formError['addDB'] = 'Il y a une erreur dans les données entrées';
    } else {
        $insertSuccess = true;
        
    }
}


//si l'id existe on le récupère pour afficher les infos du patient
if (isset($_GET['id'])) {
    $patients = new patients();
    $patients->id = $_GET['id'];
    //affichage de la liste des rendez-vous du patient sélectionné
    $listAppointmentsPatient = new appointments();
    $listAppointmentsPatient->idPatients = $patients->id;
    $listInfoAppointments = $listAppointmentsPatient->listAppointmentsByIdPatient();
    $patientInfo = $patients->getPatientInfo();
}




?>

