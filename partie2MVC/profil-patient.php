<?php
include 'models/dataBase.php';
include 'models/patients.php';
include 'models/appointments.php';
include 'controllers/profil-patientController.php';
include 'header.php';
?>

<div class="row">
    <div class="card border-primary mb-3 center-block">
        <div class="card-header"><h4 class="card-title text-center">Voir / Modifier les informations de ce patient</h4></div>
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8 card border-primary mb-3">
                <div class="card-header"><h4 class="card-title text-center">Informations du patient</h4></div>
                <p><span class="text-info">Nom : </span><?= $patientInfo->lastname ?></p>
                <p><span class="text-info">Prénom : </span><?= $patientInfo->firstname ?></p>
                <p><span class="text-info">Date de naissance : </span><?= $patientInfo->birthdate ?></p>
                <p><span class="text-info">Numéro de téléphone : </span><?= $patientInfo->phone ?></p>
                <p><span class="text-info">Adresse Mail : </span><?= $patientInfo->mail ?></p>
                <div class="card-header"><h4 class="card-title text-center">Liste des rendez-vous de ce patient</h4></div>
                <?php if (count($listInfoAppointments) != 0) { ?>
                    <table border="2" class="rdvList table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Heure</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listInfoAppointments as $appointmentsPatient) {
                                ?>
                                <tr>
                                    <td><?= $appointmentsPatient->date; ?></td>
                                    <td><?= $appointmentsPatient->hour; ?></td>
                                    <td><a class="btn btn-secondary" href="rendezvous.php?id=<?= $appointmentsPatient->id; ?>">Voir / Modifier ce RDV</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php } else {
                    ?>
                    <p class="alert alert-dismissible alert-danger text-center">Ce patient n'a pas de rendez-vous</p>
                <?php } ?>
            </div>
        </div>
        <!--    DEBUT FORMULAIRE      -->
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8 card border-primary mb-3 center-block">
                <div class="card-header"><h4 class="card-title text-center">Modifier le profil</h4></div>
                <p class="redMessage">Tous les champs sont obligatoires</p>
                <form method="POST" action="#">
                    <?php foreach ($formError as $error) { ?>
                        <p><?= $error; ?></p>
                    <?php } ?>
                    <!--    NOM     -->
                    <div class="col-lg-6">
                        <label for="lastname" class="pull-right">Nom</label>
                    </div>
                    <div class="col-lg-6">
                        <input class="pull-left" type="text" name="lastname" placeholder="Dupont" value="<?= $patientInfo->lastname ?>"/>
                        <p class="regex pull-left"><?= isset($formError['lastname']) ? $formError['lastname'] : '' ?></p>
                    </div>
                    <!--    PRENOM      -->
                    <div class="col-lg-6">
                        <label for="firstname" class="pull-right">Prénom</label>
                    </div>
                    <div class="col-lg-6">
                        <input class="pull-left" type="text" name="firstname" placeholder="Xavier" value="<?= $patientInfo->firstname ?>"/>
                        <p class="regex pull-left"><?= isset($formError['firstname']) ? $formError['firstname'] : '' ?></p>
                    </div>
                    <!--    DATE DE NAISSANCE      -->
                    <div class="col-lg-6">
                        <label for="birthdate" class="pull-right">Date de naissance</label>
                    </div>
                    <div class="col-lg-6">
                        <input class="pull-left" type="date" name="birthdate" placeholder="01/01/2001" value="<?= $patientInfo->birthdate ?>"/>
                        <p class="regex pull-left"><?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?></p>
                    </div>
                    <!--    TELEPHONE      -->
                    <div class="col-lg-6">
                        <label for="phone" class="pull-right">Numéro de téléphone</label>
                    </div>
                    <div class="col-lg-6">
                        <input class="pull-left" type="tel" name="phone" placeholder="0612345678" value="<?= $patientInfo->phone ?>"/>
                        <p class="regex pull-left"><?= isset($formError['phone']) ? $formError['phone'] : '' ?></p>
                    </div>
                    <!--    EMAIL      -->
                    <div class="col-lg-6">
                        <label for="mail" class="pull-right">Adresse Email</label>
                    </div>
                    <div class="col-lg-6">
                        <input class="pull-left" type="email" name="mail" placeholder="xavier.dupont@mail.com" value="<?= $patientInfo->mail ?>"/>
                        <p class="regex pull-left"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></p>
                    </div>
                    <!--    BOUTON      -->
                    <input name="submit" class="offset-lg-5 col-lg-2 btn btn-outline-info" type="submit" value="Valider"/>
                </form>
            </div>
        </div>
        <?php if ($insertSuccess) { ?>
            <div class="offset-lg-4 col-lg-4 alert alert-dismissible alert-success text-center">
                <p><?= 'Les données ont bien été transmise'; ?></p>
            </div>
        <?php } ?>
    </div>
</div>
<?php
include 'footer.php';
?>