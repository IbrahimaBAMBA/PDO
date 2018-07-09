<?php
include 'models/dataBase.php';
include 'models/patients.php';
include 'models/appointments.php';
include 'controllers/ajout-rendezvousController.php';
include 'header.php';
?>

<div class="row">
    <div class="offset-lg-2 col-lg-3">
        <a href="liste-rendezvous.php" class="indexLink btn btn-outline-info btn-lg">
            <div class="col-lg-12 text-center">
                <i class="fa fa-list-ul fa-4x" aria-hidden="true"></i>
                <p>Voir la liste des RDV</p>
            </div>
        </a>
    </div>
    <div class="offset-lg-2 col-lg-3">
        <a href="ajout-rendezvous.php" class="indexLink btn btn-outline-info btn-lg">
            <div class="col-lg-12 text-center">
                <i class="fa fa-calendar-o fa-4x" aria-hidden="true"></i>
                <p>Ajouter un nouveau RDV</p>
            </div>
        </a>
    </div>
    <div class="card border-primary mb-3 center-block">
        <div class="card-header"><h4 class="card-title text-center">Ajouter un nouveau RDV</h4></div>
        <p class="redMessage">Tous les champs sont obligatoires</p>
        <?php foreach ($formError as $error) { ?>
            <div class="offset-lg-3 col-lg-6 alert alert-dismissible alert-danger text-center">
                <p><?= $error; ?></p>
            </div>
        <?php } ?>
        <!--    DEBUT FORMULAIRE      -->
        <form method="POST" action="#">
            <!--    NOM     -->
            <div class="col-lg-6">
                <label for="patientSelect" class="pull-right">Choisir un patient</label>
            </div>
            <div class="col-lg-6">
                <select name="patientSelect" class="pull-left">
                    <option disabled selected>Choisir un patient</option>
                    <?php
                    foreach ($patientsList AS $patients) {
                        ?>
                        <option value="<?= $patients->id; ?>" <?= (isset($patientSelect) && $patientSelect == $patients->id) ? 'selected' : ''; ?>><?= $patients->lastname . ' ' . $patients->firstname; ?></option>
                    <?php } ?>
                </select>

            </div>
            <!--    DATE DU RDV      -->
            <div class="col-lg-6">
                <label for="dateRDV" class="pull-right">Date du RDV</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="date" name="dateRDV" min="<?=date('Y-m-d')?>" placeholder="01/01/2001" value="<?= $RDV->dateRDV ?? '' ?>"/>
                <p class="regex pull-left"><?= isset($formError['dateRDV']) ? $formError['dateRDV'] : '' ?></p>
            </div>
            <!--    HEURE DU RDV      -->
            <div class="col-lg-6">
                <label for="hourRDV" class="pull-right">Heure du RDV</label>
            </div>
            <div class="col-lg-6">
                <input class="pull-left" type="text" name="hourRDV" placeholder="HH:MM:SS" value="<?= $RDV->hourRDV ?? '' ?>"/>
                <p class="regex pull-left"><?= isset($formError['hourRDV']) ? $formError['hourRDV'] : '' ?></p>
            </div>

            <!--    BOUTON      -->
            <input name="addRDV" class="offset-lg-5 col-lg-2 btn btn-outline-info" type="submit" value="Ajouter ce RDV"/>
        </form>
        <!--    FIN FORMULAIRE      -->
        <?php if ($insertSuccess) { ?>
            <div class="offset-lg-4 col-lg-4 alert alert-dismissible alert-success text-center">
                <p>Les données ont bien été transmise</p>
            </div>
        <?php } ?>
    </div>
</div>



<?php
include 'footer.php';
?>