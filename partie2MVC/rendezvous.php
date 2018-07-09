<?php
include 'models/dataBase.php';
include 'models/patients.php';
include 'models/appointments.php';
include 'controllers/rendezvousController.php';
include 'header.php';
?>

<div class="row">
    <div class="card border-primary mb-3 center-block">
        <div class="card-header"><h4 class="card-title text-center">Voir / Modifier les informations de ce patient</h4></div>

        <div class="row">
            <div class="col-lg-offset-2 col-lg-8 card border-primary mb-3 text-center">
                <div class="card-header"><h4 class="card-title text-center">Information du RDV</h4></div>
                <p><?= $appointmentDetails->lastname . ' ' . $appointmentDetails->firstname . ' a rendez-vous le ' . $appointmentDetails->date . ' à ' . $appointmentDetails->hour; ?> </p>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-offset-2 col-lg-8 card border-primary mb-3 center-block">
                <div class="card-header"><h4 class="card-title text-center">Modifier ce RDV</h4></div>
                <!--    DEBUT FORMULAIRE      -->
                <form method="POST" action="#">
                    <!--    DATE DU RDV      -->
                    <div class="col-lg-6">
                        <label for="dateRDV" class="pull-right">Date du RDV</label>
                    </div>
                    <div class="col-lg-6">
                        <input class="pull-left" type="date" min="<?=date('Y-m-d')?>" name="dateRDV" placeholder="01/01/2001" value="<?= $appointmentDetails->date ?? '' ?>"/>
                        <p class="regex pull-left"><?= isset($formError['dateRDV']) ? $formError['dateRDV'] : '' ?></p>
                    </div>
                    <!--    HEURE DU RDV      -->
                    <div class="col-lg-6">
                        <label for="hourRDV" class="pull-right">Heure du RDV</label>
                    </div>
                    <div class="col-lg-6">
                        <input class="pull-left" type="time" name="hourRDV" placeholder="HH:MM:SS" value="<?= $appointmentDetails->hour ?? '' ?>"/>
                        <p class="regex pull-left"><?= isset($formError['hourRDV']) ? $formError['hourRDV'] : '' ?></p>
                    </div>
                    <!--    SELECTION DU PATIENT      -->
                    <div class="col-lg-6">
                        <label for="patientSelect" class="pull-right">Choisir un patient</label>
                    </div>
                    <div class="col-lg-6">
                        <select name="patientSelect" class="pull-left">
                            <?php
                            foreach ($patientsList AS $patients) {
                                ?>
                                <option value="<?= $patients->id; ?>" <?= (isset($appointmentDetails->idPatients) && $appointmentDetails->idPatients == $patients->id) ? 'selected' : ''; ?>><?= $patients->lastname . ' ' . $patients->firstname; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!--    BOUTON      -->
                    <input class="offset-lg-5 col-lg-2 btn btn-outline-info" type="submit" value="Modifier ce RDV" name="modifyRDV"/>
                </form>
                </div>
                <?php if ($insertSuccess) { ?>
                    <div class="offset-lg-4 col-lg-4 alert alert-dismissible alert-success text-center">
                        <p><?= 'Le rendez-vous à bien été modifié'; ?></p>
                    </div>
                    <?php
                }
                ?>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>