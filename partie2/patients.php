<?php
include 'header.php';

$queryPatientSelect = 'SELECT `id`, `lastname`, `firstname` FROM `patients`;';
//CONNEXION
try {
    // On se connecte à MySQL
    $db = new PDO('mysql:host=localhost;dbname=HospitalE2N;charset=utf8', 'chloeHospital', 'mdpPDO');
} catch (Exception $ex) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $ex->getMessage());
}
$patientSelectResult = $db->query($queryPatientSelect);
$patientSelectList = $patientSelectResult->fetchAll(PDO::FETCH_ASSOC);

$db = NULL;
?>
<div class="row">
    <div class="col-lg-12">
        <h1>Patient</h1>

        <form method="GET" action="profil-patient.php">
            <div class="col-lg-6">
                <select name="patientSelect" class="pull-right">
                    <option value="" name="choice">Choisir un patient</option>
                    <?php foreach ($patientSelectList AS $patientOption) { ?>
                        <option value="<?= $patientOption['id']; ?>"><?= $patientOption['lastname'] . ' ' . $patientOption['firstname']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="submit" name="patientRegister" value="Voir les informations de ce patient"/>
            </div>
        </form>

    </div>
</div>
<?php
include 'footer.php';
?>
