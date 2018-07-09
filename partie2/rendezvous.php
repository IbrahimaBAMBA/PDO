<?php 
include 'header.php';
//SELECT * FROM `appointments` WHERE `id` = :id;
//on récupère la donnée entrée dans le GET du formulaire de la page patient.php
$id = $_GET['id'];
$queryRDV = 'SELECT `appointments`.`id`, DATE_FORMAT(`dateHour`, "%d/%m/%Y %H:%i") AS `dateHour`, `appointments`.`idPatients`, `patients`.`lastname`, `patients`.`firstname` FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` WHERE `appointments`.`id` = :id;';
try {
    // On se connecte à MySQL
    $db = new PDO('mysql:host=localhost;dbname=HospitalE2N;charset=utf8', 'chloeHospital', 'mdpPDO');
} catch (Exception $ex) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $ex->getMessage());
}
//on prépare la requete pour l'execution
$rdvSelect = $db->prepare($queryRDV);
//On lie la donnée id (:id) à la variable $id 
$rdvSelect->bindValue(':id', $id,PDO::PARAM_INT);
//on execute la requete préparée
$rdvSelect->execute();
//on renvoie les données grace à fetch dans un tableau associatif
$rdvSelectShow = $rdvSelect->fetch(PDO::FETCH_ASSOC);
//on affecte NULL à l'objet PDO pour fermer la conexion à la base de donnée. 
$db = NULL;
?>
<h1>Informations du RDV sélectionné</h1>
<h2>#<?= $rdvSelectShow['idPatients'] . ' ' . $rdvSelectShow['lastname'] . ' ' . $rdvSelectShow['firstname']; ?> </h2>
<div class="row">
    <div class="col-lg-12 backgroundStyle">
        <!--    DEBUT FORMULAIRE      -->
        <form method="POST" action="#">
            <h1 class="titlePart2">Ajouter un RDV</h1>
            <p class="redMessage">Tous les champs sont obligatoires</p>
            
            <!--    DATE DU RDV      -->
            <div class="col-lg-6">
                <label for="dateRDV" class="pull-right">Date du RDV</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="date" name="dateRDV" placeholder="01/01/2001" value="<?= $dateRDV ?? '' ?>"/>
                <p class="regex pull-left">
                    <?php
                    if (empty($dateRDV) && count($_POST) > 0) {
                        echo 'Ce champs est obligatoire';
                    } else if (!empty($dateRDV) && preg_match($regexDate, $dateRDV) == false) {
                        echo 'Veuillez saisir une date valide';
                    } else {
                        echo '';
                    }
                    ?>
                </p>
            </div>
            <!--    HEURE DU RDV      -->
            <div class="col-lg-6">
                <label for="hourRDV" class="pull-right">Heure du RDV</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="text" name="hourRDV" placeholder="HH:MM:SS" value="<?= $hourRDV ?? '' ?>"/>
                <p class="regex pull-left">
                    <?php
                    if (empty($hourRDV) && count($_POST) > 0) {
                        echo 'Ce champs est obligatoire';
                    } else if (!empty($hourRDV) && preg_match($regexHour, $hourRDV) == false) {
                        echo 'Veuillez saisir une heure valide';
                    } else {
                        echo '';
                    }
                    ?>
                </p>
            </div>

            <!--    BOUTON      -->
            <input class="center-block" type="submit" value="Modifier ce RDV"/>
        </form>

<?php
include 'footer.php';
?>