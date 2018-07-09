<!--CONSIGNES
voir la liste des patients
Créer un champs recherche
créer une pagination-->


<?php
include 'header.php';

$queryPatients = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`,"%d/%m/%Y") AS `birthdate`, `phone`, `mail` FROM `patients`;';
//CONNEXION
try {
    // On se connecte à MySQL
    $db = new PDO('mysql:host=localhost;dbname=HospitalE2N;charset=utf8', 'chloeHospital', 'mdpPDO');
} catch (Exception $ex) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $ex->getMessage());
}
$patientsResult = $db->query($queryPatients);
$patientsList = $patientsResult->fetchAll(PDO::FETCH_ASSOC);

$db = NULL;
?>
<h1>Liste des patients</h1>
<table border="2" class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Téléphone</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($patientsList as $patients) {?>
        <tr>
            <td><?= $patients['id']; ?></td>
            <td><?= $patients['lastname']; ?></td>
            <td><?= $patients['firstname']; ?></td>
            <td><?= $patients['birthdate']; ?></td>
            <td><?= $patients['phone']; ?></td>
            <td><?= $patients['mail']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<div class="row">
    <div class="col-lg-12">
        <a href="ajout-patient.php"><input class="center-block" type="button" name="createPatient" value="Créer un patient"/></a>
    </div>
</div>
<?php
include 'footer.php';
?>