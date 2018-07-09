<?php
include 'models/dataBase.php';
include 'models/patients.php';
include 'models/appointments.php';
include 'controllers/liste-rendezvousController.php';
include 'header.php';
?>
<div class="row">
    <div class="center-block">
        <a href="ajout-rendezvous.php" class="indexLink btn btn-outline-info btn-lg">
            <div class="col-lg-12 text-center">
                <i class="fa fa-calendar-o fa-4x" aria-hidden="true"></i>
                <p>Ajouter un nouveau RDV</p>
            </div>
        </a>
    </div>
</div>
<h1>Liste des RDV</h1>
<?php if ($removeSuccess) { ?>
    <div class="offset-lg-4 col-lg-4 alert alert-dismissible alert-success text-center">
        <p>Le RDV à bien été supprimé</p>
    </div>
    <?php
}
?>
<table border="2" class="rdvList table table-hover">
    <thead>
        <tr>
            <th>Patients</th>
            <th>Date du RDV</th>
            <th>Heure du RDV</th>
            <th>Modifier le RDV</th>
            <th>Supprimer le RDV</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($appointmentsList as $appointment) { ?>
            <tr>
                <td><?= $appointment->lastname . ' ' . $appointment->firstname; ?></td>
                <td><?= $appointment->date; ?></td>
                <td><?= $appointment->hour; ?></td>
                <td><a class="btn btn-secondary" href="rendezvous.php?id=<?= $appointment->id; ?>">Voir / Modifier ce RDV</a></td>
                <td><a class="btn btn-danger" href="liste-rendezvous.php?idRemove=<?= $appointment->id; ?>">Supprimer ce RDV </a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php
include 'footer.php';
?>