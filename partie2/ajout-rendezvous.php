<?php
include 'header.php';
$queryPatientSelect2 = 'SELECT `id`, `lastname`, `firstname` FROM `patients`;';

//CONNEXION A LA BASE DE DONNEE
// On fait un try catch pour être sûr que la connexion à mysql se fasse
try {
    // On se connecte à MySQL
    $db = new PDO('mysql:host=localhost;dbname=HospitalE2N;charset=utf8', 'chloeHospital', 'mdpPDO');
} catch (Exception $ex) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $ex->getMessage());
}

$patientSelectResult2 = $db->query($queryPatientSelect2);
$patientSelectList2 = $patientSelectResult2->fetchAll(PDO::FETCH_ASSOC);

//Si $_POST['...'] exite on lui attribut un nom de variable
if (isset($_POST['patientSelect']) && isset($_POST['dateRDV']) && isset($_POST['hourRDV'])) {
    $patientSelect = $_POST['patientSelect'];
    $dateRDV = $_POST['dateRDV'];
    $hourRDV = $_POST['hourRDV'];
}
?>
<div class="row">
    <div class="col-lg-12 backgroundStyle">
        <!--    DEBUT FORMULAIRE      -->
        <form method="POST" action="#">
            <h1 class="titlePart2">Ajouter un RDV</h1>
            <p class="redMessage">Tous les champs sont obligatoires</p>
            <!--    NOM     -->
            <div class="col-lg-6">
                <label for="patientSelect" class="pull-right">Choisir un patient</label>
            </div>
            <div class="col-lg-6">
                <select name="patientSelect" class="pull-left">
                    <option value="0" name="choice" selected>Choisir un patient</option>
                    <?php
                    foreach ($patientSelectList2 AS $patientOption) {
                        $patientSelect = $_POST['patientSelect'];
                        ?>
                        <option value="<?= $patientOption['id']; ?>" <?= (isset($patientSelect) && $patientSelect == $patientOption['id']) ? 'selected' : ''; ?>><?= $patientOption['lastname'] . ' ' . $patientOption['firstname']; ?></option>
                    <?php } ?>
                </select>
                <p class="regex pull-left">
                    <?php
                    if ($patientSelect == 0 && count($_POST) > 0) {
                        echo 'Ce champs est obligatoire';
                    } else {
                        echo '';
                    }
                    ?>
                </p>
            </div>
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
            <input class="center-block" type="submit" value="Ajouter ce RDV"/>
        </form>

        <!--    FIN FORMULAIRE      -->
        <?php
        if (count($_POST) > 0) {
            if (!empty($dateRDV) && !empty($hourRDV) && !empty($patientSelect) && preg_match($regexDate, $dateRDV) == true && preg_match($regexHour, $hourRDV) == true) {
                //Je concatène la date et l'heure pour que les valeurs passe dans le champs dateHour
                $dateHour = $dateRDV . ' ' . $hourRDV;
                $idPatients = $_POST['patientSelect'];
                //j'insert les données entrée sur le formulaire dans ma table patient
                $reqRDVForm = $db->prepare('INSERT INTO `appointments` (`dateHour`, `idPatients`) VALUES (:dateHour, :idPatients)');
                $reqRDVForm->bindParam(':dateHour', $dateHour);
                $reqRDVForm->bindParam(':idPatients', $idPatients);
                $reqRDVForm->execute();
                //on affecte NULL à l'objet PDO pour fermer la conexion à la base de donnée. 
                $db = NULL;
            }
            ?>
            <div class="col-lg-12 response text-center">
                <p>Le RDV à bien été enregistré</p>
                <a href="liste-rendezvous.php"><input class="center-block" type="button" value="Voir la liste des RDV"/></a>
            </div>
        <?php } ?>
    </div>

</div>
<?php
include 'footer.php';
?>