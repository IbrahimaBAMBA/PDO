<?php
try {
    // On se connecte à MySQL
    $db = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'chloecolyseum', 'mdpPDO');
} catch (Exception $ex) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $ex->getMessage());
}
?>
<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/style.css"/>
        <title>Partie1</title>
    </head>
    <body>
        <div class="container">
            <h1>PDO - Partie 1 : Lire des données</h1>
            <div class="row">
                <div class="col-lg-6">
                    <h2>Ex1 : Afficher tous les clients</h2>
                </div>
            </div>
            <div class="row clientList">
                <?php
                // On récupère les colonnes lastName et firstName de la table clients que l'on stock dans $reponse
                $reponse = $db->query('SELECT `lastName`, `firstName` FROM `clients`');
                //fetch = on va chercher, les données reccueillies dans $reponse
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <div class="col-lg-12">
                        <p><span>Nom et prénom : </span><?= $donnees['lastName'] . ' ' . $donnees['firstName'] ?></p>
                    </div>
                    <?php
                }
                //on arrête le traitement de la requete
                $reponse->closeCursor();
                ?>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h2>Ex2 : Afficher tous les types de spectacles possibles</h2>
                </div>
            </div>
            <div class="row clientList">
                <?php
                // On récupère le type de spectacle de la table showtypes
                $reponse = $db->query('SELECT `type` FROM `showTypes`');
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <div class="col-lg-12">
                        <p><span>Type de spectacles : </span><?= $donnees['type'] ?></p>
                    </div>

                    <?php
                }
                $reponse->closeCursor();
                ?>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h2>Ex3 : Afficher les 20 premiers clients</h2>
                </div>
            </div>
            <div class="row clientList">
                <?php
                // On récupère les colonnes lastName et firstName de la table clients que l'on stock dans $reponse 
                // on limite au 20 premiers de la liste
                $reponse = $db->query('SELECT `lastName`, `firstName` FROM `clients` LIMIT 20');
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <div class="col-lg-12">
                        <p><span>Nom et prénom : </span><?= $donnees['lastName'] . ' ' . $donnees['firstName'] ?></p>
                    </div>

                    <?php
                }
                $reponse->closeCursor();
                ?>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h2>Ex4 : N'afficher que les clients possédant une carte de fidélité</h2>
                </div>
            </div>
            <div class="row clientList">
                <?php
                // On stock dans $reponse
                // On récupère es colonnes lastName et firstName de la table clients
                // on affichera seulement les clients qui retourne 1 dans la colonne card
                $reponse = $db->query('SELECT `lastName`, `firstName` FROM `clients` WHERE `card`=1');
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <div class="col-lg-12">
                        <p><span>Nom et prénom : </span><?= $donnees['lastName'] . ' ' . $donnees['firstName'] ?></p>
                    </div>

                    <?php
                }
                $reponse->closeCursor();
                ?>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h2>Ex5 : Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M". Les trier par ordre alphabetique</h2>
                </div>
            </div>
            <div class="row">
                <?php
                // On récupère les colonnes lastName et firstName de la table clients
                // On affichera seulemnt les clients pour qui lastName commence par un M
                // On triera le resultat par ordre alphabetique en fonction de lastName
                $reponse = $db->query('SELECT `lastName`, `firstName` FROM `clients` WHERE `lastName` LIKE \'M%\' ORDER BY `lastName` ASC');
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <div class="col-lg-12 clientsEx4">
                        <p><span>Nom du client : </span><?= $donnees['lastName'] ?></p>
                        <p><span>Prénom du client : </span><?= $donnees['firstName'] ?></p>
                    </div>

                    <?php
                }
                $reponse->closeCursor();
                ?>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h2>Ex6 : Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. 
                        Trier les titres par ordre alphabétique. Afficher les résultat comme ceci : Spectacle par artiste, le date à heure</h2>
                </div>
            </div>
            <div class="row clientsEx6">
                <?php
                // On récupère les colonnes title performer date et startTime de la table shows
                // On triera les title par ordre alphabetique
                $reponse = $db->query('SELECT `title`, `performer`, `date`, `startTime` FROM `shows` ORDER BY `title` ASC');
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <div class="col-lg-12">
                        <p><?= $donnees['title'] . ' par ' . $donnees['performer'] . ', le ' . $donnees['date'] . ' à ' . $donnees['startTime'] ?></p>
                    </div>

                    <?php
                }
                $reponse->closeCursor();
                ?>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h2>Ex7 : Afficher tous les clients comme l'example</h2>
                </div>
            </div>
            <div class="row">
                <?php
                // On récupère tout le contenu de la table clients pour pouvoir afficher toute les données
                $reponse = $db->query('SELECT * FROM clients');
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <div class="col-lg-3 clientsCard">
                        <p><span>Nom du client : </span><?= $donnees['lastName'] ?></p>
                        <p><span>Prénom du client : </span><?= $donnees['firstName'] ?></p>
                        <p><span>Date de naissance : </span><?= $donnees['birthDate'] ?></p>
                        <p><span>A-t'il une carte de fidelité : </span>
                            <?php
                            // Si les données de la colonne card sont = à 1 
                            if ($donnees['card'] == 1) {
                                //on affiche oui
                                echo 'Oui';
                            //sinon
                            } else {
                                //on affiche non
                                echo 'Non';
                            }
                            ?>
                        </p>
                        <p><span>Numéro de la carte : </span>
                            <?php
                            //  Si les données de la colonne card sont = à 1
                            if ($donnees['card'] == 1) {
                                //on affiche le numéro de la carte
                                echo $donnees['cardNumber'];
                            //sinon 
                            } else {
                                //on affiche ce message
                                echo 'Pas de carte de fidélité';
                            }
                            ?>
                        </p>
                    </div>

                    <?php
                }
                $reponse->closeCursor();
                ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="script.js"></script>
    </body>
</html>