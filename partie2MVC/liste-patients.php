<?php
include 'models/dataBase.php';
include 'models/patients.php';
include 'controllers/liste-patientsController.php';
include 'header.php';
?>
<div class="row">
    <div class="center-block">
        <a href="ajout-patient.php" class="indexLink btn btn-outline-info btn-lg">
            <div class="col-lg-12 text-center">
                <i class="fa fa-user-plus fa-4x" aria-hidden="true"></i>
                <p>Ajouter un nouveau patient</p>
            </div>
        </a>
    </div>
</div>
<h1>Liste des patients</h1>
<?php if ($removeSuccess) { ?>
    <div class="offset-lg-4 col-lg-4 alert alert-dismissible alert-success text-center">
        <p>Le patient et ses RDV ont bien été supprimé</p>
    </div>
<?php } ?>
<div class="offset-lg-3 col-lg-6 center-block">
    <form method="POST" action="#" class="center-block form-inline">
        <label for="searchPatient">Rechercher : </label>
        <input name="searchPatient" class="form-control col-lg-4 center-block" placeholder="Saisir un nom ou un prénom" type="text"/>
        <input class="btn btn-secondary col-lg-3 center-block" name="submitSearch" type="submit" value="Rechercher"/>
    </form>
</div>

<?php
if (isset($_POST['searchPatient'])) {
    ?> <p>Résultat de la recherche : </p> <?php
}
if (isset($patientsList) && count($patientsList) == 0) {
    ?> <p>Il n'y a aucun patient qui correspond à votre recherche. </p> <?php } else {
    ?>
    <table border="2" class="table table-hover">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patientsList as $patients) { ?>
                <tr>
                    <td><?= $patients->lastname; ?></td>
                    <td><?= $patients->firstname; ?></td>
                    <td><?= $patients->birthdate; ?></td>
                    <td><?= $patients->phone; ?></td>
                    <td><?= $patients->mail; ?></td>
                    <td><a class="btn btn-secondary" href="profil-patient.php?id=<?= $patients->id; ?>">Voir / Modifier ce patient</a></td>
                    <td><a class="btn btn-danger" href="liste-patients.php?idRemove=<?= $patients->id; ?>">Supprimer ce patient</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
<div class="row">
    <div class="offset-lg-3 col-lg-6">
        <a href="liste-patients.php?page=<?= $page - 1 ?>" class="<?= $start <= 1 ? 'disabled' : '' ?> btn col-lg-4">Précédente</a>
        <?php
        for ($pageNumber = 1; $pageNumber <= $maxPagination; $pageNumber++) { ?>
        <a href="liste-patients.php?page=<?= $pageNumber ?>" class="<?= $page == $pageNumber?'disabled' : '' ?> btn col-lg-1" ><?= $pageNumber ?></a>
        <?php } ?>
        <a href="liste-patients.php?page=<?= $page + 1 ?>" class="<?= $page >= $maxPagination ? 'disabled' : '' ?> btn col-lg-4">Suivante</a>
    </div>
</div>
<?php
include 'footer.php';
?>