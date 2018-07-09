<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="https://bootswatch.com/3/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://bootswatch.com/4/sandstone/bootstrap.min.css"/>
        <link rel="stylesheet" href="/style.css"/>
        <title>Hopital E2N</title>
    </head>
    <body>
        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="index.php"><h1>HopitalE2N#MVC</h1></a>

                <div class="collapse navbar-collapse" id="navbarColor02">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" href="ajout-patient.php">Ajouter un patient</a></li>
                        <li class="nav-item"><a class="nav-link" href="ajout-rendezvous.php">Ajouter un RDV</a></li>
                        <li class="nav-item"><a class="nav-link" href="liste-patients.php">Liste des patients</a></li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Accès à toutes les pages<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="nav-item"><a href="ajout-patient.php">Ajouter un patient</a></li>
                                <li class="nav-item"><a href="liste-patients.php">Liste des patients</a></li>
                                <li class="nav-item"><a href="profil-patient.php">Profil des patients</a></li>
                                <li class="divider"></li>
                                <li class="nav-item"><a href="ajout-rendezvous.php">Ajouter un RDV</a></li>
                                <li class="nav-item"><a href="liste-rendezvous.php">Liste des RDV</a></li>
                                <li class="nav-item"><a href="rendezvous.php">RDV</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>


            <!--CONSIGNES
            Depuis l'index doivent etre accessibles les pages ajout-patient et ajout-rendezvous-->
