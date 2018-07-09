<?php

//Modification du RDV
//on instancie un nouvel objet ModifyRDV
$ModifyRDV = new appointments();
//REGEX
$regexDate = '/^[0-9]{4}[\-]{1}[0-9]{2}[\-]{1}[0-9]{2}$/';
$regexHour = '/^[0-9]{2}[:][0-9]{2}[:][0-9]{2}$/';
//On crée un tableau dans lequel on va stocker les messages d'erreur
$formError = array();
//on initialise insertSuccess qui nous renvoiera un message si les données ont bien été prise en compte ou non
$insertSuccess = false;
//Je concatène la date et l'heure pour que les valeurs passe dans le champs dateHour
if (isset($_POST['idPatients'])) {
    $ModifyRDV->idPatients = htmlspecialchars($_POST['patientSelect']);
}
if (isset($_POST['dateRDV'])) {
    $ModifyRDV->dateRDV = htmlspecialchars($_POST['dateRDV']);
    if (!preg_match($regexDate, $ModifyRDV->dateRDV)) {
        $formError['dateRDV'] = 'La date n\'est pas correcte';
    }
}
if (isset($_POST['hourRDV'])) {
    $ModifyRDV->hourRDV = htmlspecialchars($_POST['hourRDV']);
    if (!preg_match($regexHour, $ModifyRDV->hourRDV)) {
        $formError['hourRDV'] = 'L\'heure n\'est pas correcte';
    }
}

//On vérifie que le formulaire a bien été soumis et que le tableau $formError est vide (donc qu'il n'y a pas eu d'erreur dans le formaulaire)
if (isset($_POST['modifyRDV']) && count($formError) == 0) {
    $ModifyRDV->id = $_GET['id'];
    $ModifyRDV->idPatients = $_POST['patientSelect'];
    $dateRDV = $_POST['dateRDV'];
    $hourRDV = $_POST['hourRDV'];
    $ModifyRDV->dateHour = $dateRDV . ' ' . $hourRDV;


    if (!$ModifyRDV->modifyRDV()) {
        $formError['addDB'] = 'Il y a une erreur dans les données entrées';
    } else {
        $insertSuccess = true;
    }
}

//Affichage pour la liste déroulante
$patients = new patients();
$patientsList = $patients->getPatientList();


//Récupération des infos par l'id 
$appointments = new appointments();
//si l'id existe on le récupère pour afficher les infos du patient
if (isset($_GET['id'])) {
    $appointments->id = $_GET['id'];
    
    $appointmentDetails = $appointments->getRDVInfo();
    
}


////je récupère l'attribut dateHour de mon objet appointments
//$dateHour = $RDVInfo->dateHour;
////j'explose l'attribut à l'endroit de séparation de la date et de l'heure et je le stock dans un tableau
//$dateHourTab = explode(' ', $dateHour);
////je récupète la date par son index (0) et l'heure (1) que je stock chancun dans une variable 
////et j'affecte ces variables à chaque value de l'input correspondant
//$dateRDV = $dateHourTab[0];
//$hourRDV = $dateHourTab[1];
?>

