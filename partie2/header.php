<?php 
//REGEX
$regexText = '/^[a-zA-ZàáâãäåçèéêëìíîïðòóôõöùúûüýÿÂÊÎÔÛÄËÏÖÜÀÆæÇÉÈŒœÙğ_-]+$/';
$regexDate = '/^[0-9]{4}[\-]{1}[0-9]{2}[\-]{1}[0-9]{2}$/';
$regexPhone = '/^0[1-79][0-9]{8}$/';
$regexMail = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
$regexHour = '/^[0-9]{2}[:][0-9]{2}[:][0-9]{2}$/';


?>
<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="/style.css"/>
        <title>Hopital E2N</title>
    </head>
    <body>
        <div class="container">
            <!--CONSIGNES
            Depuis l'index doivent etre accessibles les pages ajout-patient et ajout-rendezvous-->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">HopitalE2N</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="ajout-patient.php">Ajouter un patient</a></li>
                            <li><a href="ajout-rendezvous.php">Ajouter un RDV</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Accès à toutes les pages<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="ajout-patient.php">Ajouter un patient</a></li>
                                    <li><a href="liste-patients.php">Liste des patients</a></li>
                                    <li><a href="patients.php">Patients</a></li>
                                    <li><a href="profil-patient.php">Profil des patients</a></li>
                                    <li class="divider"></li>
                                    <li><a href="ajout-rendezvous.php">Ajouter un RDV</a></li>
                                    <li><a href="liste-rendezvous.php">Liste des RDV</a></li>
                                    <li><a href="rendezvous.php">RDV</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>