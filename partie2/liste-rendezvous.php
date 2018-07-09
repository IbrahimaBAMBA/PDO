<?php
include 'header.php';
$queryRDV = 'SELECT `appointments`.`id`, DATE_FORMAT(`dateHour`, "%d/%m/%Y %H:%i") AS `dateHour`, `patients`.`lastname`, `patients`.`firstname` FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id`;';
//'SELECT `appointments`.`id`, `appointments`.`dateHour` FROM `appointments` 
//LEFT JOIN `patients`
//ON `appointments`.`idPatients` = `patients`.`id`;';
//CONNEXION
try {
    // On se connecte à MySQL
    $db = new PDO('mysql:host=localhost;dbname=HospitalE2N;charset=utf8', 'chloeHospital', 'mdpPDO');
} catch (Exception $ex) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $ex->getMessage());
}
$rdvResult = $db->query($queryRDV);
$rdvList = $rdvResult->fetchAll(PDO::FETCH_ASSOC);

$db = NULL;
?>

<h1>Liste des RDV</h1>
<table border="2" class="rdvList table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Date et heure du RDV</th>
            <th>Patients</th>
            <th>Modifier le RDV</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rdvList as $RDV) { ?>
            <tr>
                <td><?= $RDV['id']; ?></td>
                <td><?= $RDV['dateHour']; ?></td>
                <td><?= $RDV['lastname'] . ' ' . $RDV['firstname']; ?></td>
                <td><a href="rendezvous.php?id=<?= $RDV['id']; ?>">Modifier</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="row">
    <div class="col-lg-offset-5 col-lg-2">
        <a href="ajout-rendezvous.php">
            <input class="center-block" type="button" name="createRDV" value="Ajouter un RDV"/>
        </a>
    </div>
</div>
<?php
include 'footer.php';
?>