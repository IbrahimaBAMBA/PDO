<!--CONSIGNES
Voir les informations des patients
Permettre la modification
il doit etre accessible depuis l'index-->

<?php
include 'header.php';
//CONNEXION
$queryPatient = 'SELECT `id`, `lastname`, `firstname`, `birthdate`, `phone`, `mail` FROM `patients` WHERE `id` = :id;';
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
if (count($_POST) > 0) {
    if (!empty($lastname) && !empty($firstname) && !empty($birthdate) && !empty($phone) && !empty($mail) && preg_match($regexText, $lastname) == true && preg_match($regexText, $firstname) == true && preg_match($regexDate, $birthdate) == true && preg_match($regexPhone, $phone) == true && preg_match($regexMail, $mail) == true) {      
//j'insert les données modifiées entrées sur le formulaire dans ma table patients
        $queryModifyPatient = 'UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `phone` = :phone, `mail` = :mail WHERE `id` = :id;';
        //on prépare la requete pour l'execution
        $reqModifyForm = $db->prepare($queryModifyPatient);
        //On lie la donnée id (:id) à la variable $id 
        $reqModifyForm->bindParam(':id', $id);
        //on récupère la donnée entrée dans le GET du formulaire de la page patient.php
        $id = $_GET['patientSelect'];

        $reqModifyForm->bindParam(':lastname', $lastname);
        $reqModifyForm->bindParam(':firstname', $firstname);
        $reqModifyForm->bindParam(':birthdate', $birthdate);
        $reqModifyForm->bindParam(':phone', $phone);
        $reqModifyForm->bindParam(':mail', $mail);

        $reqModifyForm->execute(); 
    }
} 
//on prépare la requete pour l'execution
$patientSelect = $db->prepare($queryPatient);
//On lie la donnée id (:id) à la variable $id 
$patientSelect->bindParam(':id', $id);
//on récupère la donnée entrée dans le GET du formulaire de la page patient.php
$id = $_GET['patientSelect'];
//on execute la requete préparée
$patientSelect->execute();
//on renvoie les données grace à fetch dans un tableau associatif
$patientSelectShow = $patientSelect->fetch(PDO::FETCH_ASSOC);
//on affecte NULL à l'objet PDO pour fermer la conexion à la base de donnée. 
$db = NULL;
?>
<h1>Informations du patient sélectionné</h1>
<h2>#<?= $patientSelectShow['id'] . ' : ' . $patientSelectShow['lastname'] . ' ' . $patientSelectShow['firstname']; ?> </h2>
<div class="row">
    <div class="col-lg-12 backgroundStyle modifyInfoPatient">
        <!--    DEBUT FORMULAIRE      -->
        <form id="modifyInfo" method="POST" action="#">
            <h1 class="titlePart2">Modifications des informations</h1>
            <!--    NOM     -->
            <div class="col-lg-6">
                <label for="lastname" class="pull-right">Nom</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="text" name="lastname" placeholder="Dupont" value="<?= $patientSelectShow['lastname'] ?>"/>
                <p class="regex pull-left">
                    <?php
                    if (!empty($lastname) && preg_match($regexText, $lastname) == false) {
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
                <input class="pull-left" type="text" name="firstname" placeholder="Xavier" value="<?= $patientSelectShow['firstname'] ?>"/>
                <p class="regex pull-left">
                    <?php
                    if (!empty($firstname) && preg_match($regexText, $firstname) == false) {
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
                <input class="pull-left" type="date" name="birthdate" value="<?= $patientSelectShow['birthdate'] ?>"/>
                <p class="regex pull-left">
                    <?php
                    if (!empty($birthdate) && preg_match($regexDate, $birthdate) == false) {
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
                <input class="pull-left" type="tel" name="phone" placeholder="0612345678" value="<?= $patientSelectShow['phone'] ?>"/>
                <p class="regex pull-left">
                    <?php
                    if (!empty($phone) && preg_match($regexPhone, $phone) == false) {
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
                <input class="pull-left" type="email" name="mail" placeholder="xavier.dupont@mail.com" value="<?= $patientSelectShow['mail'] ?>"/>
                <p class="regex pull-left">
                    <?php
                    if (!empty($mail) && preg_match($regexMail, $mail) == false) {
                        echo 'Veuillez saisir une adresse mail valide';
                    } else {
                        echo '';
                    }
                    ?>
                </p>
            </div>
            <input class="center-block" id="modifyPatient" type="submit" name="modifyPatient" value="Modifier les informations de ce patient"/>
            <!--    BOUTON      -->
        </form>
        <!--    FIN FORMULAIRE      -->
    </div>
</div>
<?php
include 'footer.php';
?>