<?php

//On instancie l'objet patients 
//puis on vérifie que toutes la variables $_POST existent
//puis on assigne la valeur des $_POST dans les attributs de l'objet patients
$patients = new patients();
//REGEX
$regexText = '/^[a-zA-ZàáâãäåçèéêëìíîïðòóôõöùúûüýÿÂÊÎÔÛÄËÏÖÜÀÆæÇÉÈŒœÙğ_-]+$/';
$regexDate = '/^[0-9]{4}[\-]{1}[0-9]{2}[\-]{1}[0-9]{2}$/';
$regexPhone = '/^0[1-79][0-9]{8}$/';
$regexMail = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
//On crée un tableau dans lequel on va stocker les messages d'erreur
$formError = array();
$insertSuccess = false;
if (isset($_POST['lastname'])) {
    $patients->lastname = htmlspecialchars($_POST['lastname']);
    if (!preg_match($regexText, $patients->lastname)) {
        $formError['lastname'] = 'Le nom n\'est pas correct';
    }
}
if (isset($_POST['firstname'])) {
    $patients->firstname = htmlspecialchars($_POST['firstname']);
    if (!preg_match($regexText, $patients->firstname)) {
        $formError['firstname'] = 'Le prénom n\'est pas correct';
    }
}
if (isset($_POST['birthdate'])) {
    $patients->birthdate = htmlspecialchars($_POST['birthdate']);
    if (!preg_match($regexDate, $patients->birthdate)) {
        $formError['birthdate'] = 'La date n\'est pas correcte';
    }
}
if (isset($_POST['phone'])) {
    $patients->phone = htmlspecialchars($_POST['phone']);
    if (!preg_match($regexPhone, $patients->phone)) {
        $formError['phone'] = 'Le numéro de téléphone n\'est pas correct';
    }
}
if (isset($_POST['mail'])) {
    $patients->mail = htmlspecialchars($_POST['mail']);
    if (!preg_match($regexMail, $patients->mail)) {
        $formError['mail'] = 'Le mail n\'est pas correct';
    }
}
//On vérifie que le formulaire a bien été soumis et que le tableau $formError est vide (donc qu'il n'y a pas eu d'erreur dans le formaulaire)
if (isset($_POST['submit']) && count($formError) == 0) {
    if(!$patients->addPatient()){
        $formError['addDB'] = 'Il y a une erreur dans les données entrées';
    } else {
        $insertSuccess = true;
        $patients->lastname = '';
        $patients->firstname = '';
        $patients->birthdate = '';
        $patients->phone = '';
        $patients->mail = '';
    }
}