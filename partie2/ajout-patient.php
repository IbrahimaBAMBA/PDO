<!--CONSIGNES
Créer un formulaire permettant de créer un patient
il doit etre accessible depuis l'index-->

<?php
//INSERTION DE LA PAGE HEADER
include 'header.php';

//CONNEXION A LA BASE DE DONNEE
// On fait un try catch pour être sûr que la connexion à mysql se fasse
try {
    // On se connecte à MySQL
    $db = new PDO('mysql:host=localhost;dbname=HospitalE2N;charset=utf8', 'chloeHospital', 'mdpPDO');
} catch (Exception $ex) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $ex->getMessage());
}
//Si $_POST['...'] exite on lui attribut un nom de variable
if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['birthdate']) && isset($_POST['phone']) && isset($_POST['mail'])) {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $birthdate = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];
}
?>

<div class="row">
    <div class="col-lg-12 backgroundStyle">
        <!--    DEBUT FORMULAIRE      -->
        <form method="POST" action="#">
            <h1 class="titlePart2">Formulaire d'inscription du patient</h1>
            <p class="redMessage">Tous les champs sont obligatoires</p>
            <!--    NOM     -->
            <div class="col-lg-6">
                <label for="lastname" class="pull-right">Nom</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="text" name="lastname" placeholder="Dupont" value="<?= $lastname ?? '' ?>"/>
                <p class="regex pull-left">
                    <?php
                    if (empty($lastname) && count($_POST) > 0) {
                        echo 'Ce champs est obligatoire';
                    } else if (!empty($lastname) && preg_match($regexText, $lastname) == false) {
                        echo 'Veuillez entrer un nom valide';
                    } else {
                        echo '';
                    }
                    ?>
                </p>
            </div>
            <!--    PRENOM      -->
            <div class="col-lg-6">
                <label for="firstname" class="pull-right">Prénom</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="text" name="firstname" placeholder="Xavier" value="<?= $firstname ?? '' ?>"/>
                <p class="regex pull-left">
                    <?php
                    if (empty($firstname) && count($_POST) > 0) {
                        echo 'Ce champs est obligatoire';
                    } else if (!empty($firstname) && preg_match($regexText, $firstname) == false) {
                        echo 'Veuillez entrer un prénom valide';
                    } else {
                        echo '';
                    }
                    ?>
                </p>
            </div>
            <!--    DATE DE NAISSANCE      -->
            <div class="col-lg-6">
                <label for="birthdate" class="pull-right">Date de naissance</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="date" name="birthdate" placeholder="01/01/2001" value="<?= $birthdate ?? '' ?>"/>
                <p class="regex pull-left">
                    <?php
                    if (empty($birthdate) && count($_POST) > 0) {
                        echo 'Ce champs est obligatoire';
                    } else if (!empty($birthdate) && preg_match($regexDate, $birthdate) == false) {
                        echo 'Veuillez saisir une date valide';
                    } else {
                        echo '';
                    }
                    ?>
                </p>
            </div>
            <!--    TELEPHONE      -->
            <div class="col-lg-6">
                <label for="phone" class="pull-right">Numéro de téléphone</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="tel" name="phone" placeholder="0612345678" value="<?= $phone ?? '' ?>"/>
                <p class="regex pull-left">
                    <?php
                    if (empty($phone) && count($_POST) > 0) {
                        echo 'Ce champs est obligatoire';
                    } else if (!empty($phone) && preg_match($regexPhone, $phone) == false) {
                        echo 'Veuillez saisir votre numéro sans espaces et sans caractères spéciaux';
                    } else {
                        echo '';
                    }
                    ?>
                </p>
            </div>
            <!--    EMAIL      -->
            <div class="col-lg-6">
                <label for="mail" class="pull-right">Adresse Email</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="email" name="mail" placeholder="xavier.dupont@mail.com" value="<?= $mail ?? '' ?>"/>
                <p class="regex pull-left">
                    <?php
                    if (empty($mail) && count($_POST) > 0) {
                        echo 'Ce champs est obligatoire';
                    } else if (!empty($mail) && preg_match($regexMail, $mail) == false) {
                        echo 'Veuillez saisir une adresse mail valide';
                    } else {
                        echo '';
                    }
                    ?>
                </p>
            </div>
            <!--    BOUTON      -->
            <input class="center-block" type="submit" value="Valider"/>
        </form>
        <!--    FIN FORMULAIRE      -->
        <?php
        if (count($_POST) > 0) {
            if (!empty($lastname) && !empty($firstname) && !empty($birthdate) && !empty($phone) && !empty($mail) && preg_match($regexText, $lastname) == true && preg_match($regexText, $firstname) == true && preg_match($regexBirthdate, $birthdate) == true && preg_match($regexPhone, $phone) == true && preg_match($regexMail, $mail) == true) {
                //j'insert les données entrée sur le formulaire dans ma table patient
                $reqForm = $db->prepare('INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES (:lastname, :firstname, :birthdate, :phone, :mail)');
                $reqForm->bindParam(':lastname', $lastname);
                $reqForm->bindParam(':firstname', $firstname);
                $reqForm->bindParam(':birthdate', $birthdate);
                $reqForm->bindParam(':phone', $phone);
                $reqForm->bindParam(':mail', $mail);

                if ($reqForm->execute()) {
                    // Je crée une variable query dans laquelle je mets ma requête SQL
                    $queryForm = 'SELECT `lastname`, `firstname`, DATE_FORMAT(`birthdate`,"%d/%m/%Y") AS `birthdate`, `phone`, `mail` FROM `patients` ORDER BY `id` DESC;';
                    $patientsResult = $db->query($queryForm);
                    $patientsList = $patientsResult->fetch(PDO::FETCH_ASSOC);
                }
                ?>
                <div class="response">
                    <h2>Récapitulatif du patient</h2>
                    <p><span>Nom : </span><?= $patientsList['lastname']; ?></p>
                    <p><span>Prénom : </span><?= $patientsList['firstname']; ?></p>
                    <p><span>Date de naissance : </span><?= $patientsList['birthdate']; ?></p>
                    <p><span>Numéro de téléphone : </span><?= $patientsList['phone']; ?></p>
                    <p><span>Email : </span><?= $patientsList['mail']; ?></p>
                </div>
                <div class="col-lg-12 center-block">
                    <a href="liste-patients.php"><input class="center-block" type="button" value="Voir la liste des patients"/></a>
                </div>
                <?php
            }
        }
        //on affecte NULL à l'objet PDO pour fermer la conexion à la base de donnée. 
        $db = NULL;
        ?>
    </div>

</div>
<?php
//INSERTION DE LA PAGE FOOTER
include 'footer.php';
?>
